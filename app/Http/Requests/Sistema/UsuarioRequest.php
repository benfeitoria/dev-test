<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {   
        if($this->method() == "POST"){
            return [
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email,{$this->id},id",
                'password' => 'required|string|min:6|confirmed',
            ];
        }else{
            return [
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email,{$this->id},id",
            ];
        }
    }

    public function attributes(){
        return [
            'name' => "nome",
            'email' => 'email',
            'password' => 'senha'
        ];
    }
}
