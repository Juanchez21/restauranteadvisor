<?php
require_once("include/config.php");
require_once("include/tRestaurante.php");
require_once("include/classRestaurante.php");

if( !esEditor()){
	header("Location: /index.php");
	exit;
}

if(isset($_GET['edit']) && $_GET['edit'] == 1){
	$locate = "/restaurantes.php";
}

if(isset($_POST['submit']) ){
	$restaurante = new tRestaurante();
	$claseRestaurante = new Restaurante();
	
	$restaurante->setNombre($_POST["nombre"]);
	$restaurante->setApertura($_POST["apertura"]);
	$restaurante->setDireccion($_POST["direccion"]);
	if (isset($_POST["imagen"]))
		$restaurante->setImagen($_POST["imagen"]);
	else
		$restaurante->setImagen("noimage.jpg");
	$restaurante->setTipo($_POST["tipo"]);
	$restaurante->setPrecio($_POST["precio"]);
	$restaurante->setEditor($_SESSION['userID']);
	$restaurante->setPortada($_POST["portada"]);
	$restaurante->setDescripcion($_POST["descripcion"]);
	//categorias
	$categoria1=$_POST["categoria1"]; $categoria2=$_POST["categoria2"]; $categoria3=$_POST["categoria3"]; $categoria4=$_POST["categoria4"];
	
	$error = $claseRestaurante->validaRestaurante($restaurante, $categoria1, $categoria2, $categoria3, $categoria4);
	
	if (isset($locate)) {// venimos de editar restaurante
		header("Location: ".$locate);
		exit;
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
			<div class="login-form">
				<?php 
					if (!empty($error)){
						foreach($error as $singleError){
							echo "<div class='error-msg'>".$singleError . "</div>";
						}
					}
				?>
				<form method="post" action="anadirRestaurante.php" enctype="multipart/form-data">
				<fieldset>
				<legend>Añadir Restaurante</legend>
					<label class="text-left">Nombre: </label>
					<input type="text" placeholder="Restaurante" name="nombre" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Categorias: </label>
					<div class="text-right"> 
						<label><input type="checkbox" name="categoria1" value="1"> Cenas </label>
						<label><input type="checkbox" name="categoria2" value="2"> Comidas </label>
						<label><input type="checkbox" name="categoria3" value="3"> Desayunos </label>
						<label><input type="checkbox" name="categoria4" value="4"> Meriendas </label>
					</div>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Hora de apertura: </label>
					<input type="time" name="apertura" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Direccion: </label>
					<input type="text" placeholder="Direccion" name="direccion" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Imagen: </label>
					<input type="file" name="imagen" class="text-right">
					
					<div class="separator-line"></div>
					
					<label class="text-left">Tipo: </label>
					<input type="text" placeholder="Tipo de comida" name="tipo" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Precio: </label>
					<input type="number" placeholder="Precio" name="precio" class="text-right" required>
					
					<div class="separator-line"></div>
					
					<label>Destacar <input type="checkbox" name="portada" value="1"></label>
					
					<div class="separator-line"></div>
					
					<label class="text-left">Descripcion: </label>
					<textarea placeholder="Descripcion del Restaurante..." name="descripcion" class="text-right" rows="7" cols="40" required></textarea>
					
					<div class="separator-line"></div>
					
					<button class="max-width" type="submit" name="submit">Añadir Restaurante</button>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>