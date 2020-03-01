<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Model\PostCategories;
use Illuminate\Support\Facades\Validator;
use Exception;

class PostCategoriesController extends Controller
{
    public function index(Request $request)
    {
        return PostCategories::where("name", "like", "%{$request->get('search')}%")->orderBy('id', 'desc')->paginate(10);
    }

    public function all()
    {
        return PostCategories::all();
    }

    public function create(Request $request)
    {

        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required'
            ]);

            if ($validation->fails()) {
                $erros = "";
                foreach ($validation->errors()->getMessages() as $erro) {
                    $erros .= $erro[0] . "<br/>";
                }
                throw  new Exception($erros);
            }

            $postCategorie = new PostCategories();
            $postCategorie->name = $request->get("name");
            if (!$postCategorie->save()) {
                throw new \Exception("Não foi possivel salvar categoria!");
            }

            $reponse = [
                'success' => true,
                'message' => "Salvo com sucesso!",
            ];

        } catch (Exception $ex) {

            $reponse = [
                'success' => false,
                'message' => $ex->getMessage(),
            ];
        }

        return $reponse;
    }

    public function update(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'id' => 'required|numeric',
                'name' => 'required'
            ]);

            if ($validation->fails()) {
                $erros = "";
                foreach ($validation->errors()->getMessages() as $erro) {
                    $erros .= $erro[0] . "<br/>";
                }
                throw  new Exception($erros);
            }

            $postCategorie = PostCategories::find($request->get('id'));
            if (!$postCategorie) {
                throw new \Exception("Categoria não encontrada!");
            }
            $postCategorie->name = $request->get("name");
            if (!$postCategorie->save()) {
                throw new \Exception("Não foi possivel atualizar esta categoria!");
            }

            $reponse = [
                'success' => true,
                'message' => "Atualizado com sucesso!",
            ];

        } catch (Exception $ex) {

            $reponse = [
                'success' => false,
                'message' => $ex->getMessage(),
            ];
        }

        return $reponse;
    }

    public function delete($id)
    {

        try {
            if (!is_numeric($id)) {
                throw new \Exception("ID deve ser numerico");
            }

            $postCategory = PostCategories::find($id);
            if (!$postCategory->delete()) {
                throw new \Exception("Não foi possivel excluir o categoria");
            }

            $response = [
                "success" => true,
                "message" => "Excluido com sucesso!"
            ];

        } catch (Exception $ex) {
            $response = [
                "message" => $ex->getMessage(),
                "success" => false
            ];
        }
        return $response;

    }

    public function categoriesHasPost(){
        return PostCategories::whereHas('posts')->get();
    }

}
