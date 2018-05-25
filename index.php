<?php 
require_once("include/config.php");
require_once("include/classRestaurante.php");

$restaurantes = new Restaurante();
$categoria = "";
if(isset($_GET['categoria'])) {
	if ($_GET['categoria'] == 1) $categoria = "Cenas";
	else if ($_GET['categoria'] == 2) $categoria = "Comidas";
	else if ($_GET['categoria'] == 3) $categoria = "Desayuno";
	else if ($_GET['categoria'] == 4) $categoria = "Meriendas";
	else {
		$categoria = "Esa categoría no existe. No juegues con las urls's.";
		echo $categoria;
		header('Location: /index.php');
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
			<h1> Restaurantes: <?php echo $categoria; ?></h1>
			<table id="t1">
				<tbody>
				<?php 
					if(isset($_GET['categoria'])) {
						$id_categoria = $_GET['categoria'];
						$restaurantes->getRestaurantesByCategoria($id_categoria);
					} else
						$restaurantes->getAllRestaurantesDestacados(); 
				?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>