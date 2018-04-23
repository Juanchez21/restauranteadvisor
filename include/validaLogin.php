<?php
require_once("config.php");
require("classUsuario.php");

if(isset($_POST["login"]) && isset($_POST["password"])) {
	$usuario = new Usuario;
	
	$locate = "/login.php";

	$usernameU = $_POST["login"];
	$passwordU = $_POST["password"];

	$result = $usuario->validaLogin($usernameU, $passwordU, $bd->conexionBd());
	if($result == 0){
		$locate = "/index.php";
	}
	else
		$locate = "/login.php?errorno=".$result;
}
header('Location: '.$locate);
?>