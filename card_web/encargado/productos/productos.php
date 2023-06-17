<?php
// Se incluye el archivo para conectarse a la BD
include '../Configuracion.php';
//SE HACE UNA CONSULTA A PRODUCTOS PARA VERIFICAR SI EXISTEN REGISTROS
$db->query("SELECT * FROM productos");
$consulta="SELECT SUM(id_producto) as IdProducto FROM productos";
$resultado=$db -> query($consulta);
$fila=$resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
$IdProducto=$fila['IdProducto']; //Este es el valor que acabas de calcular en la consulta

// Se hace uso de la clase crud de productos
require_once('crud.php');
// Se hace uso de la clase articulo
require_once('articulo.php');
// Se crean las instancias del crud y el articulo para usarlas
$crud=new CrudArticulo();
$articulo= new Articulo();
// Se obtiene todos los productos con el método mostrar de la clase crud
$listaArticulos=$crud->mostrar();

// Se inicia la sesion como encargado
session_start();
// Se revisa si ya hay un usuario logeado, en caso de que no, se le redirecciona a la pagina login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

// Se da (set) el ID del encargado para iniciar sesión
$_SESSION['sessCustomerID'] = $_SESSION['id_administrador'];
// Se obtiene (get) los detalles del encargado por medio de su ID
$query = $db->query("SELECT * FROM administrador WHERE id_administrador = ".$_SESSION['sessCustomerID']);
// Se asocia la consulta a la variable $custRow para recorrer los datos más adelante
$custRow = $query->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP</title>
    <link rel="stylesheet" href="../../assets/css/base.css">
	<link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<!--CABECERA-->
<header>
	<!--Menu de navegación-->
	<nav>
		<ul>
			<li><a href="../index.php">Inicio</a></li>
			<li><a href="productos.php">Productos</a></li>
			<li><a href="../clientes/clientes.php">Clientes</a></li>
			<li><a href="../pedidos/pedidos.php">Pedidos</a></li>
			<li><a href="../mensajes.php">Mensajes</a></li>
            <li><a href="../../index.php">Salir</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

<h2 align="center">Lista de Productos</h2>

<!--Tabla con detalles principales de los productos-->	
<div>
	<table border=1 class="tabla_articulos">
		<thead>
			<td>Clave</td>
			<td>Nombre</td>
			<td>Precio</td>
			<td>Visualizar</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</thead>
		<tbody>
			<?php
			//Se verifica que haya productos
			if($IdProducto > 0){
				//Se recorren los datos y los muestra en pantalla
				foreach ($listaArticulos as $articulo) { ?>
			<tr>
				<!--Se muestran los datos en pantalla-->
				<td><?php echo $articulo->getIdProducto() ?></td>
				<td><?php echo $articulo->getNombreProducto() ?></td>
				<td>$<?php echo $articulo->getPrecio() ?></td>
				<!--Botones con acciones de visualizar, editar y eliminar-->
				<td><a href="visualizar.php?id_producto=<?php echo $articulo->getIdProducto()?>"><img class="mostrar" src="../../assets/img/mostrar.png" alt="Visualizar" width="50px" height="50px"></a></td>
				<td><a href="actualizar.php?id_producto=<?php echo $articulo->getIdProducto()?>&accion=a"><img class="editar" src="../../assets/img/editar.png" alt="Editar" width="40px" height="40px"></a> </td>
				<!--Boton para eliminar producto-->
				<td><a href="admin_articulo.php?action=removeProducto&id_producto=<?php echo $articulo->getIdProducto()?>" onclick="return confirm('¿Eliminar producto?')"><img class="eliminar" src="../../assets/img/eliminar.png" alt="eliminar" width="40px" height="40px"></a></td>
			</tr>
			<?php } }else{ ?>
				<tr><td colspan="6"><h4>No existen productos</h4></td></tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<!--Boton agregar nuevo producto-->
<a class="agregar" href="ingresar.php">Agregar</a>

</body>
</html>