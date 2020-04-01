<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Cadastro de usuário</h1>
	<form method="post" action="{{ route('usuario_add') }}">
		@csrf
		<input type="text" name="nome" placeholder="Nome">
		<input type="text" name="login" placeholder="Login">
		<input type="password" name="senha" placeholder="Senha">
		<input type="submit" value="Enviar">
	</form>
</body>
</html>