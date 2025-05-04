<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
   public function authorize() 
   {
    return true;
   }

   public function rules() 
   {
    return [
        'value' => 'required|numeric|min:0.01',
        'payer' => 'required|exists:users,id',
        'payee' => 'required|exists:users,id|different:payer',
     ];
   }
}
