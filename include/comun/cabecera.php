<?php 
if(!isset($_SESSION['sesion'])){ 
	$nombre = 'Usuario Desconocido'; 
	$fullLine = $nombre.'<a class="plain-link white-link" href="login.php">Login</a>';
} 
else{ 
	$nombre = $_SESSION['nombre'];
	$fullLine = $nombre.'<a class="plain-link white-link" href="/include/logout.php">Salir</a>';
} ?>
<div class="cabecera">
	<ul class="head-menu">
		<li>
			<a class="vertical-centered plain-link white-link" href="index.php">LOGO</a>
		</li>
		<li>
			<a class="vertical-centered plain-link white-link" href="index.php">Inicio</a>
		</li>
		<li>
			<a class="vertical-centered plain-link white-link" href="index.php?categoria=1">Cenas</a>
		</li>
		<li>
			<a class="vertical-centered plain-link white-link" href="index.php?categoria=2">Comidas</a>
		</li>
		<li>
			<a class="vertical-centered plain-link white-link" href="index.php?categoria=3">Desayuno</a>
		</li>
		<li>
			<a class="vertical-centered plain-link white-link" href="index.php?categoria=4">Mejores Precios</a>
		</li>
		<li>
			<a class="vertical-centered plain-link white-link" href="contacto.php">Contacto</a>
		</li>
	</ul>
	
	<div class="saludo vertical-centered"><?php echo $fullLine; ?></div>
</div>
