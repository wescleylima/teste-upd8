<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cpf' => 'required',
            'nome' => 'required',
            'data_nascimento' => 'required',
            'sexo' => 'required',
            'endereco' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cpf.required' => 'O cpf é obrigatório!',
            'nome.required' => 'O nome é obrigatório!',
            'data_nascimento.required' => 'A data de nascimento é obrigatória!',
            'sexo.required' => 'O sexo é obrigatório!',
            'endereco.required' => 'O endereço é obrigatório!',
            'estado.required' => 'A UF é obrigatória!',
            'cidade.required' => 'A Cidade é obrigatória!',
        ];
    }

}
