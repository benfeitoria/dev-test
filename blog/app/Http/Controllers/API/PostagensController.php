<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Postagem as PostagemRepository;
use App\Exceptions\BadRequestException;

use \Exception;

class PostagensController extends Controller
{
    private $postagemRepository;
    
    public function __construct(
        PostagemRepository $postagemRepository
    ) {
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
}
