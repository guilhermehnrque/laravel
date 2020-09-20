<?php

namespace App\Http\Requests\Transfer;

use Illuminate\Foundation\Http\FormRequest;

class TransferStoreRequest extends FormRequest
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
            'value' =>  'required',
            'payer' => 'required',
            'payee' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'Value is required!',
            'payer.required' => 'Wallet source is required!',
            'payee.required' => 'Wallet target is required'
        ];
    }
}
