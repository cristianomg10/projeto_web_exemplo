<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class AppController extends Controller
{
    function tela_login(){
    	//Exibir tela de login
    	return view('tela_login');
    }

    function login(Request $req){
    	//Comparar usuário e senha
    	$login = $req->input('login');
    	$senha = $req->input('senha');

    	$usuario = Usuario::where('login', '=', $login)->first();
    	// $usuario terá null ou os dados do usuario encontrado

    	if ($usuario and $usuario->senha == $senha){
    		//se nao é null, entra aqui
    		//login e senha estão certos
    		return redirect()->route('listar');
    	} else {
    		return view("resultado", ["mensagem" => "Usuário ou senha inválidos."]);
    	}
    }
}
