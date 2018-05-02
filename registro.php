<?php
require_once("include/config.php");
require_once("include/tUsuario.php");
require_once("include/classUsuario.php");

$locate = "/login.php";

if( (isset($_SESSION['sesion']) && $_SESSION['sesion']) && !esAdmin() ){
	header("Location: /index.php");
	exit;
}

if(isset($_GET['add']) && $_GET['add'] == 1){
	$locate = "/usuarios.php";
}

if(isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['nombre'])&& isset($_POST['password'])	&& isset($_POST['password2'])){
	$usuario = new tUsuario();
	$claseUsuario = new Usuario();
	
	$usuario->setLogin($_POST["login"]);
	$usuario->setNombre($_POST["nombre"]);
	$usuario->setContrasena($_POST["password"]);
	$error = $claseUsuario->validaRegistro($usuario, $_POST['password2']);
	
	if (empty($error)) {// el registro se ha realizado correctamente
		header("Location: ".$locate);
		exit;
	}
}
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
				<?php 
					if (!empty($error)){
						foreach($error as $singleError){
							echo "<div class='error-msg'>".$singleError . "</div>";
						}
					}
				?>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>">
				<fieldset>
				<legend>Registro</legend>
					<label class="text-left">Usuario: </label>
					<input type="text" placeholder="Usuario" name="login" class="text-right" required>
					<br><br>
					<label class="text-left">Nombre: </label>
					<input type="text" placeholder="Nombre" name="nombre" class="text-right" required>
					<br><br>
					<label class="text-left">Contraseña: </label>
					<input type="password" placeholder="Contraseña" name="password" class="text-right" required>
					<br><br>
					<label class="text-left">Confirma Contraseña: </label>
					<input type="password" placeholder="Contraseña" name="password2" class="text-right" required>
					<br><br>
					<button class="max-width" type="submit" name="submit">Registro</button>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>