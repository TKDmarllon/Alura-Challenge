<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Models\Despesa as ModelsDespesa;
use App\Entities\Despesa;
use App\Exceptions\DespesaException;
use App\Exceptions\ReceitaException;
use App\Service\DespesaService;
use Illuminate\Http\JsonResponse;
use DateTime as Data;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    private $despesaService;

    public function __construct(
        DespesaService $despesaService,
    ){
        $this->despesaService = $despesaService;
    }

    public function criarDespesa(LancamentoRequest $request):JsonResponse
    {   
        try {
            $lancamento= new Despesa(  $request->get('descricao'),
                                       $request->get('valor'),
                                       new Data ($request->get('data')),
                                       $request->get('categoria'));
                        
            $criado=$this->despesaService->criarDespesa($lancamento);

            return new JsonResponse($criado, 201);

        } catch (DespesaException $e) {
            return new JsonResponse($e->getMessage(),$e->getCode());
        }
    }

    public function listarTodasDespesas(Request $request):Collection
    {
        $busca=$request->query('descricao');
        return $this->despesaService->listarTodasDespesas($busca);
    }

    public function ListarUmaDespesa($id):ModelsDespesa
    {
        return $this->despesaService->ListarUmaDespesa($id);
    }

    public function atualizarDespesa(LancamentoRequest $request, $id)
    {
        try {
            $lancamento= new Despesa(  $request->get('descricao'),
                                       $request->get('valor'),
                                       new Data ($request->get('data')),
                                       $request->get('categoria'));
                        
            return $this->despesaService->atualizarDespesa($id,$lancamento);

        } catch (DespesaException $e) {
            return new JsonResponse($e->getMessage(),$e->getCode());
        }
    }

    public function deletarDespesa($id):JsonResponse
    {
        $this->despesaService->deletarDespesa($id);
        return new JsonResponse("Despesa excluída.");
    }

    public function listarAnoMes($ano, $mes)
    {
        return $this->despesaService->listarAnoMes($ano,$mes);
    }
}
