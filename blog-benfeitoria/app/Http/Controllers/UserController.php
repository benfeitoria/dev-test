<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->route('login')->withErrors("Usuário e/ou senha incorreta!");
        }

        return redirect()->route('modules');
    }

    public function register($id = null)
    {
        $data = array();

        if ($id)
            $data = User::find($id);

        return view('user', compact('data'));
    }

    public function store(Request $request)
    {
        extract($request->all());

        if ($id)
        /**UPDATE */
        {
            $request->validate(['name' => 'required', 'email' => 'required|email:rfc,dns']);

            $data = ["name" => $name, "email" => $email];

            if (isset($password)) $data["password"] = Hash::make($password);

            $user = User::where('id', $id)->update($data);

            $request->session()->flash('success', "Usuário atualizado!");
        } else
        /**INSERT */
        {
            $request->validate(['name' => 'required', 'email' => 'required|email:rfc,dns', 'password' => 'required']);

            $data = ["name" => $name, "email" => $email, "password" => Hash::make($password)];

            $user = User::create($data);

            $request->session()->flash('success', "Usuário {$user->name} cadastrado com sucesso!");
        }

        return redirect('/posts');
    }
}
