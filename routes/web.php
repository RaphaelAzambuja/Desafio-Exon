<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EstruturaController;
use App\Http\Controllers\RelatorioController;

use Illuminate\Support\Facades\Route;

// Resources geram todas as rotas do crud principal, ademais, caso vá criar um controller coloque a flag "--resource" no final do comando, isso vai deixar setados os metodos do crud
Route::resource('produtos', ProdutoController::class);
Route::resource('estruturas', EstruturaController::class);
Route::resource('relatorios', RelatorioController::class)->except(["store", "create"]);

// produto
Route::get("/", [ProdutoController::class, "index"])->name("produtos.index");

// estrutura
Route::post("/load", [EstruturaController::class, "load"])->name("estrutura.load");

// relatorios
Route::get("/relatorios/materiaprima/{codigo_produto}", [RelatorioController::class, "relatorioMateriaPrima"])->name("relatorios.materiaprima");
Route::post('/relatorios/gerar', [RelatorioController::class, 'gerarRelatorio'])->name('relatorios.gerar');
