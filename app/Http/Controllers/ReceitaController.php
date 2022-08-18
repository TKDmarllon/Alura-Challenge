<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Entities\Receita;
use App\Exceptions\ReceitaException;
use App\Service\ReceitaService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use DateTime as Data;
use Exception;

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

    public function listarTodasReceitas():Collection
    {
        return $this->receitaService->listarTodasReceitas();
    }

    public function ListarUmaReceita($id)
    {
        return $this->receitaService->listarUmaReceita($id);
    }

    public function atualizarReceita(LancamentoRequest $request, $id)
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
}