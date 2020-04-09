<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    function telaCadastro(){
    	return view("tela_cadastro_usuario");
    }

    function telaAlteracao($id){
        $usuario = Usuario::find($id);

        return view("tela_alterar_usuario", [ "u" => $usuario ]);
    }

    function adicionar(Request $req){
    	$nome = $req->input('nome');
    	$login = $req->input('login');
    	$senha = $req->input('senha');

    	$usuario = new Usuario();
    	$usuario->nome = $nome;
    	$usuario->login = $login;
    	$usuario->senha = $senha;

    	if ($usuario->save()){
    		$msg = "Usuário $nome adicionado com sucesso.";
    	} else {
    		$msg = "Usuário não foi cadastrado.";
    	}

        return view("resultado", [ "mensagem" => $msg]);
    }

    function alterar(Request $req, $id){
        $usuario = Usuario::find($id);

        $nome = $req->input('nome');
        $login = $req->input('login');
        $senha = $req->input('senha');

        $usuario->nome = $nome;
        $usuario->login = $login;
        $usuario->senha = $senha;

        if ($usuario->save()){
            $msg = "Usuário $nome alterado com sucesso.";
        } else {
            $msg = "Usuário não foi alterado.";
        }

        return view("resultado", [ "mensagem" => $msg]);
    }

    function excluir($id){
        $usuario = Usuario::find($id);

        if ($usuario->delete()){
            $msg = "Usuário $id excluído com sucesso.";
        } else {
            $msg = "Usuário não foi excluído.";
        }

        return view("resultado", [ "mensagem" => $msg]);
    }

    function listar(){
        if (session()->has("login")){
            $usuarios = Usuario::all();

            return view("lista", [ "us" => $usuarios ]);
        }

        return redirect()->route('tela_login');
    }
}
