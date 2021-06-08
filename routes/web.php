<?php

use Illuminate\Support\Facades\Route;

Route::get('produtos', 'ProdutoController@index')->name('produto.index');
Route::any('produtos/create', 'ProdutoController@create')->name('produto.create');
Route::any('produto/store', 'ProdutoController@store')->name('produto.store');
Route::get('produto/{id}', 'ProdutoController@edit')->name('produto.edit');
Route::any('produto/update/{id}', 'ProdutoController@update')->name('produto.update');
Route::any('produto/delete/{id}', 'ProdutoController@destroy')->name('produto.destroy');

Route::get('/', function () {
    return view('welcome');
});
