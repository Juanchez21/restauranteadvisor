<?php 
require_once("include/config.php");
require_once("include/classRestaurante.php");

$restaurantes = new Restaurante();

if(isset($_GET['categoria'])){
	/*dependiendo de la categoria se mostrara los restaurantes*/
	//echo 'La categoria seleccionada: '.$_GET['categoria'];
	$id_categoria = $_GET['categoria'];
	$array_restaurantes = $restaurantes->getRestaurantesByCategoria($id_categoria);
	$subtitulo = 'Correspondientes a la Categoria '.$id_categoria.':';
}
else{
	/*que se muestren todos los destacados*/
	$array_restaurantes = $restaurantes->getAllRestaurantesDestacados();
	$subtitulo = 'Los más destacados son:';
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
			<h1>Restaurantes:</h1>
			<h3><?php echo $subtitulo; ?> </h3>
			
			<!--LA SIGUIENTE FUNCION ES PARA MOSTRAR LO MISMO QUE HAGO AQUI PERO ES PARA QUITAR CODIGO PHP -->
			<!-- <?php 
				//$restaurantes->mostrarRestaurantes($array_restaurantes);
			?> -->

			<?php
			$i = 0;
			$num_total = count($array_restaurantes);
			while($i < $num_total){
			$nombre = $array_restaurantes[$i]->getNombre();
			$imagen = $array_restaurantes[$i]->getImagen();
			$id = $array_restaurantes[$i]->getId();
			//echo $imagen;
			?>
			
			<div class = "contenido">
				<div class = "contenido-restaurante">
					<a href = "restaurante.php?id=<?php echo $id; ?>"><img class = "imagen" src = "<?php echo $imagen; ?>" ></a>
					<div class = "info-restaurante">
					<a href = "restaurante.php?id=<?php echo $id; ?>"><div class = "nombre-restaurante">Nombre: <?php echo $nombre; ?> </div></a>
					<!--<div class = "categoria-restaurante">Categoría: <?php //echo $categoria; ?></div> -->
					</div>
				</div>
				<div class = "comentarios">
					<div class = "text-comentarios">
					<?php echo 'Esto es un comentario'; ?>
					</div>
				</div>	
			</div>

			<?php 
				$i++;}
			?>

			<!--Esta parte de la pagina, cambiarla y preguntar si son dos columnas-->

		</div>
	</div>
</body>
</html>