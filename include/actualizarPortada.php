<?php 
require_once("config.php");
require_once("classRestaurante.php");
$cr = new Restaurante();

if (isset($_GET['id']) && isset($_GET['portada']) && isset($_GET['orden']) ) {
	$id = $_GET['id'];
	$portada = $_GET['portada'];
	$orden = $_GET['orden'];
	echo $portada." ".$orden;
	if ($portada != 1) {
		$orden = 0;
	}
	$result = $cr->actualizarPortada($id, $portada, $orden);
	if(result){
		echo $_REQUEST['data'];
	}
} else {
	exit;
}
?>