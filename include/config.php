<?php
session_start();
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

require_once __DIR__.'/classBD.php';

define('BD_HOST', 'sql204.mipropia.com');
define('BD_NAME', 'restauranteadvisor');
define('BD_USER', 'mipc_21978662');
define('BD_PASS', 'RestAdvisor.c0m');

$app = Aplicacion::getSingleton();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

register_shutdown_function(array($app, 'shutdown'));
?>