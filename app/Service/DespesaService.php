<?php

namespace App\Service;

use App\Models\Despesa;
use App\Repository\DespesaRepository;
use Illuminate\Database\Eloquent\Collection;

class DespesaService {

    protected $contaService;

    public function __construct(
        DespesaRepository $despesaRepository
    ){
        $this->despesaRepository = $despesaRepository;
    }

    public function criarDespesa(Despesa $lancamento):Despesa
    {
        return $this->despesaRepository->criarDespesa($lancamento);
    }

    public function listarTodasDespesas():Collection
    {
        return $this->despesaRepository->listarTodasDespesas();
    }

    public function ListarUmaDespesa($id):Despesa
    {
        return $this->despesaRepository->listarUmaDespesa($id);
    }


    public function atualizarDespesa($novosDados)
    {
        $atualizar=$novosDados[0];
        $id=$novosDados[1];

        $lancamento=$this->despesaRepository->atualizarDespesa($id);

        $lancamento-> update([
            'descricao'=>$atualizar['descricao'],
            'valor'=>$atualizar['valor'],
            'data'=>$atualizar['data']
        ]);
    }

    public function deletarDespesa($id):int
    {
        return $this->despesaRepository->deletarDespesa($id);
    }
}