<?php

namespace App\Service;

use App\Entities\Receita as ReceitaEntity;
use App\Exceptions\ReceitaException;
use App\Models\Receita;
use App\Repository\ReceitaRepository;
use Illuminate\Database\Eloquent\Collection;

class ReceitaService {

    protected $receitaService;

public function __construct(
    ReceitaRepository $receitaRepository
){
    $this->receitaRepository = $receitaRepository;
}

public function criarReceita(ReceitaEntity $lancamento)
{
    $comparaData = $this->receitaRepository->buscaDuplicado($lancamento->getData()->format('m'),
                                                            $lancamento->getDescricao());

    if (!$comparaData->isEmpty()) {
        throw new ReceitaException("Negado, já existe uma receita cadastrada com mesma descrição nesta data.", 400);
    }


    return $this->receitaRepository->criarReceita($lancamento);
}

public function listarTodasReceitas():Collection
{
    return $this->receitaRepository->listarTodasReceitas();
}

public function ListarUmaReceita($id):Receita
{
    return $this->receitaRepository->listarUmaReceita($id);
}

public function atualizarReceita($id, $atualizar)
{

    $lancamento=$this->receitaRepository->ListarUmaReceita($id);

    $comparaData = $this->receitaRepository->buscaDuplicado($atualizar->getData()->format("m"),
                                                            $atualizar->getDescricao());

    if (!$comparaData->isEmpty()) {
        throw new ReceitaException("Negado, já existe uma receita cadastrada com mesma descrição nesta data.", 400);
    }
    
    $lancamento->descricao=$atualizar->getDescricao();
    $lancamento->data=$atualizar->getData();
    $lancamento->valor=$atualizar->getValor();

    $this->receitaRepository->atualizarReceita($lancamento);
}

public function deletarReceita($id):int
{
    return $this->receitaRepository->deletarReceita($id);
}
}