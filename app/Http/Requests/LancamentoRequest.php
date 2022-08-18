<?php

namespace App\Http\Requests;

use App\Rules\DataRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LancamentoRequest extends AbstractRequest
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
            'descricao'=>'required',
            'valor'=>'required|gt:0',
            'data'=>'required|date_format:d-m-Y',
            'categoria'=>['nullable',Rule::in(['Outras','Alimentação','Saúde','Moradia','Transporte','Educação','Imprevistos'])]
            
        ];
    }

    public function messages()
    {
        return[
            'descricao.required'=>'A descrição pracisa ser preenchida.',
            'valor.required'=>'O valor precisa ser preenchido.',
            'valor.gt'=>'O valor precisa ser positivo.',
            'data.required'=>'A data precisa ser preenchida.',
            'data.date_format'=>'Data inválida.'
        ];
    }
}