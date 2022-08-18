<?php

namespace App\Repository;

use App\Models\Receita;
use App\Entities\Receita as ReceitaEntity;
use Illuminate\Database\Eloquent\Collection;

class ReceitaRepository{  


    public function criarReceita(ReceitaEntity $lancamento)
    {
       return Receita::create($lancamento->toArray());
    }

    public function listarTodasReceitas():Collection
    {
        return Receita::all();
    }

    public function buscaDuplicado($data,$descricaoNova)
    {
        return Receita::where('descricao', $descricaoNova)
        ->whereMonth('data', '=', $data)->get();
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