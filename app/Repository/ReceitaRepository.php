<?php

namespace App\Repository;

use App\Models\Receita;
use App\Entities\Receita as ReceitaEntity;
use Illuminate\Database\Eloquent\Collection;

class ReceitaRepository{  


    public function criarReceita(ReceitaEntity $lancamento)
    {
        $criado= Receita::create($lancamento->toArray());
        return $criado;
    }

    public function listarTodasReceitas():Collection
    {
        return Receita::all();
    }

    public function ListarUmaReceita($id)
    {
        return Receita::findorfail($id);
    }

    public function atualizarReceita($lancamento)
    {
        $lancamento->save();
    }

    public function deletarReceita($id):int
    {
        return Receita::destroy($id);
    }
}