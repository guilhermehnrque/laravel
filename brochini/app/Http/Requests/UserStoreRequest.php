<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'full_name' =>  'required',
            'cpf_cnpj'  => 'required|unique:users',
            'email'     => 'required|unique:users',
            'password'  => 'required',
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Full name is required!',
            'cpf_cnpj.required' => 'CPF/CNPJ is required!',
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!',
            'type.required' => 'Type user is required!',
            'cpf_cnpj.unique' => 'CPF/CNPJ has already been used',
            'email.unique' => 'Email has already been used',
        ];
    }
}
