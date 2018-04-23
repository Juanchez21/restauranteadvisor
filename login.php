<?php
require_once("include/config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Index</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<?php require ('include/comun/cabecera.php');?>
	<div class="cuerpo">
		<?php require ('include/comun/menu_usuario.php');?>
		<div class="portada">
			<div class="login-form">
				<form method="post" action="include/validaLogin.php">
				<fieldset>
				<legend>Login</legend>
					<label class="text-left">Usuario: </label>
					<input type="text" placeholder="Usuario" name="login" class="text-right" required>

					<label class="text-left">Contraseña: </label>
					<input type="password" placeholder="Contraseña" name="password" class="text-right" required>
					<br /><br /><br /><button class="botonCompra" type="submit" name="submit">Login</button>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>