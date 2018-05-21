<?php
session_start();
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

require_once __DIR__.'/classBD.php';

define('BD_HOST', 'sql204.mipropia.com');
define('BD_NAME', 'mipc_21978662_restauranteadvisor');
define('BD_USER', 'mipc_21978662');
define('BD_PASS', 'RestAdvisor.c0m');
// Inicializa la base de datos
$bd = classBD::getSingleton();
$bd->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

register_shutdown_function(array($bd, 'shutdown'));

function esAdmin(){
	if(isset($_SESSION['sesion']) && $_SESSION['sesion'] && $_SESSION['perfil']==0) { // estamos logueados como administrador
		return true;
	}
	else { // no estamos logueados como administrador
		$_SESSION['errorAcceso'] = 'Debes estar logueado como administrador para ver ese contenido';
		header("Location: /login.php");
		exit;
	}
}

function esEditor(){
	if(isset($_SESSION['sesion']) && $_SESSION['sesion'] && $_SESSION['perfil']==1) { // estamos logueados como editor
		return true;
	}
	else { // no estamos logueados como editor
		$_SESSION['errorAcceso'] = 'Debes estar logueado como editor para ver ese contenido';
		header("Location: /login.php");
		exit;
	}
}
?>