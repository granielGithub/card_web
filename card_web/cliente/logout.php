<?php
// Se inicia la sesion
session_start();

// Se obtienen los datos de la sesion
$_SESSION = array();

// Se cierra la sesion
session_destroy();

// Redirecciona a la pagina de login
header("location: login.php");
exit;
?>