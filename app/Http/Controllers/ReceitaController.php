<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Models\Receita;
use App\Service\ReceitaService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
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
        $lancamento= new Receita($request->all());
        $this->receitaService->criarReceita($lancamento);
        return new JsonResponse("Receita cadastrada.");
    }

    public function listarTodasReceitas():Collection
    {
        return $this->receitaService->listarTodasReceitas();
    }

    public function ListarUmaReceita($id):Receita
    {
        return $this->receitaService->listarUmaReceita($id);
    }

    public function atualizarReceita(Request $request, $id)
    {
        $novosDados= [New Request($request->all()),$id];
        return $this->receitaService->atualizarReceita($novosDados);
    }

    public function deletarReceita($id):JsonResponse
    {
        $this->receitaService->deletarReceita($id);
        return new JsonResponse("Receita excluída.");
    }
}