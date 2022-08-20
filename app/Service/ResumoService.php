<?php

namespace App\Service;

use App\Repository\DespesaRepository;
use App\Repository\ReceitaRepository;
use App\Service\ReceitaService;
use App\Service\DespesaService;
use Illuminate\Http\JsonResponse;

class ResumoService
{
    private $receitaRepository;
    private $despesaRepository;
    private $receitaService;
    private $despesaService;

    public function __construct(
        ReceitaService $receitaService,
        ReceitaRepository $receitaRepository,
        DespesaRepository $despesaRepository,
        DespesaService $despesaService,
        
    ){
        $this->receitaRepository = $receitaRepository;
        $this->despesaRepository = $despesaRepository;
        $this->receitaService = $receitaService;
        $this->despesaService = $despesaService;
    }

public function resumo($ano,$mes)
{
    $totalReceita=$this->receitaRepository->totalReceita($ano,$mes)->pluck('valorTotal');
    $totalDespesa=$this->despesaRepository->totalDespesa($ano,$mes)->pluck('valorTotal');
    $balanco=$totalReceita[0]-$totalDespesa[0];
    $totalDespesaCategoria=$this->despesaRepository->totalDespesaCategoria($ano,$mes)->pluck('valorTotal','categoria');
    $resumo= ["Total_Receita"=>$totalReceita,
              "Total_Despesa"=>$totalDespesa,
              "Resumo"=>$balanco,
              "Despesa_por_categoria"=>$totalDespesaCategoria];
    return new Jsonresponse ($resumo);
}

}