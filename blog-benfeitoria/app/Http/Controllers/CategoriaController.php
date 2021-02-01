<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get("search");

        if (isset($search)) {
            $categorias = Category::query()->where('name', 'like', "%{$search}%")->paginate(5);

            $categorias->appends(["search" => $search]);
        } else {
            $categorias = Category::paginate(5);
        }

        $categorias->withPath("categorias");

        $retorno["criado"] = $request->session()->get('success');

        $retorno["deletado"] = $request->session()->get('delete');

        return view('categorias.index', compact('categorias', 'retorno'));
    }

    public function register($id = null)
    {
        $data = array();

        if ($id)
            $data = Category::find($id);

        return view('categorias.form', compact('data'));
    }

    public function store(Request $request)
    {
        extract($request->all());

        $request->validate(['name' => 'required']);

        $data = ['name' => $name];

        if ($id) {
            $categoria = Category::where('id', $id)->update($data);

            $request->session()->flash("success", "Categoria atualizada!");
        } else {
            $categoria = Category::create($data);

            $request->session()->flash("success", "Categoria {$categoria->name} cadastrada com sucesso!");
        }

        return redirect("/categorias");
    }

    public function destroy(Request $request)
    {
        Category::destroy($request->only('id'));

        $request->session()->flash('delete', "Categoria deletada!");

        return redirect("/categorias");
    }
}
