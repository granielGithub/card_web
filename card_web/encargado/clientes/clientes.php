<?php
// Se incluye el archivo para la conexión a la BD
include '../Configuracion.php';
//SE HACE UNA CONSULTA A CLIENTES PARA VERIFICAR SI EXISTEN REGISTROS
$db->query("SELECT * FROM clientes");
$consulta="SELECT SUM(id_cliente) as IdCliente FROM clientes";
$resultado=$db -> query($consulta);
$fila=$resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
$IdCliente=$fila['IdCliente']; //Este es el valor que acabas de calcular en la consulta

// Incluimos la clase crudCliente y cliente
require_once('crud_cliente.php');
require_once('cliente.php');
// Se crean las instancias para usarlas en este archivo
$crud = new CrudCliente();
$cliente = new Cliente();
// Obtiene todos los clientes con el método mostrar de la clase crudCliente
$listaClientes=$crud->mostrar();

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
			<li><a href="../productos/productos.php">Productos</a></li>
			<li><a href="clientes.php">Clientes</a></li>
			<li><a href="../pedidos/pedidos.php">Pedidos</a></li>
			<li><a href="../mensajes.php">Mensajes</a></li>
            <li><a href="../../index.php">Salir</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

<!--Se muestran los datos del cliente en una tabla-->
<h2 align="center">Clientes Registrados</h2>
<div>
	<table border=1 class="tabla_articulos">
		<thead>
			<td>Clave</td>
			<td>Nombre</td>
			<td>apellido Paterno</td>
			<td>apellido Materno</td>
			<td>Correo</td>
			<td>Telefono</td>
			<td>calle</td>
			<td>numero de casa</td>
			<td>codigo Postal</td>
			<td>mas Detalles</td>
			<td>Usuario</td>
			<td>Password</td>
			<td>Eliminar</td>
		</thead>
		<tbody>
			<?php
			//Si verifica que haya clientes
			if($IdCliente > 0){
				//Se recorren los datos y los muestra en pantalla
				foreach ($listaClientes as $cliente) { ?>
			<tr>
				<td><?php echo $cliente->getIdCliente() ?></td>
				<td><?php echo $cliente->getNombre() ?></td>
				<td><?php echo $cliente->getApellidoPaterno() ?></td>
				<td><?php echo $cliente->getApellidoMaterno() ?></td>
				<td><?php echo $cliente->getEmail() ?></td>
				<td><?php echo $cliente->getTelefono() ?></td>
				<td><?php echo $cliente->getcalle() ?></td>
				<td><?php echo $cliente->getn_casa() ?></td>
				<td><?php echo $cliente->getcodigoPostal() ?></td>
				<td><?php echo $cliente->getmasDetalles() ?></td>


				<td><?php echo $cliente->getUsuario() ?></td>
				<td><?php echo "*****"?></td>
				<!--Boton para eliminar cliente-->
				<td><a href="admin_cliente.php?action=removeCliente&id_cliente=<?php echo $cliente->getIdCliente()?>" onclick="return confirm('¿Eliminar cliente?')"><img class="eliminar" src="../../assets/img/eliminar.png" alt="eliminar" width="40px" height="40px"></a></td>
			</tr>
			<?php } }else{ ?>
				<tr><td colspan="9"><h4>No existen clientes</h4></td></tr>
			<?php } ?>
		</tbody>
	</table>
</div>

</body>
</html>