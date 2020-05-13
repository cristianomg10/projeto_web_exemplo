@extends('template')

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1>Cadastro de Produto</h1>
<form method="post" action="{{ route('produto_add') }}" enctype="multipart/form-data">
	@csrf
	<input type="text" class="form-control" name="nome" placeholder="Nome" value="{{ old('nome') }}">
	<input type="text" class="form-control" name="descricao" placeholder="Descrição" value="{{ old('descricao') }}">
	<input type="number" step="0.01" class="form-control" name="preco" placeholder="Preço">
  	<input type="file" name="upload" class="form-control">

	<input type="submit" class="btn btn-success" value="Cadastrar">
</form>
@endsection