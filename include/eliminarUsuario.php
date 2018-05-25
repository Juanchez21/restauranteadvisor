<?php
require_once("config.php");
require_once("classUsuario.php");

if (esAdmin()) {
	if (isset($_GET['id'])){
		$id = $_GET['id'];
		if ($id != $_SESSION['userID']){
			$claseUsuario = new Usuario();
			if($claseUsuario->borrarUsuario($id)){
				echo "¡Usuario eliminado!";
				header("Refresh: 2; url = /usuarios.php");
				exit;
			}
			else {
				echo "No se ha podido eliminar al usuario... Vuelve a intentarlo más tarde.";
				header("Refresh: 2; url = /usuarios.php");
				exit;
			}
		}
		else {
			echo "¡No puedes eliminarte a tí mismo!";
			header("Refresh: 2; url = /usuarios.php");
			exit;
		}
	}
	else {
		echo "Parece que ha habido un error... Vuelve a intentarlo más tarde.";
		header("Refresh: 2; url = /usuarios.php");
		exit;
	}
}
?>