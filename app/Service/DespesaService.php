<?php

namespace App\Service;

use App\Models\Despesa;
use App\Repository\DespesaRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Entities\Despesa as DespesaEntity;
use App\Exceptions\DespesaException;
use App\Exceptions\ReceitaException;

class DespesaService {

    protected $depesaService; 

public function __construct(
    DespesaRepository $despesaRepository
){
    $this->despesaRepository = $despesaRepository;
}

public function criarDespesa(DespesaEntity $lancamento):Despesa
{
    $comparaData=$this->retornaDuplicado($lancamento);

    if (!$comparaData->isEmpty()) {
        throw new DespesaException("Negado, já existe uma despesa cadastrada com mesma descrição nesta data.", 400);
    }
    return $this->despesaRepository->criarDespesa($lancamento);
}

public function listarTodasDespesas($busca):Collection
{
    if (empty($busca)) {
        return $this->despesaRepository->listarTodasDespesas();
    }
    return $this->despesaRepository->listarBusca($busca);
}

public function ListarUmaDespesa($id):Despesa
{
    return $this->despesaRepository->listarUmaDespesa($id);
}

private function retornaDuplicado(DespesaEntity $lancamento)
{
    return $this->despesaRepository->buscaDuplicado($lancamento->getData()->format('m'),
                                                    $lancamento->getDescricao());
}

public function atualizarDespesa($id, $atualizar)
{
    $lancamento=$this->despesaRepository->ListarUmaDespesa($id);
    $comparaData = $this->retornaDuplicado($atualizar);

    if (!$comparaData->isEmpty()) {
        throw new ReceitaException("Negado, já existe uma despesa cadastrada com mesma descrição nesta data.", 400);
    }
    
    $lancamento->descricao=$atualizar->getDescricao();
    $lancamento->categoria=$atualizar->getCategoria();
    $lancamento->data=$atualizar->getData();
    $lancamento->valor=$atualizar->getValor();

    $this->despesaRepository->atualizarDespesa($lancamento);
}

public function deletarDespesa($id):int
{
    return $this->despesaRepository->deletarDespesa($id);
}

public function listarAnoMes($ano, $mes)
{
    return $this->despesaRepository->listarAnoMes($ano, $mes);
}
}