<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/scripts.js"></script>
	<title>Contacto</title>
</head>
<body>
	<?php require ('include/comun/cabecera.php'); ?>
	<div class="cuerpo">
		<?php require ('include/comun/menu_usuario.php');?>
		<div class="portada">
			<h1>Contacto</h1>
			<fieldset class="formulario-contacto">
				<legend>Formulario de contacto</legend>
				<!--<form action="mailto:restauranteadvisor@gmail.com?subject=Consulta Skyeye: &body=" +Nombre +Email +Evaluación +Sugerencias +Críticas +Acepta +Consulta method="POST" enctype="text/plain"/>-->
				<form action="mailto:restauranteadvisor@gmail.com?subject=Consulta_restauranteadvisor" method="POST" enctype="text/plain">
					<div class="row">
						<h4>Tu nombre:</h4>
						<input name="Nombre" class="input" type="text" value="" size="30" /> <br/>
					</div>
					<div class="row">
						<h4>Tu email:</h4>
						<input name="email" class="input" type="text" value="" size="30" /> <br/>
					</div>
					<div class="row">
						<h4>Motivo de la consulta:</h4>
						<input name = "Motivo_de_la_consulta" type="radio"  value="Si"> Evaluación<br/>
						<input name = "Motivo_de_la_consulta" type="radio"  value="Si"> Sugerencias<br/>
						<input name = "Motivo_de_la_consulta" type="radio"  value="Si"> Críticas
					</div>
					<br/>
					<div class="row">
						<input name ="Acepta" type="checkbox" value="Si">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio<br/><br/>
					</div>
					<div class="row">
						<h4>Tu consulta:</h4>
						<textarea name="Consulta " rows="7" cols="30"></textarea><br/>
					</div>
					<button type="submit">Enviar consulta</button>
				</form>
			</fieldset>
		</div>
	</div>
</body>
</html>