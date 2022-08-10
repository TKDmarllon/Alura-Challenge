<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Models\Despesa;
use App\Service\DespesaService;
use Illuminate\Http\JsonResponse;
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
        $conta= new Despesa($request->all());
        $this->despesaService->criarDespesa($conta);
        return new JsonResponse("Despesa cadastrada.");
    }

    public function listarTodasDespesas()
    {
        return $this->despesaService->listarTodasDespesas();
    }

    public function ListarUmaDespesa($id):Despesa
    {
        return $this->despesaService->ListarUmaDespesa($id);
    }

    public function atualizarDespesa(Request $request, $id)
    {
        $novosDados= [New Request($request->all()),$id];
        $novosDados=$this->despesaService->atualizarDespesa($novosDados);
        return new JsonResponse("Despesa atualizada.");
    }

    public function deletarDespesa($id):JsonResponse
    {
        $this->despesaService->deletarDespesa($id);
        return new JsonResponse("Despesa excluída.");
    }
}
