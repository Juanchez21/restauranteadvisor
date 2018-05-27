<?php 
require_once("include/config.php");
require_once("include/classRestaurante.php");

if(esAdmin()) { // estamos logueados como administrador
	$restaClass = new Restaurante();
	
	if (isset($_POST['submit']) ){
		//lo actualizamos y mostramos un mensajito
		header("Refresh: 2; url = /gestionPortada.php");
		echo 'Actualizada la portada..¡¡¡';
	}
	
	$arrayRestaurantes = $restaClass->obtenerTodos();
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
					<th>Nombre</th>
					<th>Portada</th>
					<th>Posición</th>
					<th>Actualizar</th>
				</tr>
				<?php
					$i = 1;
					foreach($arrayRestaurantes as $restaurante){
						$check = "";
						if($restaurante->getPortada()==1)
							$check = " checked";
						
						echo "<tr>";
							echo "<td>".$restaurante->getNombre()."</td>";
							echo '<td><label><input type="checkbox" id="portada'.$i.'" name="portada" value="1"'.$check.'></label></td>';
							echo '<td><input type="number" id=orden'.$i.' min="0" value="'.$restaurante->getOrden().'" name="orden"></td>';
							echo '<td><button onclick="actualizar('.$restaurante->getId().', '.$i.')"> Actualizar </button></td>';
						echo "</tr>";
						
						$i++;
					}
				?>
			</table>
		</div>
	</div>
</body>
</html>