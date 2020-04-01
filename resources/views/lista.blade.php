<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Lista de usuários</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Login</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($us as $u)
			<tr>
				<td>{{ $u->id }}</td>
				<td>{{ $u->nome }}</td>
				<td>{{ $u->login }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>