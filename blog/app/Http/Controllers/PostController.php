<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Model\Post;
use Illuminate\Support\Facades\DB;
use Exception;

class PostController extends Controller
{

    public function index(Request $request)
    {
        return Post::where("title", "like", "%{$request->get('search')}%")
            ->orWhere("content", "like", "%{$request->get('search')}%")
            ->orWhereHas("categories", function ($query) use ($request) {
                return $query->where("name", "like", "%{$request->get('search')}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {

            // Define o valor default para a variável que contém o nome da imagem
            $nameFile = null;

            $validation = Validator::make($request->all(), [
                'content' => 'required',
                'image' => 'required|mimes:jpeg,png',
                'title' => 'required|max:200',
                'category_id' => 'required|numeric',
            ]);

            if ($validation->fails()) {
                $erros = "";
                foreach ($validation->errors()->getMessages() as $erro) {
                    $erros .= $erro[0] . "<br/>";
                }
                throw  new Exception($erros);
            }

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->file('image')->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->file('image')->storeAs('public', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/images/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload) {
                throw  new Exception("Falha ao fazer upload de arquivo");
            }

            $post = new Post();
            $post->image = $nameFile;
            $post->title = $request->get("title");
            $post->content = $request->get("content");
            $post->category_id = $request->get("category_id");
            $post->user_id = $request->user()->id;
            if (!$post->save()) {
                throw new Exception("Não foi possivel salvar");
            }
            DB::commit();
            $response = [
                "success" => true,
                "message" => "Salvo com sucesso!"
            ];

        } catch (\Exception $ex) {
            DB::rollBack();
            Storage::delete($nameFile);
            $response = [
                "success" => false,
                "message" => $ex->getMessage(),
            ];
        }

        return $response;

    }

    public function update(Request $request)
    {

        // Define o valor default para a variável que contém o nome da imagem
        $nameFile = null;
        DB::beginTransaction();
        try {


            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('image')) {

                if (!$request->file('image')->isValid()) {
                    throw  new Exception("arquivo inválido!");
                }
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->file('image')->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";

                // Faz o upload:
                $upload = $request->file('image')->storeAs('public', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/nomedinamicoarquivo.extensao

                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if (!$upload) {
                    throw  new Exception("Falha ao fazer upload de arquivo");
                }

            }

            $regras = [
                'id' => 'required|numeric',
                'content' => 'required',
                'title' => 'required|max:200',
                'category_id' => 'required|numeric',
            ];


            if ($request->hasFile('image')) {
                $regras['image'] = 'required|mimes:jpeg,png';
            }

            $validation = Validator::make($request->all(), $regras);

            if ($validation->fails()) {
                $erros = "";
                foreach ($validation->errors()->getMessages() as $erro) {
                    $erros .= $erro[0] . "<br/>";
                }
                throw  new Exception($erros);
            }

            $post = Post::find($request->get('id'));
            $image_old = $post->image;
            if ($request->hasFile('image')) {
                $post->image = $nameFile;
            }
            $post->title = $request->get("title");
            $post->content = $request->get("content");
            $post->category_id = $request->get("category_id");
            $post->user_id = $request->user()->id;
            if (!$post->save()) {
                throw new Exception("Não foi possivel salvar");
            }
            DB::commit();
            Storage::delete($image_old);
            $response = [
                "success" => true,
                "message" => "Salvo com sucesso!"
            ];

        } catch (\Exception $ex) {
            DB::rollBack();
            Storage::delete($nameFile);
            $response = [
                "success" => false,
                "message" => $ex->getMessage()
            ];
        }

        return $response;

    }

    public function delete($id)
    {

        try {
            if (!is_numeric($id)) {
                throw new \Exception("ID deve ser numerico");
            }

            $postCategory = Post::find($id);
            if (!$postCategory->delete()) {
                throw new \Exception("Não foi possivel excluir o post");
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

    public function publicationOrRemove($id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                throw new \Exception("Post não encontrado!");
            }

            if ($post->publication_date == null) {
                $actionText = "publicar";
                $post->publication_date = \Carbon\Carbon::now();
            } else {
                $actionText = "remover";
                $post->publication_date = null;
            }

            if (!$post->save()) {
                throw new \Exception("Não foi possivel {$actionText} post!");
            }

            $response = [
                "success" => true,
                "message" => "{$actionText} post realizado  com sucesso!"
            ];

        } catch (\Exception $ex) {
            $response = [
                "success" => false,
                "message" => $ex->getMessage()
            ];

        }

        return $response;
    }

    public function recent(Request $request)
    {
        $post = Post::whereNotNull("publication_date")
            ->where("title", 'like', "%{$request->get('search')}%");
        if (is_numeric($request->get('category_id'))) {
            $post = $post->where('category_id','=',$request->get('category_id'));
        }
        if (is_numeric($request->get('author_id'))) {
            $post = $post->where('user_id','=',$request->get('author_id'));
        }

        return $post->orderBy('publication_date', 'desc')->paginate(10);
    }
}
