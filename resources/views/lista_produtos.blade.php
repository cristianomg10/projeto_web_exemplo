@extends('template')

@section('conteudo')
<h1>Lista de produtos</h1>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Imagem</th>
			<th>ID</th>
			<th>Nome</th>
			<th>Preço</th>
			<th>Operações</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($produtos as $p)
		<tr>
			<td><img src="{{ asset($p->imagem) }}" width="64"></td>
			<td>{{ $p->id }}</td>
			<td>{{ $p->nome }}</td>
			<td>{{ $p->preco }}</td>
			<td>
				<a class="btn btn-danger" href="#" onclick="exclui({{$p->id}})">Excluir</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<a class="btn btn-primary" href="{{ route('produto_cadastro') }}">Cadastrar novo</a>
@endsection