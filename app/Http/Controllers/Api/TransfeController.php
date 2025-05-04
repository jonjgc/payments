<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransferRequest;
use Illuminate\Http\Request;

class TransfeController extends Controller
{
    public function store(TransferRequest $request)
    {
        return response()->json(['message' => 'Tranfer Validated'], 200);
    }
}
