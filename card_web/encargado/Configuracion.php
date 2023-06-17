<?php
// Variables para almacenar los valores para conectarse a la BD
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'tienda';

// Se crea una variable $db para conectarse mediante mysqli
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Si existe un error al conectarse, mostrara un mensaje
if ($db->connect_error) {
    die("No hay conexion con la base de datos: " . $db->connect_error);
} 

?>