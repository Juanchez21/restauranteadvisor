<?php
/*Aqui debo saber el id del restaurante que he pinchado para mostrar todo lo relacionado a él*/
//Con un GET o algo así
require_once("include/config.php");
require_once("include/classRestaurante.php");
$restaurantes = new Restaurante();
?>

<!DOCTYPE html>
<html lang="es">
<head> 
	<title>Index</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<?php require ('include/comun/cabecera.php');?>
	<div class="cuerpo">
		<?php require ('include/comun/menu_usuario.php');?>
		<div class="portada">
			<h1>Restaurante XXXXX: </h1>
			<!--Toda la informacion relacionada con el restaurante XXXXX-->
			<?php
			$array_restaurantes = $restaurantes->getAllRestaurantesDestacados();
			$i = 0;
			$num_total = count($array_restaurantes);
			while($i < $num_total){
			$nombre = $array_restaurantes[$i]->getNombre();
			$categoria = $array_restaurantes[$i]->getCategoria();
			$imagen = $array_restaurantes[$i]->getImagen();
			?>
			
			<div class = "contenido">
				<div class = "contenido-restaurante">
					<img class = "imagen" src = "<?php echo $imagen; ?>" >
					<div class = "info-restaurante">
					<div class = "nombre-restaurante">Nombre: <?php echo $nombre; ?> </div>
					<div class = "categoria-restaurante">Categoría: <?php echo $categoria; ?></div>
					</div>
				</div>
				<h3> Comentarios de XXXXX: </h3>
				<!-- Comentarios de este restaurante-->
				<div class = "comentarios">
					<div class = "text-comentarios">	
					<?php echo 'Esto es un comentario'; ?>
					</div>
				</div>	
			</div>

			<?php 
				$i++;}
			?>
			
		</div>
	</div>
</body>
</html>	