<?php

use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ReceitaController;
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


    Route::post("/receita", [ReceitaController::class, "criarReceita"]);
    Route::get("/receitas", [ReceitaController::class, "listarTodasReceitas"]);
    Route::get("/receitas/{id}", [ReceitaController::class, "listarUmaReceita"]);
    Route::put("/receitas/{id}", [ReceitaController::class, "atualizarReceita"]);
    Route::delete("/receitas/{id}",[ReceitaController::class,"deletarReceita"]);


    Route::post("/despesa", [DespesaController::class, "criarDespesa"]);
    Route::get("/despesas", [DespesaController::class, "listarTodasDespesas"]);
    Route::get("/despesas/{id}", [DespesaController::class, "listarUmaDespesa"]);
    Route::put("/despesas/{id}", [DespesaController::class, "atualizarDespesa"]);
    Route::delete("/despesas/{id}",[DespesaController::class,"deletarDespesa"]);