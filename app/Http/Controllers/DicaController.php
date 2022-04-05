<?php

namespace App\Http\Controllers;

use App\Http\Requests\DicaDeleteRequest;
use Illuminate\Http\Request;
use App\Http\Requests\DicaStoreRequest;
use App\Http\Requests\DicaUpdateRequest;
use App\Models\Dica as ModelsDica;
use App\Repositories\DicaRepository;

class DicaController extends Controller
{
    public function __construct(ModelsDica $dica)
    {
        $this->dica = $dica;
    }

    public function index(Request $request)
    {
        $dicaRepository = new DicaRepository($this->dica);

        $dicaRepository->getAll();

        if($request->user_id){
            $dicaRepository->filterUser($request->user_id);
        }

        if($request->tipo){
            $dicaRepository->filterTipo($request->tipo);
        }

        if($request->marca){
            $dicaRepository->filterMarca($request->marca);
        }

        if($request->modelo){
            $dicaRepository->filterModelo($request->modelo);
        }

        if($request->versao){
            $dicaRepository->filterVersao($request->versao);
        }

        if($request->paged == "true"){
            $dicas = $dicaRepository->resultPaged(10);
        }else{
            $dicas = $dicaRepository->result();
        }

        if(count($dicas)){
            return response()->json($dicas, 200);
        }else{
            return response()->json(['msg' => 'Nenhum registro encontrado!'], 404);
        }
    }

    public function store(DicaStoreRequest $request)
    {
        $dicaRepository = new DicaRepository($this->dica);

        $dicaRepository->create($request->validated());

        $dica = $dicaRepository->result();

        return response()->json($dica, 201);
    }

    public function show($id)
    {
        $dicaRepository = new DicaRepository($this->dica);

        $dicaRepository->getAll();
        $dicaRepository->filterId($id);

        $dica = $dicaRepository->result();

        if(count($dica)){
            return response()->json($dica, 200);
        }else{
            return response()->json(['msg' => 'Registro não encontrado!'], 404);
        }
    }

    public function update(DicaStoreRequest $request, $id)
    {
        $dicaRepository = new DicaRepository($this->dica);

        $dicaUserId = $dicaRepository->dicaUserId($request->id);

        if($dicaUserId && $dicaUserId != $request->userId){
            return response()->json(['msg' => 'Usuário não pode alterar este registro!'], 403);
        }

        $dica = $dicaRepository->update($request->validated(), $id);

        if(count($dica)){
            return response()->json($dica, 200);
        }else{
            return response()->json(['msg' => 'Registro não encontrado!'], 404);
        }     
    }

    public function destroy(DicaDeleteRequest $request, $id)
    {
        $dicaRepository = new DicaRepository($this->dica);

        $dicaUserId = $dicaRepository->dicaUserId($id);

        if($dicaUserId && $dicaUserId != $request->userId){
            return response()->json(['msg' => 'Usuário não pode remover este registro!'], 403);
        }

        if($dicaRepository->delete($id)){
            return response()->json(['msg' => 'Registro removido com sucesso!'], 200);
        }else{
            return response()->json(['msg' => 'Registro não encontrado!'], 404);
        }
    }
}
