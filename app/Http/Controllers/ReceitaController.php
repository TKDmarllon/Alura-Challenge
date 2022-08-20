<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Entities\Receita;
use App\Exceptions\ReceitaException;
use App\Http\Requests\AtualizacaoRequest;
use App\Service\ReceitaService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use DateTime as Data;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    private $receitaService;

    public function __construct(
        ReceitaService $receitaService,
    ){
        $this->receitaService = $receitaService;
    }
    public function criarReceita(LancamentoRequest $request):JsonResponse
    {   

        try {
            $lancamento= new Receita(  $request->get('descricao'),
                                       $request->get('valor'),
                             new Data ($request->get('data')));
                        
            $criado=$this->receitaService->criarReceita($lancamento);

            return new JsonResponse($criado, 201);

        } catch (ReceitaException $e) {
            return new JsonResponse($e->getMessage(),$e->getCode());
        }

    }

    public function listarTodasReceitas(Request $request):Collection
    {
        $busca = $request->query('descricao');
        return $this->receitaService->listarTodasReceitas($busca);
    }

    public function ListarUmaReceita($id)
    {
        return $this->receitaService->listarUmaReceita($id);
    }

    public function atualizarReceita(AtualizacaoRequest $request, $id)
    {
        try {
            $lancamento= new Receita(  $request->get('descricao'),
                                       $request->get('valor'),
                             new Data ($request->get('data')));
            return $this->receitaService->atualizarReceita($id,$lancamento);

        } catch (ReceitaException $e) {
            return new JsonResponse($e->getMessage(),$e->getCode());
        }
    }

    public function deletarReceita($id):JsonResponse
    {
        $this->receitaService->deletarReceita($id);
        return new JsonResponse("Receita excluída.");
    }

    public function listarAnoMes($ano, $mes)
    {
        return $this->receitaService->listarAnoMes($ano,$mes);
    }
}