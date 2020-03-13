<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titulo' => 'required|max:149',
            'users_id' => 'required',
            'conteudo' => 'required',
            'data_publicacao' => 'required|date'
        ];
    }

    public function attributes(){
        return [
            'users_id' => "autor",
            'data_publicacao' => 'data de publicação',
            'conteudo' => 'conteúdo'
        ];
    }
}
