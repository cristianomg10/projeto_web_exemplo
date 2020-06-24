<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Produto::select(['id', 'nome', 'descricao', 'preco'])->get();

        //return Produto::selectRaw('id as codigo, nome, descricao, preco')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = json_decode($request->getContent(), 1);

        $produto = new Produto();
        $produto->nome = $dados['nome'];
        $produto->descricao = $dados['descricao'];
        $produto->preco = $dados['preco'];
        $produto->unidade_venda = '';
        $produto->imagem = '';
        $produto->save();

        return $produto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Produto::select(['id', 'nome', 'descricao', 'preco'])
            ->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = json_decode($request->getContent(), 1);

        $produto = Produto::findOrFail($id);
        $produto->nome = $dados['nome'];
        $produto->descricao = $dados['descricao'];
        $produto->preco = $dados['preco'];
        $produto->unidade_venda = '';
        $produto->imagem = '';
        $produto->save();

        return $produto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
    }
}
