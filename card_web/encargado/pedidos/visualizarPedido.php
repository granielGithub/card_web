<?php
// Se incluye el archivo para conectarse a la BD
include '../Configuracion.php';
//SE HACE UNA CONSULTA A DETALLE_PEDIDOS PARA VERIFICAR SI EXISTEN REGISTROS
$db->query("SELECT * FROM detalle_pedido");

$consulta="SELECT SUM(id_detalle_pedido) as IdDetallePedido FROM detalle_pedido";
$resultado=$db -> query($consulta);
$fila=$resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
$IdDetallePedido=$fila['IdDetallePedido']; //Este es el valor que acabas de calcular en la consulta

// Incluye la clase crudPedido y detallePedido
require_once('crud_pedidos.php');
require_once('detallePedido.php');
// Se crean las instancias de las clases
$crud= new CrudPedido();
$detallePedido= new detallePedido();
// Busca el detalle_pedido utilizando el ID, que es enviado por GET
$detallePedido= $crud->obtenerDetallePedido($_GET['id_pedido']);
// Se listan los datos de la tabla detalle_pedido
$listaDetallePedido=$crud->mostrarDetallePedido();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/base.css">
	<link rel="stylesheet" href="../../assets/css/estilos.css">
    <title>Visualizar pedido</title>
</head>
<body>

<!--CABECERA-->
<header>
	<!--Menu de navegación-->
	<nav>
		<ul>
			<li><a href="../index.php">Inicio</a></li>
			<li><a href="../productos/productos.php">Productos</a></li>
			<li><a href="../clientes/clientes.php">Clientes</a></li>
			<li><a href="pedidos.php">Pedidos</a></li>
            <li><a href="../../index.php">Salir</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

<!--Tabla con el listado detallado de pedidos-->
<div>
	<table border=1 class="tabla_articulos">
	<h3 align="center">Productos Pedidos</h3>
		<thead>
			<td>ID del Producto</td>
			<td>Nombre</td>
			<td>Descripcion</td>
		</thead>
		<tbody>
			<?php
			// Se verifica que haya registros
			if($IdDetallePedido > 0){
				// Se recorren los datos y los muestra en pantalla
				foreach ($listaDetallePedido as $detallePedido){  ?>
			<!--Se muesta unicamente los detalles del pedido seleccionado-->
            <tr>
                <td><?php echo $detallePedido->getIdProducto()?></td>
				<td><?php echo $detallePedido->getNombreProducto()?></td>
				<td><?php echo $detallePedido->getDescripcion() ?></td>
            </tr>
			<?php }  } else { ?>
				<tr><td colspan="7"><h4>No existen registros.</h4></td></tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<!--Boton de regresar-->
<a class="volver" href="pedidos.php">Regresar</a>

</body>
</html>