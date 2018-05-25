<?php
require_once ("config.php");
require_once ("classUsuario.php");
$usuario = new Usuario();
$usuario->cerrarSesion();
echo 'SE HA CERRADO LA SESION...¡¡¡ HASTA PRONTO..¡¡';
header("Refresh: 2; url = /index.php");
?>