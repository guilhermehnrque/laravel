<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_balance' =>  'required',
            'status'  => 'required',
            'user_id'     => 'required|unique:wallets'
        ];
    }

    public function messages()
    {
        return [
            'current_balance.required' => 'Current balance is required!',
            'status.required' => 'Status is required!',
            'user_id.required' => 'User id is required!',
            'user_id.unique' => 'User id has already been used'
        ];
    }
}
