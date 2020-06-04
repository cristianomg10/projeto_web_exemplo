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

<h1>Cadastro de usuário</h1>
<form method="post" action="{{ route('usuario_add') }}">
	@csrf
	<input type="text" class="form-control" name="nome" placeholder="Nome" value="{{ $nome }}">
    <input type="number" class="form-control" name="cep" placeholder="CEP" value="{{ $cep }}">

    <input type="text" class="form-control" name="logradouro" placeholder="Logradouro" value="{{ $logradouro }}">
    <input type="text" class="form-control" name="bairro" placeholder="Bairro" value="{{ $bairro }}">
    <input type="text" class="form-control" name="cidade" placeholder="Cidade" value="{{ $cidade }}">
    <input type="text" class="form-control" name="estado" placeholder="Estado" value="{{ $estado }}">

	<input type="text" class="form-control" name="login" placeholder="Login" value="{{ $login }}">
	<input type="password" class="form-control" name="senha" placeholder="Senha" value="{{ $senha }}">
    <input type="password" class="form-control" name="senha_confirmation" placeholder="Repita a Senha" value="{{ $senha }}">
	<input type="submit" class="btn btn-success" value="Cadastrar">
</form>
@endsection
