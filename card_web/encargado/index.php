<?php
include 'Configuracion.php';

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$db->query("SELECT * FROM detalle_venta");
$consulta="SELECT SUM(cantidad_venta) as ProductosVendidos FROM detalle_venta";
$resultado=$db -> query($consulta);
$fila=$resultado->fetch_assoc(); 
$ProductosVendidos=$fila['ProductosVendidos']; 
$_SESSION['sessCustomerID'] = $_SESSION['id_administrador'];
$query = $db->query("SELECT * FROM administrador WHERE id_administrador = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
	<link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/tabla.css">
    <title>SHOP</title>
</head>
<body>
<header>
	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="productos/productos.php">Productos</a></li>
			<li><a href="clientes/clientes.php">Clientes</a></li>
			<li><a href="pedidos/pedidos.php">Pedidos</a></li>
			<li><a href="./mensajes.php">Mensajes</a></li>
            <li><a href="../index.php">Salir</a></li>

		</ul>
	</nav>
</header>
<h2 align="center">Bienvenido <b><?php echo $custRow['nombre']; ?></b>, al panel administrativo.</h2>


<br>


<div>
	<table border=1 class="tabla_ventas">
		<thead>
			<td>Productos vendidos</td>
		</thead>
		<?php
        if($ProductosVendidos > 0){
        ?>
		<tbody>
			<tr>
				<td class="datos"><?php echo $ProductosVendidos; ?></td>			
			</tr>
		</tbody>
		<?php  }else{ ?>
        <tr><td colspan="2"><h4>No existen productos vendidos.</h4></td></tr>
        <?php } ?>

	</table>
</div>
</body>
</html>