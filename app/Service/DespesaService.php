<?php

namespace App\Service;

use App\Models\Despesa;
use App\Repository\DespesaRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Entities\Despesa as DespesaEntity;
use App\Exceptions\ReceitaException;
use DateTime;
use Illuminate\Http\JsonResponse;

class DespesaService {

    protected $contaService; 

    public function __construct(
        DespesaRepository $despesaRepository
    ){
        $this->despesaRepository = $despesaRepository;
    }

    public function criarDespesa(DespesaEntity $lancamento):Despesa
    {
        $comparaData = $this->despesaRepository->buscaDuplicado($lancamento->getData()->format('m'),
                                                                $lancamento->getDescricao());
    
        if (!$comparaData->isEmpty()) {
            throw new ReceitaException("Negado, já existe uma receita cadastrada com mesma descrição nesta data.", 400);
        }
    
    
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

    private function retornaMes(string $data)
{
    $dataNova=new DateTime($data);
    return $dataNova->format('m');
}

    public function atualizarDespesa($id, $atualizar)
    {
        $mesNovo=$this->retornaMes($atualizar['data']);
    
        $lancamento=$this->despesaRepository->ListarUmaDespesa($id);
    
        $mesAntigo=$this->retornaMes($lancamento->data);
    
        $comparaDescricao= $lancamento->descricao==$atualizar['descricao'];
        $comparaData= $mesNovo==$mesAntigo;
    
        if ($comparaData && $comparaDescricao ) {
            return new JsonResponse ("Negado, já existe uma receita cadastrada com mesma descrição ne data.");
        }
        
        $lancamento->descricao=$atualizar['descricao'];
        $lancamento->data=$atualizar['data'];
        $lancamento->valor=$atualizar['valor'];
    
        $this->despesaRepository->atualizarDespesa($lancamento);
    }

    public function deletarDespesa($id):int
    {
        return $this->despesaRepository->deletarDespesa($id);
    }
}