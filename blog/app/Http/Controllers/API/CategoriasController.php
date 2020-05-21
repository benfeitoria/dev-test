<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Categoria as CategoriaRepository;
use App\Exceptions\BadRequestException;
use App\Exceptions\NotAllowedException;

use \Exception;

class CategoriasController extends Controller
{
    private $categoriaRepository;
    
    public function __construct(
        CategoriaRepository $categoriaRepository
    ) {
        // $this->middleware('auth:api', ['except' => ['index']]);

        $this->categoriaRepository = $categoriaRepository;
    }

    public function index()
    {
        $categorias = null;

        try {
            $categorias = $this->categoriaRepository->getAll();
        } catch(Exception $e) {
            return response(json_encode($e->getMessage()), 500);
        }

        if ( empty($categorias) || $categorias->isEmpty()) {

            return response(json_encode((object) [
                'msg'=> "Não há categorias cadastradas"
            ]), 404);
        }

        return response()->json($categorias);
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        try {

            $res = $this->categoriaRepository->delete($id);

            if ($res == 0) {

                return response(json_encode((object) [
                    'msg' => "Não foi encontrada nenhuma categoria com este ID"
                ]), 400);
            }
            
        } catch (NotAllowedException $e) {
            return response(json_encode($e->getMessage()), 406);
        } catch (Exception $e) {
            return response(json_encode($e->getMessage()), 500);
        }

        response(null, 200);
    }

    public function create(Request $request)
    {
        $descricao = $request->input('descricao', null);

        try {

            if (empty($descricao)) {
                throw new BadRequestException('Informe a descrição da categoria');
            }

            $categoria = $this->categoriaRepository->create($descricao);
            
        } catch (BadRequestException $e) {
            return response(json_encode( (object) ['msg' => $e->getMessage()]), 400);
        } catch (Exception $e) {
            return response(json_encode($e->getMessage()), 500);
        }

        return response()->json((object) [
            'id' => $categoria->id,
            'descricao' => $categoria->descricao
        ]);
    }
}
