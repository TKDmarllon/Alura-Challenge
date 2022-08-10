<?php

namespace App\Repository;

use App\Models\Receita;
use Illuminate\Database\Eloquent\Collection;

class ReceitaRepository{  


    public function criarReceita(Receita $lancamento):Receita
    {
        return Receita::create($lancamento->getAttributes());
    }

    public function listarTodasReceitas():Collection
    {
        return Receita::all();
    }

    public function ListarUmaReceita($id):Receita
    {
        return Receita::findorfail($id);
    }

    public function atualizarReceita($id):Receita
    {
        return Receita::findorfail($id);
    }

    public function deletarReceita($id):int
    {
        return Receita::destroy($id);
    }
}