<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Produto;

class ProdutoController extends Controller
{
    function telaCadastro(){
    	return view('tela_cadastro_produto');
    }

    function listar(){
    	$produtos = Produto::all();

    	return view('lista_produtos', ['produtos' => $produtos]);
    }

    function adicionar(Request $req){
    	$req->validate([
    		'nome' => 'required|min:10',
    		'descricao' => 'required|min:10',
    		'preco' => 'required|numeric',
    		'upload' => 'required|image|max:2048'
    	]);

    	$nome = $req->input('nome');
    	$descricao = $req->input('descricao');
    	$preco = $req->input('preco');
    	$imagem = $req->file('upload');

    	$produto = new Produto();
    	$produto->nome = $nome;
    	$produto->descricao = $descricao;
    	$produto->preco = $preco;
    	$produto->imagem = $nome;
    	$produto->unidade_venda = "";
    	$produto->save();

    	$nome_arquivo = $produto->nome . " " . $produto->id;
    	$nome_arquivo = Str::of($nome_arquivo)->slug('-');
    	$nome_arquivo = $nome_arquivo . "." . $imagem->extension();

    	$nome_arquivo = $imagem->storeAs('imagens_produtos', $nome_arquivo);

    	$produto->imagem = "upload/$nome_arquivo";
    	if ($produto->save()){
    		$msg = "Produto adicionado com sucesso.";
    	} else {
    		$msg = "Produto não foi cadastrado.";
    	}

        return view("resultado", [ "mensagem" => $msg]);
    }
}
