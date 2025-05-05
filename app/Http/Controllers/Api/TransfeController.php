<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransferRequest;
use App\Services\TransferService;
use Illuminate\Http\Request;

class TransfeController extends Controller
{

    protected $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function store(TransferRequest $request)
    {

        try {
            $transfer = $this->transferService->transfer($request->validated());
            return response()->json(['message' => 'Transfer successful', 'transfer' => $transfer], 201);
        } catch (\Exception $e) {
            return response() ->json(['error' => $e->getMessage()], 400);
        }

    }

}
