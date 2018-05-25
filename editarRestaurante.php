<?php
require_once("include/config.php");
require_once("include/classRestaurante.php");
require_once("include/tRestaurante.php");

/*NOS VIENE UN GET CON EL ID DEL RESTAURANTE, CREO QUE PONDRE QUE EN CADA CONETNEDOR OSE DESDE LA VISTA PERSONAL DEL
RESTAURANTE, APAREZCA UN BOTON DE EDITAR RESTAURANTE Y TAL*/
/*MENCIONAR QUE EL DATE-TIME-LOCAL-SOLO FUNCIONA EN GOOGLE CHROME Y IE EXPLORE CREO , PERO NO FIREFOX*/
/*aunque creo que se refiere a la apertura de hora. osea solo time...xd*/
/*es mas facil..*/

if (isset($_GET['id']) && !isset($_POST['submit'])) {
	$id = $_GET['id'];
	echo 'VAMOS A EDITAR EL RESTURANTE CON IDENTIFICADOR: ' .$id . " ";
	$classRest = new Restaurante();
	$restauranteModificar = $classRest->obtenerUnRestaurante($id);
	if (!$restauranteModificar){
		echo "Algo ha salido mal 1...";
	}
}	
	/*$radios="";
	if($restauranteModificar->getPerfil() == 0) { // administrador
		$radios.='<label><input type="radio" name="perfil" value="0" checked> administrador</label>
						<label><input type="radio" name="perfil" value="1"> editor</label>';
	}
	else { // editor
		$radios.='<label><input type="radio" name="perfil" value="0"> administrador</label>
						<label><input type="radio" name="perfil" value="1" checked> editor</label>';
	}*/
else{ 
	if (isset($_POST['submit'])) {
	$id_rest = $_POST["id"];
	echo $id_rest;
	$restaurante = new tRestaurante();
	$claseRestaurante = new Restaurante();

	/*foto*/
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
	$restaurante->setImagen($foto_restaurante);

	$error = $claseRestaurante->actualizarRestaurante($restaurante);
	
	header("Location: /restaurante.php?id=$id_rest");
	/*exit;*/
}else{
	echo "Algo ha salido mal 2...";
	}
}	
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Index</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
	<?php require ('include/comun/cabecera.php');?>
	<div class="cuerpo">
		<?php require ('include/comun/menu_usuario.php');?>
		<div class="portada">
			<div class="editar-form">
				<form method="post" action="editarRestaurante.php" enctype="multipart/form-data">
				<fieldset>
				<legend>Editar usuario</legend>
					<label class="text-left">Nombre: </label>
					<input type="text" value="<?php echo $restauranteModificar->getNombre(); ?>" name="nombre" class="text-right" required>
					<!--decirle que no debe usar <br> , que lo quite del registro y demas-->
					<label class="text-left">Apertura: </label>
					<!--<input id="datetime" type="datetime-local">-->
					<input type="time" value="<?php echo $restauranteModificar->getApertura(); ?>" name="apertura" class="text-right" required>
					
					<label class="text-left">Direccion: </label>
					<input type="text" value="<?php echo $restauranteModificar->getDireccion(); ?>" placeholder="Contraseña" name="direccion" class="text-right" required>
					
					<label for="exampleInputFile" class="text-left">Imagen: </label>
					<div>
					<input type="file" name="foto">
					</div>
					<label class="text-left">Descripcion: </label>
					<textarea placeholder="Descripcion" name="descripcion" class="text-right" required><?php echo $restauranteModificar->getDescripcion(); ?>" 
					</textarea>
					
					<input type="hidden" value="<?php echo $restauranteModificar->getId(); ?>" name="id" required>
					<button class="max-width" type="submit" name="submit">Editar</button>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>