<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Entities\Receita;
use App\Service\ReceitaService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use DateTime as Date;

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
        
        $lancamento= new Receita($request->get('descricao'),
                                $request->get('valor'),
                                new Date ($request->get('data')));
        $criado=$this->receitaService->criarReceita($lancamento);
        return new JsonResponse($criado, 201);
    }

    public function listarTodasReceitas():Collection
    {
        return $this->receitaService->listarTodasReceitas();
    }

    public function ListarUmaReceita($id)
    {
        return $this->receitaService->listarUmaReceita($id);
    }

    public function atualizarReceita(Request $request, $id)
    {
        return $this->receitaService->atualizarReceita($id,$request->all());
    }

    public function deletarReceita($id):JsonResponse
    {
        $this->receitaService->deletarReceita($id);
        return new JsonResponse("Receita excluída.");
    }
}