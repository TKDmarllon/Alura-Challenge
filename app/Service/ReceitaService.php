<?php

namespace App\Service;

use App\Entities\Receita as ReceitaEntity;
use App\Models\Receita;
use App\Repository\ReceitaRepository;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ReceitaService {

    protected $receitaService;

public function __construct(
    ReceitaRepository $receitaRepository
){
    $this->receitaRepository = $receitaRepository;
}

public function criarReceita(ReceitaEntity $lancamento):Receita
{
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

private function retornaMes(string $data)
{
    $dataNova=new DateTime($data);
    return $dataNova->format('m');
}

public function atualizarReceita($id, $atualizar)
{
    $mesNovo=$this->retornaMes($atualizar['data']);

    $lancamento=$this->receitaRepository->ListarUmaReceita($id);

    $mesAntigo=$this->retornaMes($lancamento->data);

    $comparaDescricao= $lancamento->descricao==$atualizar['descricao'];
    $comparaData= $mesNovo==$mesAntigo;

    if ($comparaData && $comparaDescricao ) {
        return new JsonResponse("Negado, já existe uma receita cadastrada com mesma descrição ne data.");
    }
    
    $lancamento->descricao=$atualizar['descricao'];
    $lancamento->data=$atualizar['data'];
    $lancamento->valor=$atualizar['valor'];

    $this->receitaRepository->atualizarReceita($lancamento);
}

public function deletarReceita($id):int
{
    return $this->receitaRepository->deletarReceita($id);
}
}