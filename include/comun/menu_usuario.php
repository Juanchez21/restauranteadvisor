<div class="menu-usuario">
	Menú
	<?php
	if(isset($_SESSION['sesion']) && $_SESSION['sesion']){
		echo "<ul>";
		if($_SESSION['perfil'] == 1){ // editor
			?>
			<li> <a class="plain-link" href="/verTodos.php"> Ver todos los restaurantes </a>
			</li>
			<br>
			<li> <a class="plain-link" href="/editarRestaurante.php"> Editar restaurante </a>
			</li>
			<br>
			<li> <a class="plain-link" href="/anadirRestaurante.php"> Añadir restaurante </a>
			</li>
			<?php
		}
		
		if ($_SESSION['perfil'] == 0) { //administrador
			?>
			<li> <a class="plain-link" href="/gestionUsuarios.php"> Gestión de usuarios </a>
			</li>
			<br>
			<li> <a class="plain-link" href="/gestionPortada.php"> Gestión de la portada </a>
			</li>
			<?php
		}
		echo "</ul>";
	}
	else {
		?>
		<p> ¡Vaya! Parece que aún no te has logueado... </p>
		<a class="plain-link" href="login.php"><button class="max-width">Login</button></a>
		<p> O aprovecha para registrarte </p>
		<a class="plain-link" href="registro.php"><button class="max-width">Registro</button></a>
		<?php
	}
	?>
</div>