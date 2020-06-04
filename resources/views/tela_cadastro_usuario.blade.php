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
<form method="post" action="{{ route('usuario_passo1') }}">
	@csrf
	<input type="text" class="form-control" name="nome" placeholder="Nome" value="{{ old('nome') }}">
    <input type="number" class="form-control" name="cep" placeholder="CEP" value="{{ old('cep') }}">
	<input type="text" class="form-control" name="login" placeholder="Login" value="{{ old('login') }}">
	<input type="password" class="form-control" name="senha" placeholder="Senha">
    <input type="password" class="form-control" name="senha_confirmation" placeholder="Repita a Senha">
	<input type="submit" class="btn btn-success" value="Cadastrar">
</form>
@endsection
