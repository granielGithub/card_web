<?php
// Se incluye el archivo para conectarse a la BD
include '../Configuracion.php';
//SE HACE UNA CONSULTA A PEDIDOS PARA VERIFICAR SI EXISTEN REGISTROS
$db->query("SELECT * FROM pedidos");
$consulta="SELECT SUM(id_pedido) as IdPedido FROM pedidos";
$resultado=$db -> query($consulta);
$fila=$resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
$IdPedido=$fila['IdPedido']; //Este es el valor que acabas de calcular en la consulta

// Icluye la clase CrudPedidos y el pedido
require_once('crud_pedidos.php');
require_once('pedido.php');
// Se crean las instancias de las clases
$crud = new CrudPedido();
$cliente = new Pedido();
// Obtiene todos los pedidos con el método mostrar de la clase crudPedido
$listaPedidos=$crud->mostrar();

// Se mantiene iniciada la sesion en esta pagina
session_start();

// Se revisa si ya hay un usuario logeado, en caso de que no, se le redirecciona a la pagina login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Se da (set) el ID del encargado que inicio la sesión
$_SESSION['sessCustomerID'] = $_SESSION['id_administrador'];
// Se obtienen (get) los detalles del encargado por medio de su ID
$query = $db->query("SELECT * FROM administrador WHERE id_administrador = ".$_SESSION['sessCustomerID']);
// Se asocia la consulta a $custRow para recorrer los datos
$custRow = $query->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/base.css">
	<link rel="stylesheet" href="../../assets/css/estilos.css">
    <title>Pedidos</title>
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
			<li><a href="../mensajes.php">Mensajes</a></li>
            <li><a href="../../index.php">Salir</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

<!--Tabla con el listado de pedidos-->
<h2 align="center">Lista de Pedidos</h2>
<div>
	<table border=1 class="tabla_articulos">
		<thead>
			<td>ID del Pedido</td>
			<td>ID del cliente</td>
      		<td>Nombre del cliente</td>
			<td>Costo Total</td>
			<td>Fecha del Pedido</td>
			<td>Tiempo de Entrega</td>
			<td>Estado del Pedido</td>
			<td>Visualizar</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</thead>
		<tbody>
			<?php
			// Se verifica que haya pedidos
			if($IdPedido > 0){
				// Se recorren los datos y los muestra en pantalla
				foreach ($listaPedidos as $pedido) { ?>
			<tr>
				<td><?php echo $pedido->getIdPedido() ?></td>
				<td><?php echo $pedido->getIdCliente() ?></td>
        		<td><?php echo $pedido->getNombre() ?></td>
				<td><?php echo $pedido->getPrecioTotal() ?></td>
				<td><?php echo $pedido->getFechaPedido() ?></td>
				<td><?php echo $pedido->getTiempoEntrega() ?></td>
				<td><?php echo $pedido->getEstadoPedido() ?></td>
				<!--Botones para visualizar, editar y eliminar pedido-->
				<td><a href="visualizarPedido.php?id_pedido=<?php echo $pedido->getIdPedido()?>"><img class="mostrar" src="../../assets/img/mostrar.png" alt="Visualizar" width="50px" height="50px"></a></td>
				<td><a href="actualizarPedido.php?id_pedido=<?php echo $pedido->getIdPedido()?>&accion=a"><img class="editar" src="../../assets/img/editar.png" alt="Editar" width="40px" height="40px"></a> </td>
				<td><a href="admin_pedido.php?action=removePedido&id_pedido=<?php echo $pedido->getIdPedido()?>" onclick="return confirm('¿Eliminar pedido?')"><img class="eliminar" src="../../assets/img/eliminar.png" alt="eliminar" width="40px" height="40px"></a></td>
			</tr>
			<?php } }else{ ?>
				<tr><td colspan="10"><h4>No existen pedidos</h4></td></tr>
			<?php } ?>
		</tbody>
	</table>
</div>

</body>
</html>