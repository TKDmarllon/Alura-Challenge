<?php

namespace App\Repository;

use App\Models\Despesa;
use App\Entities\Despesa as DespesaEntity;
use Illuminate\Database\Eloquent\Collection;

class DespesaRepository 
{  

    public function criarDespesa(DespesaEntity $lancamento):Despesa
    {
        return Despesa::create($lancamento->toArray());
    }

    public function listarTodasDespesas():Collection
    {
        return Despesa::all();
    }

    public function buscaDuplicado($data,$descricaoNova)
    {
        return Despesa::where('descricao', $descricaoNova)
        ->whereMonth('data', '=', $data)->get();
    }

    public function ListarUmaDespesa($id):Despesa
    {
        return Despesa::findorfail($id);
    }

    public function atualizarDespesa($lancamento)
    {
        $lancamento->save();
    }

    public function deletarDespesa($id):int
    {
        return Despesa::destroy($id);
    }
}