<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form method="post" action="{{ route('logar') }}">
		@csrf
		<input type="text" name="login" placeholder="Login">
		<input type="password" name="senha" placeholder="Senha">
		<input type="submit" value="Acessar">
	</form>
</body>
</html>