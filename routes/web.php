<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Api\ClientesController;
use App\Http\Controllers\Api\LocalidadesController;

Route::get('/', function () {
    return view('pages.clientes.index');
})->name('index');

Route::group(['prefix' => 'clientes'], function() {

    Route::get('/list', [PagesController::class, 'listCliente'])->name('pages.clientes.list');
    Route::get('/{cliente}/edit', [PagesController::class, 'editCliente'])->name('pages.clientes.edit');
});

Route::group(['prefix' => 'api'], function() {

    Route::get('/', function () {
        return redirect('api/documentation');
    });

    Route::resource('clientes', ClientesController::class);

    Route::group(['prefix' => 'localidades'], function() {
        Route::get('/estados', [LocalidadesController::class, 'getUfs'])->name('localidades.getUfs');
        Route::get('/{uf}/cidades', [LocalidadesController::class, 'getCidades'])->name('localidades.getCidades');
    });
});
