<?php

namespace App\Service;

use App\Models\Receita;
use App\Repository\ReceitaRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ReceitaService {

    protected $receitaService;

public function __construct(
    ReceitaRepository $receitaRepository
){
    $this->receitaRepository = $receitaRepository;
}

public function criarReceita(Receita $lancamento):Receita
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

public function atualizarReceita($novosDados)
{
    $atualizar=$novosDados[0];
    $id=$novosDados[1];

    $data=$atualizar['data'];
    $dataSeparada=explode('-',$data);
    $verificaData=checkdate($dataSeparada[1],$dataSeparada[0],$dataSeparada[2]);
    $mesNovo=$dataSeparada[1];

    if ($verificaData === false) {
        return new JsonResponse("Data inválida.");
    }

    $lancamento=$this->receitaRepository->atualizarReceita($id);

    $dataComparar=$atualizar['data'];
    $dataCompararSeparada=explode('-',$dataComparar);
    $mesAntigo=$dataCompararSeparada[1];

    $comparaDescricao= $lancamento['descricao']==$atualizar['descricao'];
    $comparaData= $mesNovo==$mesAntigo;

    if ($comparaData !== true && $comparaDescricao !==true ) {
        return new JsonResponse("Negado, já existe uma receita cadastrada com mesma descrição ne data.");
    }

    $lancamento-> update([
        'descricao'=>$atualizar['descricao'],
        'valor'=>$atualizar['valor'],
        'data'=>$atualizar['data']
    ]);
    return new JsonResponse("Receita atualizada.");
}

public function deletarReceita($id):int
{
    return $this->receitaRepository->deletarReceita($id);
}
}