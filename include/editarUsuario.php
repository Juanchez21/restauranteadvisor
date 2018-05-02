<?php
require_once("config.php");
require_once("classUsuario.php");
require_once("tUsuario.php");

if (esAdmin() && isset($_GET['id']) && !isset($_POST['submit'])) {
	$id = $_GET['id'];
	$classUser = new Usuario();
	$usuarioModificar = $classUser->obtenerUsuario($id);
	if (!$usuarioModificar){
		echo "Algo ha salido mal...";
		header("Location: /usuarios.php");
		exit;
	}
	$radios="";
	if($usuarioModificar->getPerfil() == 0) { // administrador
		$radios.='<label><input type="radio" name="perfil" value="0" checked> administrador</label>
						<label><input type="radio" name="perfil" value="1"> editor</label>';
	}
	else { // editor
		$radios.='<label><input type="radio" name="perfil" value="0"> administrador</label>
						<label><input type="radio" name="perfil" value="1" checked> editor</label>';
	}
} else if (isset($_POST['submit'])) {
	$usuario = new tUsuario();
	$claseUsuario = new Usuario();
	
	$usuario->setId($_POST["id"]);
	$usuario->setLogin($_POST["login"]);
	$usuario->setNombre($_POST["nombre"]);
	$usuario->setContrasena(password_hash($_POST["password"], PASSWORD_DEFAULT));
	$usuario->setPerfil($_POST["perfil"]);
	$error = $claseUsuario->actualizarUsuario($usuario);
	
	header("Location: /usuarios.php");
	exit;
}else{
	echo "Algo ha salido mal...";
	header("Location: /index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Index</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
	<?php require ('comun/cabecera.php');?>
	<div class="cuerpo">
		<?php require ('comun/menu_usuario.php');?>
		<div class="portada">
			<div class="login-form">
				<form method="post" action="editarUsuario.php">
				<fieldset>
				<legend>Editar usuario</legend>
					<label class="text-left">Usuario: </label>
					<input type="text" value="<?php echo $usuarioModificar->getLogin(); ?>" name="login" class="text-right" required>
					<br><br>
					<label class="text-left">Nombre: </label>
					<input type="text" value="<?php echo $usuarioModificar->getNombre(); ?>" name="nombre" class="text-right" required>
					<br><br>
					<label class="text-left">Contraseña: </label>
					<input type="password" placeholder="Contraseña" name="password" class="text-right" required>
					<br><br>
					<label class="text-left">Tipo: </label>
					<div class="text-right">
						<?php echo $radios ?>
					</div>
					<br><br>
					<input type="hidden" value="<?php echo $usuarioModificar->getId(); ?>" name="id" required>
					<button class="max-width" type="submit" name="submit">Editar</button>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>