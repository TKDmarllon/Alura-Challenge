<?php

use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\ResumoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

    Route::get("/login", [UserController::class, "logar"]) ->name("login")->middleware('auth.basic');
    Route::post("/login/registro", [UserController::class, "registrar"])->name("login.registrar");
    Route::post("/login/logout", [UserController::class, "deslogar"]) ->name("login.deslogar");

    Route::middleware('autenticacao')->group(function(){

        Route::post("/receita", [ReceitaController::class, "criarReceita"])->name('receita.criar');
        Route::get("/receitas", [ReceitaController::class, "listarTodasReceitas"])->name('receita.todas');
        Route::get("/receitas/{id}", [ReceitaController::class, "listarUmaReceita"])->name('receita.uma');
        Route::put("/receitas/{id}", [ReceitaController::class, "atualizarReceita"])->name('receita.atualizar');
        Route::delete("/receitas/{id}",[ReceitaController::class,"deletarReceita"])->name('receita.deletar');
        Route::get("/receitas/{ano}/{mes}",[ReceitaController::class, "listarAnoMes"])->name('receita.anomes');
        Route::get("/receitas?descricao=xpto",[ReceitaController::class, "listarTodasReceitas"])->name('receita.todasbusca');
    
        Route::get("/resumo/{ano}/{mes}",[ResumoController::class, "resumo"])->name('resumo.resumo');
    
        Route::post("/despesa", [DespesaController::class, "criarDespesa"])->name('despesa.criar');
        Route::get("/despesas", [DespesaController::class, "listarTodasDespesas"])->name('despesa.todas');
        Route::get("/despesas/{id}", [DespesaController::class, "listarUmaDespesa"])->name('despesa.uma');
        Route::put("/despesas/{id}", [DespesaController::class, "atualizarDespesa"])->name('despesa.atualizar');
        Route::delete("/despesas/{id}",[DespesaController::class,"deletarDespesa"])->name('despesa.deletar');
        Route::get("/despesas/{ano}/{mes}",[DespesaController::class, "listarAnoMes"])->name('despesa.anomes');
        Route::get("/despesas?descricao=xpto",[DespesaController::class, "listarTodasDespesas"])->name('despesa.todasbusca');
    });
