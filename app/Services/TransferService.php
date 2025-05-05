<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TransferRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TransferService
{
    protected $userRepository;
    protected $transferRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        TransferRepositoryInterface $transferRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->transferRepository = $transferRepository;
    }

    public function transfer($data)
    {

        $payer = $this->userRepository->find($data['payer']);
        $payee = $this->userRepository->find($data['payee']);

        // Validações
        if ($payer->type === 'merchant') {
            throw new \Exception('Merchants cannot send transfers.');
        }
        if ($payer->balance < $data['value']) {
            throw new \Exception('Insuffiicient balance.');
        }

        // Consulta o serviço autorizador
        $response = Http::get('https://util.devi.tools/api/v2/authorize');
        if ($response->failed() || $response->json()['data']['authorization'] !== true) {
            throw new \Exception('Transfer not authorized.');
        }

        // Executa a transferência em uma transação
        return DB::transaction(function () use ($payer, $payee, $data) {
            $this->userRepository->updateBalance($payer, -$data['value']);
            $this->userRepository->updateBalance($payee, $data['value']);
            return $this->transferRepository->create([
                'payer_id' => $payer->id,
                'payer_id' => $payee->id,
                'value' => $data['value'],
                'status' => 'completed',
            ]);
        });
    }
}
