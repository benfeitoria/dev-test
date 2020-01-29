<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
 
class AuthController extends Controller
{
 
    public function index()
    {
        return view('login');
    }  
 
    public function registration()
    {
        return view('registration');
    }
     
    public function login(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        return Redirect::to("login")->withSuccess('E-mail ou senha inválidos!');
    }
 
    public function createLogin(Request $request)
    {  
        request()->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        ]);
         
        $data = $request->all();
 
        $check = $this->create($data);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
       
        return Redirect::to("/")->withSuccess('Cadastro efetuado com sucesso!');
    }
     
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
     
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
