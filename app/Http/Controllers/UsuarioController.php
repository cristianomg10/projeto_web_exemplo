<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Auth;

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

        $req->validate([
            'nome' => 'required|min:10',
            'login' => 'required|alpha|min:8',
            'senha' => 'required|min:6|different:nome|confirmed'
        ]);

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

        foreach ($usuario->vendas as $v){
            $v->delete();
        }

        if ($usuario->delete()){
            $msg = "Usuário $id excluído com sucesso.";
        } else {
            $msg = "Usuário não foi excluído.";
        }

        return view("resultado", [ "mensagem" => $msg]);
    }

    function listar(Request $req){
        $usuarios = null;
        $quantidade = 2;

        if ($req->query('ordem')){
            $ordem = $req->query('ordem');

            $usuarios = Usuario::orderBy($ordem, 'desc');
        }

        if ($req->query('busca')){
            $busca = $req->query('busca');

            if ($usuarios == null){
                $usuarios = Usuario::where('nome', 'LIKE', "%$busca%");
            } else {
                $usuarios = $usuarios->where('nome', 'LIKE', "%$busca%");
            }
            
        } 

        if ($usuarios == null){
            $usuarios = Usuario::paginate($quantidade);
        } else {
            $vetor_parametros = [];
            if (isset($ordem)) {
                $vetor_parametros["ordem"] = $ordem;
            }
            if (isset($busca)){
                $vetor_parametros["busca"] = $busca;
            }

            $usuarios = $usuarios->paginate($quantidade)->appends($vetor_parametros);
        }
        
        return view("lista", [ "us" => $usuarios ]);

        #return redirect()->route('tela_login');
    }
}
