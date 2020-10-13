<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
            'name' => ['required', 'max:50'],
            'lastName' => ['required', 'max:50'],
            'email' => ['required', 'email'],
            'documentId' => ['required', 'unique:customers'],
            'address' => ['required']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre es un campo obligatorio.',
            'lastName.required' => 'El apellido es un campo obligatorio.',
            'documentId.required' => 'El RUT es un campo obligatorio.',
            'email.required' => 'El Email es un campo obligatorio.',
            'address.required' => 'La direccion es un campo obligatorio.',
            'documentId.unique' => 'Rut pertenece a otro cliente.',
            'email.email' => 'Email debe tener formato xxxx@ddd.nnn'
        ];
    }
}
