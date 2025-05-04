<?php

namespace App\Repositories;

use App\Interfaces\TransferRepositoryInterface;
use App\Models\Transfer;

class TransferRepository implements TransferRepositoryInterface 
{
    public function create($data)
    {
        return Transfer::create($data);
    }
}