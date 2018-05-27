<?php 
require_once("include/config.php");
require_once("include/classRestaurante.php");

if(esAdmin()) { // estamos logueados como administrador
	$restClass = new Restaurante();
	$arrayRestaurantes = $restClass->obtenerTodosRestaurantes();
	echo 'soy admin';
}
if(esAdmin() && isset($_GET['id']) && isset($_POST['orden'])) {
	echo 'estoy dentro';
		$id = $_GET['id'];
		$orden = $_POST['orden'];
		if(!$restClass->ordenPortada($orden, $id)){
			echo 'Algo ha salido mal';
		}
		else{
			echo 'Se ha modificado el orden ,correctamente';
			header("Refresh: 4; url = portada.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Index</title>
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
			<table class="tabla-usuarios">
				<tr>
					<th>Categoria</th>
					<th>Nombre</th>
					<th>Orden</th>
				</tr>
				<?php
					foreach($arrayRestaurantes as $restauranteDatos){
						$id_rest = $restauranteDatos->getId();
						$botonModificar = "<button type='submit' form='form1' value='submit'>Modificar</button>";
						echo "<tr>";
							echo "<form action='portada.php?id=".$id_rest."&orden=".$restauranteDatos->getOrden()."' method='post' id='form1'>";
							echo "<td>".$restauranteDatos->getCategoria()."</td>";
							echo "<td>".$restauranteDatos->getNombre()."</td>";
							echo "<td><input type='text' name='orden' value ='".$restauranteDatos->getOrden()."'></td>";
							echo "<td>".$id_rest."</td>";
							echo "<td>".$botonModificar."</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</div>
</body>
</html>