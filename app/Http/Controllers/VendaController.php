<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Venda;

class VendaController extends Controller
{
    function telaCadastro(){
    	$usuarios = Usuario::all();

    	return view("tela_cadastro_venda", 
    		["usuarios" => $usuarios]);
    }

    function adicionar(Request $req){
    	$valor = $req->input('valor');
    	$id_usuario = $req->input('id_usuario');

    	$venda = new Venda();
    	$venda->valor = $valor;
    	$venda->id_usuario = $id_usuario;

    	if ($venda->save()){
    		$msg = "Venda adicionada com sucesso.";
    	} else {
    		$msg = "Venda não foi cadastrada.";
    	}

        return view("resultado", [ "mensagem" => $msg]);
    }

    function vendasPorUsuario($id){
        /* $id = id do usuario */
        $usuario = Usuario::find($id);
        
        return view('lista_vendas', ["usuario" => $usuario]);
    }
}
