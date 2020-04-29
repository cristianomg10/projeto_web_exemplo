<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Venda;
use App\Produto;

class VendaController extends Controller
{
    function telaCadastro(){
    	$usuarios = Usuario::all();

    	return view("tela_cadastro_venda", 
    		["usuarios" => $usuarios]);
    }

    function adicionar(Request $req){
    	#$valor = $req->input('valor');
    	$id_usuario = $req->input('id_usuario');

    	$venda = new Venda();
    	$venda->valor = 0;# $valor;
    	$venda->id_usuario = $id_usuario;

    	if ($venda->save()){
    		$msg = "Venda adicionada com sucesso.";
    	} else {
    		$msg = "Venda não foi cadastrada.";
    	}

        return redirect()->route('vendas_item_novo', 
            ['id' => $venda->id]);
        //return view("resultado", [ "mensagem" => $msg]);
    }

    function vendasPorUsuario($id){
        /* $id = id do usuario */
        $usuario = Usuario::find($id);
        
        return view('lista_vendas', ["usuario" => $usuario]);
    }

    function listar(){
        $vendas = Venda::all();

        return view('lista_vendas_geral', ['vendas' => $vendas]);
    }

    function itensVenda($id){
        $venda = Venda::find($id);

        return view('lista_itens_venda', ['venda' => $venda]);
    }

    function telaAdicionarItem($id){
        $venda = Venda::find($id);
        $produtos = Produto::all();

        return view('tela_cadastro_itens', 
            ['venda' => $venda, 'produtos' => $produtos]);
    }

    function adicionarItem(Request $req, $id){
        $id_produto = $req->input('id_produto');
        $quantidade = $req->input('quantidade');

        $produto = Produto::find($id_produto);
        $venda = Venda::find($id);
        $subtotal = $produto->preco * $quantidade;

        $colunas_pivot = [
            'quantidade' => $quantidade,
            'subtotal' => $subtotal
        ];

        # Adicionar item à lista e atualizar valor da venda.
        $venda->produtos()->attach($produto->id, $colunas_pivot);
        $venda->valor += $subtotal;
        $venda->save();

        return redirect()->route('vendas_item_novo', 
            ['id' => $venda->id]);
        // $venda->valor = $venda->valor + $subtotal

    }

    function excluirItem($id, $id_pivot){
        $venda = Venda::find($id);
        $subtotal = 0;

        foreach($venda->produtos as $vp){
            if ($vp->pivot->id == $id_pivot){
                $subtotal = $vp->pivot->subtotal;
                break;
            }
        }

        $venda->valor = $venda->valor - $subtotal; 
        $venda->produtos()->wherePivot('id', '=', $id_pivot)->detach();
        $venda->save();

        return redirect()->route('vendas_item_novo', 
            ['id' => $id]);
    }
}
