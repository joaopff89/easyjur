<?php

namespace App\Repositories;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use App\Models\Versao;

class DicaRepository extends Repository
{
    public function getAll()
    {
        $this->model =  $this->model->leftJoin("users", "users.id", "=", "dicas.user_id")
        ->leftJoin("tipos", "tipos.id", "=", "dicas.tipo_id")
        ->leftJoin("marcas", "marcas.id", "=", "dicas.marca_id")
        ->leftJoin("modelos", "modelos.id", "=", "dicas.modelo_id")
        ->leftJoin("versoes", "versoes.id", "=", "dicas.versao_id")
        ->select("dicas.id as id", "users.name as usuario", "tipos.nome as tipo", "marcas.nome as marca", "modelos.nome as modelo", "versoes.nome as versao", "dicas.descricao as descricao", "dicas.created_at as criado_em", "dicas.updated_at as alterado_em");
    }

    public function create($newDica)
    {
        $userId = $newDica['userId'];
        $tipoId = $this->getTipoId($newDica['tipo']);
        $marcaId = $this->getMarcaId($newDica['marca']);
        $modeloId = $this->getModeloId($newDica['modelo']);
        $versaoId = isset($newDica['versao']) ? $this->getVersaoId($newDica['versao']) : null;
        $descricao = $newDica['descricao'];

        $id = $this->model->firstOrCreate(['user_id' => $userId, 'tipo_id' => $tipoId, 'marca_id' => $marcaId, 'modelo_id' => $modeloId, 'versao_id' => $versaoId, 'descricao' => $descricao])->id;

        $this->getAll();
        $this->filterId($id);
        return $this->result();
    }

    public function update($newData, $id)
    {
        $tipoId = $this->getTipoId($newData['tipo']);
        $marcaId = $this->getMarcaId($newData['marca']);
        $modeloId = $this->getModeloId($newData['modelo']);
        $versaoId = isset($newData['versao']) ? $this->getVersaoId($newData['versao']) : null;
        $descricao = $newData['descricao'];

        $this->model->where("id", $id)->update(['tipo_id' => $tipoId, 'marca_id' => $marcaId, 'modelo_id' => $modeloId, 'versao_id' => $versaoId, 'descricao' => $descricao]);

        $this->getAll();
        $this->filterId($id);
        return $this->result();
    }

    public function delete($id)
    {
        $dica = $this->model->find($id);

        if(isset($dica)){
            $dica->delete();
            return true;
        }else{
            return false;
        }
    }

    public function dicaUserId($id)
    {
        $result = $this->model->find($id);
        
        return $result ? $result->user_id : null;
    }

    public function filterId($id)
    {
        $this->filter("dicas.id", $id);
    }

    public function filterUser($id)
    {
        $this->filter("users.id", $id);
    }

    public function filterTipo($nome)
    {
        $this->filter("tipos.nome", $nome);
    }

    public function filterMarca($nome)
    {
        $this->model->where("marcas.nome", 'like', '%' . $nome . '%');
    }

    public function filterModelo($nome)
    {
        $this->model->where("modelos.nome", 'like', '%' . $nome . '%');
    }

    public function filterVersao($nome)
    {
        $this->model->where("versoes.nome", 'like', '%' . $nome . '%');
    }

    private function getTipoId($nome)
    {
        return Tipo::firstWhere("nome", $nome)->id;
    }

    private function getMarcaId($nome)
    {
        $marca = Marca::firstWhere("nome", $nome);
        if(!isset($marca)){
            $marca = Marca::create(['nome' => $nome]);
        }
        return $marca->id;
    }

    private function getModeloId($nome)
    {
        $modelo = Modelo::firstWhere("nome", $nome);
        if(!isset($modelo)){
            $modelo = Modelo::create(['nome' => $nome]);
        }
        return $modelo->id;
    }

    private function getVersaoId($nome)
    {
        $versao = Versao::firstWhere("nome", $nome);
        if(!isset($versao)){
            $versao = Versao::create(['nome' => $nome]);
        }
        return $versao->id;
    }
}