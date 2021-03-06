<?php
require_once("include/config.php");
require_once("include/classRestaurante.php");
require_once("include/tRestaurante.php");

$categoria1 ="";
$categoria2 ="";
$categoria3 ="";
$categoria4 ="";

if (isset($_GET['id']) && !isset($_POST['submit'])) {
	$id = $_GET['id'];
	$classRest = new Restaurante();
	$restauranteModificar = $classRest->obtenerUnRestaurante($id);
	if (!$restauranteModificar){
		echo "Algo ha salido mal ,no se ha modificado correctamente...";
	}
	
	$arrayCategorias = $classRest->categoriasRestaurante($id);
	if ($arrayCategorias) {
		foreach($arrayCategorias as $categoria) {
			if($categoria==1) $categoria1 ="checked";
			if($categoria==2) $categoria2 ="checked";
			if($categoria==3) $categoria3 ="checked";
			if($categoria==4) $categoria4 ="checked";
		}
	}
}	
	
else{ 
	if (isset($_POST['submit'])) {
	
	if (isset( $_POST['categoria1'] )) $categoria1 = $_POST['categoria1'];
	if (isset( $_POST['categoria2'] )) $categoria2 = $_POST['categoria2'];
	if (isset( $_POST['categoria3'] )) $categoria3 = $_POST['categoria3'];
	if (isset( $_POST['categoria4'] )) $categoria4 = $_POST['categoria4'];
		
	$id_rest = $_POST["id"];
	$restaurante = new tRestaurante();
	$claseRestaurante = new Restaurante();

	$type = 'jpg';
	$perfilFoto = $_FILES['foto']['tmp_name'];
	$name = 'img/'.$id_rest.'.'.$type;
	if(is_uploaded_file($perfilFoto))
	{
		$destino = $name;
		$foto_restaurante = $name;
		copy($perfilFoto, $destino);

	}
	else
	{	
		$classRest = new Restaurante();
		$restauranteModifi = $classRest->obtenerUnRestaurante($id_rest);
		if (!$restauranteModifi){
			echo "Algo ha salido mal acerca de la foto...";
		}
		$foto_restaurante = $restauranteModifi->getImagen();
	}
	
	
	$restaurante->setId($_POST["id"]);
	$restaurante->setApertura($_POST["apertura"]);
	$restaurante->setNombre($_POST["nombre"]);
	$restaurante->setDireccion($_POST["direccion"]);
	$restaurante->setDescripcion($_POST["descripcion"]);
	$restaurante->setTipo($_POST["tipo"]);
	$restaurante->setPrecio($_POST["precio"]);
	$restaurante->setImagen($foto_restaurante);

	$error = $claseRestaurante->actualizarRestaurante($restaurante);
	$claseRestaurante->actualizarCategorias($restaurante->getId(), $categoria1, $categoria2, $categoria3, $categoria4);
	
	header("Location: /restaurante.php?id=$id_rest");
	exit;
}else{
	echo "Algo ha salido mal al enviar los datos...";
	}
}	
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Index</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/scripts.js"></script>
</head>
<body>
	<?php require ('include/comun/cabecera.php');?>
	<div class="cuerpo">
		<?php require ('include/comun/menu_usuario.php');?>
		<div class="portada">
			<div class="login-form">
				<form method="post" action="editarRestaurante.php?id=<?php echo $restauranteModificar->getId(); ?>" enctype="multipart/form-data">
				<fieldset>
				<legend>Editar Restaurante</legend>
					<label class="text-left">Nombre: </label>
					<input type="text" value="<?php echo $restauranteModificar->getNombre(); ?>" name="nombre" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Categorias: </label>
					<div class="text-right"> 
						<label><input type="checkbox" name="categoria1" value="1" <?php echo $categoria1; ?> > Cenas </label>
						<label><input type="checkbox" name="categoria2" value="2" <?php echo $categoria2; ?> > Comidas </label>
						<label><input type="checkbox" name="categoria3" value="3" <?php echo $categoria3; ?> > Desayunos </label>
						<label><input type="checkbox" name="categoria4" value="4" <?php echo $categoria4; ?> > Meriendas </label>
					</div>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Hora de apertura: </label>
					<input type="time" value="<?php echo $restauranteModificar->getApertura(); ?>" name="apertura" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Direccion: </label>
					<input type="text" value="<?php echo $restauranteModificar->getDireccion(); ?>" name="direccion" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Imagen: </label>
					<div><input type="file" name="foto"></div>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Tipo: </label>
					<input type="text" value="<?php echo $restauranteModificar->getTipo(); ?>" name="tipo" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Precio: </label>
					<input type="number" value="<?php echo $restauranteModificar->getPrecio(); ?>" name="precio" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Descripcion: </label>
					<textarea name="descripcion" class="text-right" rows="7" cols="40" required><?php echo $restauranteModificar->getDescripcion(); ?>" 
					</textarea>
					
					<div class="separator-line"></div>
					
					<input type="hidden" value="<?php echo $restauranteModificar->getId(); ?>" name="id">
					<button class="max-width" type="submit" name="submit">Editar</button>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>