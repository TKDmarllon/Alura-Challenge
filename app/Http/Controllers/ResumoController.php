<?php

namespace App\Http\Controllers;

use App\Service\DespesaService;
use App\Service\ReceitaService;
use App\Service\ResumoService;

class ResumoController extends Controller
{
    private $receitaService;
    private $despesaService;
    private $resumoService;

    public function __construct(
        ReceitaService $receitaService,
        DespesaService $despesaService,
        ResumoService $resumoService,
    ){
        $this->receitaService = $receitaService;
        $this->despesaService = $despesaService;
        $this->resumoService = $resumoService;
    }

    public function resumo($ano, $mes)
    {
        return $this->resumoService->resumo($ano,$mes);
    }
}
