<?php

namespace App\Repository;

use App\Models\Despesa;
use Illuminate\Database\Eloquent\Collection;

class DespesaRepository
{  

    public function criarDespesa(Despesa $lancamento):Despesa
    {
        return Despesa::create($lancamento->getAttributes());
    }

    public function listarTodasDespesas():Collection
    {
        return Despesa::all();
    }

    public function ListarUmaDespesa($id):Despesa
    {
        return Despesa::findorfail($id);
    }

    public function atualizarDespesa($id):Despesa
    {
        return Despesa::findorfail($id);
    }

    public function deletarDespesa($id):int
    {
        return Despesa::destroy($id);
    }
}