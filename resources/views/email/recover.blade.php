<html lang="es">
	<body>
		<h1>{{Session::get('app')}} te Informa.</h1>
		<div>Tu usuario es : {{ $user }}</div>
		<div>Para recuperar tu contraseña ingrea a : <a href="{{ $url }}">Recuperar contraseña {{ $name }}!</a> </div>
	</body>
</html>
