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
<form method="post" action="{{ route('usuario_passo1') }}" autocomplete="off">
	@csrf
	<input type="text" class="form-control" name="nome" placeholder="Nome" value="{{ old('nome') }}">
    <input type="number" class="form-control" id="cep" name="cep" placeholder="CEP" value="{{ old('cep') }}" onblur="carregaInformacoes()">

    <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro" value="">
    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="">
    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="">
    <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" value="">


	<input type="text" class="form-control" name="login" placeholder="Login" value="{{ old('login') }}">
	<input type="password" class="form-control" name="senha" placeholder="Senha">
    <input type="password" class="form-control" name="senha_confirmation" placeholder="Repita a Senha">

    <div id="resposta"></div>

	<input type="submit" class="btn btn-success" value="Cadastrar">
</form>

<script type="text/javascript">
    function carregaInformacoes(){
        var cep, http;

        cep = document.getElementById("cep").value;

        if (cep != ""){
            http = new XMLHttpRequest();

            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    var dados = JSON.parse(this.responseText);

                    document.getElementById("cidade").value = dados.localidade;
                    document.getElementById("logradouro").value = dados.logradouro;
                    document.getElementById("bairro").value = dados.bairro;
                    document.getElementById("estado").value = dados.uf;
                    document.getElementById("resposta").innerHTML = "";
                } else if (this.readyState != 4){
                    var div = document.createElement("div");
                    div.className = "spinner-border";

                    document.getElementById("resposta").appendChild(div);
                }
            }

            http.open("GET", "http://viacep.com.br/ws/" + cep + "/json/");
            http.send();
        }
    }
</script>
@endsection
