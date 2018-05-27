<?php
require_once ("config.php");
require_once ("classUsuario.php");
$usuario = new Usuario();
$usuario->cerrarSesion();
header("Refresh: 2; url = /index.php");
?>