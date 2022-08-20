<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AtualizacaoRequest extends AbstractRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'valor'=>'gt:0',
            'data'=>'date_format:d-m-Y',
            'categoria'=>['nullable',Rule::in(['Outras','Alimentação','Saúde','Moradia','Transporte','Educação','Imprevistos'])]
        ];
    }

    public function messages()
    {
        return[
            'valor.gt'=>'O valor precisa ser positivo.',
            'data.date_format'=>'Data inválida.'
        ];
    }
}
