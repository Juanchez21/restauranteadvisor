<?php 
require_once("include/config.php");
require_once("include/classUsuario.php");

if(esAdmin()) { // estamos logueados como administrador
	$userClass = new Usuario();
	$arrayUsuarios = $userClass->obtenerTodos();
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
			<table class="tabla-usuarios">
				<tr>
					<th>Login</th>
					<th>Nombre</th>
					<th>Tipo</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
				<?php
					foreach($arrayUsuarios as $usuarioDatos){
						$tipo = "Editor";
						$botonEditar = "<a href='include/editarUsuario.php?id=".$usuarioDatos->getId()."'>Editar</a>";
						$botonEliminar = "<a href='include/eliminarUsuario.php?id=".$usuarioDatos->getId()."'>Eliminar</a>";;
						echo "<tr>";
							echo "<td>".$usuarioDatos->getLogin()."</td>";
							echo "<td>".$usuarioDatos->getNombre()."</td>";
							if($usuarioDatos->getPerfil() == 0){
								$tipo = "Administrador";
							}
							echo "<td>".$tipo."</td>";
							echo "<td>".$botonEditar."</td>";
							echo "<td>".$botonEliminar."</td>";
						echo "</tr>";
					}
				?>
			</table>
			<a href="/registro.php?add=1"><button> Añadir nuevo usuario </button></a>
		</div>
	</div>
</body>
</html>