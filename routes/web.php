<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('site');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::resource('/eixo', 'App\Http\Controllers\EixoController');
Route::resource('/nivel', 'App\Http\Controllers\NivelController');
Route::resource('/curso', 'App\Http\Controllers\CursoController');
Route::resource('/permission', 'App\Http\Controllers\PermissionController');
Route::resource('/turma', 'App\Http\Controllers\TurmaController');
Route::resource('/aluno', 'App\Http\Controllers\AlunoController');
Route::resource('/user', 'App\Http\Controllers\UserController');
Route::resource('/categoria', 'App\Http\Controllers\CategoriaController');
Route::resource('/comprovante', 'App\Http\Controllers\ComprovanteController');
Route::resource('/declaracao', 'App\Http\Controllers\DeclaracaoController');

//Removi essa linha pois com ela ficava dando erro de metodo post
//Route::get('/site/register', 'App\Http\Controllers\AlunoController@register')->name('site.register');
Route::post('/site/register', 'App\Http\Controllers\AlunoController@storeRegister')->name('site.register');