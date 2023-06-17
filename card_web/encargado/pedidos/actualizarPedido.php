<?php
// Se hace uso de la clase crudPedido y pedido
require_once('crud_pedidos.php');
require_once('pedido.php');
// Se crean dos instancias para usarlas en este archivo
$crud= new CrudPedido();
$pedido=new Pedido();
// Busca el pedido por su ID, que es enviado por GET
$pedido=$crud->obtenerPedido($_GET['id_pedido']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/base.css">
	<link rel="stylesheet" href="../../assets/css/estilos.css">
    <title>Actuailizar pedido</title>
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

<!--Formulario para editar datos del pedido-->
	<form action='admin_pedido.php' method='post'>
		<h1 align="center">Actualizar Estado</h1>
		<!--Se obtienen los datos del pedido y los mantiene en el input-->
		<input type='hidden' name='id_pedido' value='<?php echo $pedido->getIdPedido()?>'> 
		<input type='hidden' name='id_cliente' value='<?php echo $pedido->getIdCliente()?>'> 
		<input type='hidden' name='precio_total' value='<?php echo $pedido->getPrecioTotal()?>'> 
		<input type='hidden' name='fecha_pedido' value='<?php echo $pedido->getFechaPedido()?>'> 
		<input type='hidden' name='tiempo_entrega' value='<?php echo $pedido->getTiempoEntrega()?>'> 
			<!--Se muestran los datos en pantalla pero sin editarlos-->
			<label>ID Pedido:</label>
            <input type="text" value="<?php echo $pedido->getIdPedido()?>" readonly>

			<label>ID Cliente:</label>
            <input type="text" value="<?php echo $pedido->getIdCliente()?>" readonly>

			<label>Costo Total:</label>
			<input type="text" value="<?php echo $pedido->getPrecioTotal()?>" readonly>

			<label>Fecha del Pedido:</label>
			<input type="text" value="<?php echo $pedido->getFechaPedido()?>" readonly>

			<label>Tiempo de Entrega:</label>
			<input type="text" value="<?php echo $pedido->getTiempoEntrega()?>" readonly>

			<!--Solo el estado del pedido podrá ser modificado-->
			<label for="estado_pedido">Estado del Pedido:</label>
			<select name="estado_pedido" value='<?php echo $pedido->getEstadoPedido()?>'>
				<option>pendiente</option>
				<option>entregado</option>
				<option>cancelado</option>
			</select>

		<!--Input oculto que envia una respuesta "a" de actualizar-->
		<input type='hidden' name='actualizar' value='a'>
		<!--Input que se muestra para dar clic y enviar los datos-->
		<input class="actualizar" type='submit' value='Actualizar'>
	<!--Boton para regresar-->
	<a class="volverv2" href="pedidos.php">Regresar</a>
</form>
</body>
</html>