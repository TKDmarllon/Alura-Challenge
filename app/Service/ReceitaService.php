<?php

namespace App\Service;

use App\Entities\Receita as ReceitaEntity;
use App\Exceptions\ReceitaException;
use App\Models\Receita;
use App\Repository\ReceitaRepository;
use Illuminate\Database\Eloquent\Collection;

use function PHPUnit\Framework\isEmpty;

class ReceitaService {

    protected $receitaService;

public function __construct(
    ReceitaRepository $receitaRepository
){
    $this->receitaRepository = $receitaRepository;
}

public function criarReceita(ReceitaEntity $lancamento)
{
    $comparaDuplicado = $this->retornaDuplicado($lancamento);

    if (!$comparaDuplicado->isEmpty()) {
        throw new ReceitaException("Negado, já existe uma receita cadastrada com 
                                    mesma descrição nesta data.", 400);
    }
    return $this->receitaRepository->criarReceita($lancamento);
}

public function listarTodasReceitas($busca):Collection
{
    if (empty($busca)) {
        return $this->receitaRepository->listarTodasReceitas();
    }
    return $this->receitaRepository->listarBusca($busca);
}

public function ListarUmaReceita($id):Receita
{
    return $this->receitaRepository->listarUmaReceita($id);
}

public function atualizarReceita($id, $atualizar)
{
    $lancamento=$this->receitaRepository->ListarUmaReceita($id);

    $descricao=$lancamento->descricao=Empty($atualizar->getDescricao())?
                            $lancamento->descricao:$atualizar->getDescricao();

    $valor=$lancamento->valor=Empty($atualizar->getValor())?
                            $lancamento->valor:$atualizar->getValor();

    $data=$lancamento->data=Empty($atualizar->getData())?
                            $lancamento->data:$atualizar->getData();

    $comparaObjeto= new ReceitaEntity($descricao,$valor,$data);
    $comparaData = $this->retornaDuplicado($comparaObjeto);
    if (!$comparaData->isEmpty()) {
        throw new ReceitaException("Negado, já existe uma receita cadastrada com mesma 
                                    descrição nesta data.", 400);
    }

    return $this->receitaRepository->atualizarReceita($lancamento);
}

public function deletarReceita($id):int
{
    return $this->receitaRepository->deletarReceita($id);
}

private function retornaDuplicado(ReceitaEntity $lancamento)
{
    return $this->receitaRepository->buscaDuplicado($lancamento->getData()->format('m'),
    $lancamento->getDescricao());
}

public function listarAnoMes($ano, $mes)
{
    return $this->receitaRepository->listarAnoMes($ano, $mes);
}

public function resumo($ano, $mes)
{
    $resumoReceita=$this->receitaRepository->listarAnoMes($ano, $mes);
    $resumoDespesa=$this->depesaRepository->listarAnoMes($ano, $mes);
    dd($resumoReceita,$resumoDespesa);
}
}