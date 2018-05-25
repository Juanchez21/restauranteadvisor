<?php 
require_once("include/config.php");
require_once("include/classRestaurante.php");

$restaurantes = new Restaurante();

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
			<h1> Todos los Restaurantes:</h1>
			<table id="t1">
				<tbody>
					<?php $restaurantes->obtenerTodosRestaurantes(); ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>