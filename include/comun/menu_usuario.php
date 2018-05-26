<div class="menu-usuario">
	Menú
	<?php
	if(isset($_SESSION['sesion']) && $_SESSION['sesion']){
		echo "<ul>";
		if($_SESSION['perfil'] == 1){ // editor
			?>
			<li> <a class="plain-link" href="/verTodos.php"> Ver todos los restaurantes </a>
			</li>
			
			<!--<li> <a class="plain-link" href="/editarRestaurante.php"> Editar restaurante </a>
			</li>-->
			
			<li> <a class="plain-link" href="/anadirRestaurante.php"> Añadir restaurante </a>
			</li>
			<?php
		}
		
		if ($_SESSION['perfil'] == 0) { //administrador
			?>
			<li> <a class="plain-link" href="/usuarios.php"> Gestión de usuarios </a>
			</li>
			
			<li> <a class="plain-link" href="/gestionPortada.php"> Gestión de la portada </a>
			</li>
			<?php
		}
		echo "</ul>";
	}
	else {
		?>
		<p> ¡Vaya! Parece que aún no te has logueado... </p>
		<button class="max-width" onclick=goLogin()>Login</button>
		<p> O aprovecha para registrarte </p>
		<button class="max-width" onclick=goRegister()>Registro</button>
		<?php
	}
	?>
</div>