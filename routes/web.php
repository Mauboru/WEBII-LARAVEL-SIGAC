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

// Registro de Alunos - Site (Visitante)
Route::get('/site/register', 'App\Http\Controllers\AlunoController@register')->name('site.register');
Route::post('/site/success', 'App\Http\Controllers\AlunoController@storeRegister')->name('site.submit');
Route::get('/site/index', 'App\Http\Controllers\AlunoController@index')->name('site.index');
// Inserção de Coordenador / Professor (Admin / Coordenador)
Route::get('/users/{role}', 'App\Http\Controllers\UserController@getUsersByRole')->name('users.role');
Route::get('/users/create/{role_id}', 'App\Http\Controllers\UserController@createUsersByRole')->name('users.role.create');
// Avaliação das Solicitações de Horas Afins
Route::get('/assess', 'App\Http\Controllers\DocumentoController@list')->name('assess.list');
Route::put('/assess/{documento_id}', 'App\Http\Controllers\DocumentoController@finish')->name('assess.finish');