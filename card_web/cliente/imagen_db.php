<?php
if(!empty($_GET['id_producto'])){
    // Variables para guardar datos de conexión
    $Host = 'localhost';
    $Username = 'root';
    $Password = '';
    $dbName = 'tienda';
    
    // Crear conexion mysqli
    $db = new mysqli($Host, $Username, $Password, $dbName);
    
    // Si hay un error manda un mensaje
    if($db->connect_error){
       die("Fallo de conexión: " . $db->connect_error);
    }

//Extraer imagen de la BD imagen_producto mediante GET
$result = $db->query("SELECT imagen_producto FROM productos WHERE id_producto = {$_GET['id_producto']}");
    
if($result->num_rows > 0){
    $imgDatos = $result->fetch_assoc();
    
    //Mostrar Imagen
    header("Content-type: image/jpg"); 
    echo $imgDatos['imagen_producto']; 
}else{
    echo 'Imagen no existente';
}
}
?>