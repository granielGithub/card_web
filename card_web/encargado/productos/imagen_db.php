<?php
// Se recibe el ID del producto
if(!empty($_GET['id_producto'])){
    // Credenciales de conexion
    $Host = 'localhost';
    $Username = 'root';
    $Password = '';
    $dbName = 'tienda';
    
    // Crear conexion mysql
    $db = new mysqli($Host, $Username, $Password, $dbName);
    
    // Revisar conexion
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }


// Extraer imagen de la BD mediante GET
$result = $db->query("SELECT imagen_producto FROM productos WHERE id_producto = {$_GET['id_producto']}");
    
if($result->num_rows > 0){
    $imgDatos = $result->fetch_assoc();
    
    // Mostrar Imagen
    header("Content-type: image/jpg"); 
    echo $imgDatos['imagen_producto']; 
}else{
    echo 'Imagen no existe...';
}
}
?>