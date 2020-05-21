<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Postagem as PostagemRepository;
use App\Exceptions\BadRequestException;

use \Exception;

class PostagensController extends Controller
{
    private $postagemRepository;
    
    public function __construct(
        PostagemRepository $postagemRepository
    ) {
        // $this->middleware('auth:api', ['except' => ['index', 'get']]);

        $this->postagemRepository = $postagemRepository;
    }

    public function index(Request $request)
    {
        $postagens   = null;
        $categoriaId = $request->query('categoria', null);
        $autorId     = $request->query('autor', null);

        $this->postagemRepository->categoriaId($categoriaId);
        $this->postagemRepository->autorId($autorId);

        try {
            $postagens = $this->postagemRepository->getAll();
        } catch(Exception $e) {
            return response(json_encode($e->getMessage()), 500);
        }


        if ( empty($postagens) || $postagens->isEmpty()) {
            return response(json_encode((object) [
              'msg' => "Não há postagens cadastradas para esse filtro"
            ]), 404);
        }

        return response()->json($postagens);
    }

    public function get(Request $request)
    {
        $id       = $request->id;
        $postagem = null;

        try {
            $postagem = $this->postagemRepository->get($id);
        } catch(Exception $e) {
            return response(json_encode($e->getMessage()), 500);
        }


        if ( empty($postagem) || $postagem->isEmpty()) {
            return response(json_encode((object) [
              'msg' => "Não há postagens cadastrada para esse código"
            ]), 404);
        }

        return response()->json($postagem);
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        try {

            $res = $this->postagemRepository->delete($id);

            if ($res == 0) {
                return response(json_encode((object) [
                  'msg' => "Não foi encontrada nenhuma postagem com este ID"
                ]), 400);
            }
            
        } catch (Exception $e) {
            return response(json_encode($e->getMessage()), 500);
        }

        response(null, 200);
    }

    public function create(Request $request)
    {
        $imagem       = $request->input('imagem', null);
        $titulo       = $request->input('titulo', null);
        $texto        = $request->input('texto', null);
        $autor_id     = $request->input('autor_id', null);
        $categoria_id = $request->input('categoria_id', null);

        try {

            if (empty($imagem)) {
                throw new BadRequestException('Informe a imagem da postagem');
            }

            if (empty($titulo)) {
                throw new BadRequestException('Informe o titulo da postagem');
            }

            if (empty($texto)) {
                throw new BadRequestException('Informe o texto da postagem');
            }

            if (empty($categoria_id)) {
                throw new BadRequestException('Informe a categoria da postagem');
            }

            if (empty($autor_id)) {
                throw new BadRequestException('Informe o autor da postagem');
            }

            $postagem = $this->postagemRepository->create(
                $imagem,
                $titulo,
                $texto,
                $autor_id,
                $categoria_id
            );
            
        } catch (BadRequestException $e) {
            return response(json_encode( (object) ['msg' => $e->getMessage()]), 400);
        } catch (Exception $e) {
            return response(json_encode($e->getMessage()), 500);
        }

        return response()->json((object) [
            'id'                  => $postagem->id,
            'imagem'              => $postagem->imagem,
            'titulo'              => $postagem->titulo,
            'texto'               => $postagem->texto,
            'created_at'          => $postagem->created_at,
            'updated_at'          => $postagem->updated_at,
            'autor_id'            => $postagem->autor_id,
            'autor_name'          => $postagem->autor_name,
            'categoria_id'        => $postagem->categoria_id,
            'categoria_descricao' => $postagem->categoria_descricao
        ]);
    }
}
