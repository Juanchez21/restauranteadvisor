<?php 
require_once("include/config.php");
require_once("include/classRestaurante.php");

$restaurantes = new Restaurante();

/*if(isset($_GET['categoria'])){
	//dependiendo de la categoria se mostrara los restaurantes
	//echo 'La categoria seleccionada: '.$_GET['categoria'];
	$id_categoria = $_GET['categoria'];
	$array_restaurantes = $restaurantes->getRestaurantesByCategoria($id_categoria);
	$subtitulo = 'Correspondientes a la Categoria '.$id_categoria.':';
}
else{
	//que se muestren todos los destacados
	$array_restaurantes = $restaurantes->getAllRestaurantesDestacados();
	$subtitulo = 'Los más destacados son:';
}*/

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

			<?php 
			if(isset($_GET['categoria'])){
				$id_categoria = $_GET['categoria'];
				$restaurantes->getRestaurantesByCategoria($id_categoria);
			}else{
				$restaurantes->getAllRestaurantesDestacados(); 
			}
			 ?>
			<!--<h3><?php //echo $subtitulo; ?> </h3>-->
			

			<!--<h2>Basic HTML Table</h2>

			<table style="width:100%">
				<tr>
					<th>Restaurante</th>
					<th>Información</th> 
					<th>Restaurante</th>
					<th>Información</th> 
				</tr>
				<tr>
					<td>Jill</td>
					<td>Smith</td>
					<td>50</td>
					<td>10</td>
				</tr>
				<tr>
					<td>Eve</td>
					<td>Jackson</td>
					<td>94</td>
					<td>10</td>
				</tr>
				<tr>
					<td>John</td>
					<td>Doe</td>
					<td>80</td>
					<td>10</td>
				</tr>

			</table>-->





			<!--LA SIGUIENTE FUNCION ES PARA MOSTRAR LO MISMO QUE HAGO AQUI PERO ES PARA QUITAR CODIGO PHP -->
			<!-- <?php 
				//$restaurantes->mostrarRestaurantes($array_restaurantes);
			?> -->

			<!-- <?php/*
			$i = 0;
			$num_total = count($array_restaurantes);
			while($i < $num_total){
			$nombre = $array_restaurantes[$i]->getNombre();
			//$categoria = $array_restaurantes[$i]->getCategoria();
			$imagen = $array_restaurantes[$i]->getImagen();
			$id = $array_restaurantes[$i]->getId();
			echo $imagen;
			if($i+1 < $num_total){
				$nombre1 = $array_restaurantes[$i+1]->getNombre();
			//$categoria1 = $array_restaurantes[$i]->getCategoria();
				$imagen1 = $array_restaurantes[$i+1]->getImagen();
				$id1 = $array_restaurantes[$i+1]->getId();
			}*/
			?> -->
			<!-- <table id="t1">
				<tr>
					<th>Restaurante</th>
					<?php //if($i+1 < $num_total){ ?>
					<th>Restaurante</th>
					<?php //} ?>
				</tr>
				<tr>
					<td>
						<a href = "restaurante.php?id=<?php //echo $id; ?>"><img class = "imagen" src = "<?php //echo $imagen; ?>" ></a>
						<div class = "info-restaurante">
							<a href = "restaurante.php?id=<?php //echo $id; ?>"><div class ="nombre-restaurante">Nombre: <?php //echo $nombre; ?> </div></a>
							<div class = "categoria-restaurante">Categoría: <?php //echo $categoria; ?></div>
						</div>
					</td>
					<?php //if($i+1 < $num_total){ ?>
					<td>
						<a href = "restaurante.php?id=<?php //echo $id1; ?>"><img class = "imagen" src = "<?php //echo $imagen1; ?>" ></a>
						<div class = "info-restaurante">
							<a href = "restaurante.php?id=<?php //echo $id1; ?>"><div class = "nombre-restaurante">Nombre: <?php //echo $nombre1; ?> </div></a>
							<div class = "categoria-restaurante">Categoría: <?php //echo $categoria1; ?></div>
						</div>
					</td>
					<?php //} ?>
				</tr>
			</table>-->
			

			<!-- <?php 
				//$i=$i+2;}
			?> -->


			<!--<div class = "contenido">
				<div class = "contenido-restaurante">
					<a href = "restaurante.php?id=<?php //echo $id; ?>"><img class = "imagen" src = "<?php //echo $imagen; ?>" ></a>
					<div class = "info-restaurante">
						<a href = "restaurante.php?id=<?php //echo $id; ?>"><div class = "nombre-restaurante">Nombre: <?php //echo $nombre; ?> </div></a>
						<div class = "categoria-restaurante">Categoría: <?php //echo $categoria; ?></div>
					</div>
				</div>
				<div class = "comentarios">
					<div class = "text-comentarios">
						<?php //echo 'Esto es un comentario'; ?>
					</div>
				</div>	
			</div>-->
			<!--Esta parte de la pagina, cambiarla y preguntar si son dos columnas-->

			<h1>Página principal</h1>
			<p> Aquí está la portada, que ya la haremos </p>
			<h1>The position Property</h1>

			<h2>This is a heading with an absolute position</h2>

			<p>With absolute positioning, an element can be placed anywhere on a page. The heading below is placed 100px from the left of the page and 150px from the top of the page.</p>
			<h1>The position Property</h1>

			<h2>This is a heading with an absolute position</h2>

			<p>With absolute positioning, an element can be placed anywhere on a page. The heading below is placed 100px from the left of the page and 150px from the top of the page.</p>
			<h1>The position Property</h1>

			<h2>This is a heading with an absolute position</h2>

			<p>With absolute positioning, an element can be placed anywhere on a page. The heading below is placed 100px from the left of the page and 150px from the top of the page.</p>
			<h1>The position Property</h1>

			<h2>This is a heading with an absolute position</h2>

			<p>With absolute positioning, an element can be placed anywhere on a page. The heading below is placed 100px from the left of the page and 150px from the top of the page.</p>
			<h1>The position Property</h1>

			<h2>This is a heading with an absolute position</h2>

			<p>With absolute positioning, an element can be placed anywhere on a page. The heading below is placed 100px from the left of the page and 150px from the top of the page.</p>
			<h1>The position Property</h1>

			<h2>This is a heading with an absolute position</h2>

			<p>With absolute positioning, an element can be placed anywhere on a page. The heading below is placed 100px from the left of the page and 150px from the top of the page.</p>
			<h1>The position Property</h1>

			<h2>This is a heading with an absolute position</h2>

			<p>With absolute positioning, an element can be placed anywhere on a page. The heading below is placed 100px from the left of the page and 150px from the top of the page.</p>

			
		</div>
	</div>
</body>
</html>