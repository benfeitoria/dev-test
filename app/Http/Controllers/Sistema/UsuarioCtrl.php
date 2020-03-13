<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\Sistema\UsuarioRequest;
use App\User;

class UsuarioCtrl extends Controller
{
    
    private $user;

    public function __construct(

        User $u
    )
    {
        $this->user = $u;
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        
        $busca = "";
        if(!empty($request->name)){
            $busca = $request->name;
            $p = $this->user
                    ->where('name', 'LIKE', "%{$request->name}%")
                    ->orWhere('email', 'LIKE', "%{$request->name}%")
                    ->orderBy('created_at', 'DESC')
                    ->paginate(2);
        
        }else{
            $p = $this->user->orderBy('created_at', 'DESC')->paginate(2);
        }

        return view('sistema.user.lista', ['users' => $p, 'busca' => $busca]);
    }

    public function create()
    {
        return view('sistema.user.novo');
    }

    public function store(UsuarioRequest $request)
    {   
        $p = new $this->user($request->all());
        $p->password = Hash::make($request->password);
        $p->save();

        return redirect()->route('sistema.user.index')->with('success','Usuário cadastrado com sucesso');
    }
    
    public function edit($id)
    {
        $u = $this->user->find($id);

        return view('sistema.user.editar', ['user' => $u]);
    }

    public function update(UsuarioRequest $request, $id)
    {
        $u = $this->user->find($id);
        $u->update($request->all());

        return redirect()->route('sistema.user.index')->with('success','Usuário editado com sucesso');
    }
}
