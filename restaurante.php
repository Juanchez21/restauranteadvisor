<?php
/*Aqui debo saber el id del restaurante que he pinchado para mostrar todo lo relacionado a él*/
//Con un GET o algo así
require_once("include/config.php");
require_once("include/classRestaurante.php");
$restauranteClass = new Restaurante();
if (isset($_GET['id'])) {
	$id_restaurante = $_GET['id'];
}
else {
	header('Location: /index.php');
	exit;
}
/*$restaurante = $restauranteClass->obtenerUnRestaurante($id_restaurante);
$botonEditar = '<form method = "post" action = "editarRestaurante.php?id='.$id_restaurante.'">
						<input type="submit" value="Editar Restaurante"></form>';*/
?>
<!DOCTYPE html>
<html lang="es">
<head> 
	<title>Index</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/scripts.js"></script>
</head>
<body>
	<?php require ('include/comun/cabecera.php');?>
	<div class="cuerpo">
		<?php require ('include/comun/menu_usuario.php');?>
		<div class="portada">
			<?php
				$restauranteClass->mostrarRestaurante($restauranteClass, $id_restaurante);
			?>
		</div>
	</div>
</body>
</html>	