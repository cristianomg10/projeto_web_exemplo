<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/sobre', function () {
    return view('welcome');
});

/* Usuarios */

Route::get('/usuario/cadastro', 'UsuarioController@telaCadastro')
	->name('usuario_cadastro');

Route::get('/usuario/alterar/{id}', 'UsuarioController@telaAlteracao')->name('usuario_update');
	
Route::post('/usuario/adicionar', 'UsuarioController@adicionar')
		->name('usuario_add');
Route::post('/usuario/alterar/{id}', 'UsuarioController@alterar')->name('usuario_alterar');

Route::get('/usuario/excluir/{id}', 'UsuarioController@excluir')->name('usuario_delete');

Route::get('/usuario/listar', 'UsuarioController@listar')->name('listar');

/* Vendas */
Route::get('/venda/cadastro', 'VendaController@telaCadastro')
	->name('venda_cadastro');
Route::post('/venda/adicionar', 'VendaController@adicionar')
		->name('venda_add');
Route::get('/venda/usuario/{id}', 'VendaController@vendasPorUsuario')->name('vendas_usuario');

Route::get('/tela_login', 'AppController@tela_login')->name('tela_login');
Route::get('/logout', 'AppController@logout')->name('logout');
Route::post('/login', 'AppController@login')->name('logar');