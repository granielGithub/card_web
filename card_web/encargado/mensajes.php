<?php 

	$conexion=mysqli_connect('localhost','root','','tienda');

 ?>


<!DOCTYPE html>
<html>
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
    <header>	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="productos/productos.php">Productos</a></li>
			<li><a href="clientes/clientes.php">Clientes</a></li>
			<li><a href="pedidos/pedidos.php">Pedidos</a></li>
			<li><a href="mensajes.php">Mensajes</a></li>
            <li><a href="../index.php">Salir</a></li>

		</ul>
	</nav></header>

<br>
<center>
	<table border="1" class="tabla_articulos">
		<thead>
			<td>nombre</td>
			<td>telefono</td>
			<td>email</td>
			<td>mensaje</td>	
		</thead>

		<?php 
		$sql="SELECT * from datos";
		$result=mysqli_query($conexion,$sql);

		while($mostrar=mysqli_fetch_array($result)){
		 ?>

		<tr>
			<td><?php echo $mostrar['nombre'] ?></td>
			<td><?php echo $mostrar['telefono'] ?></td>
			<td><?php echo $mostrar['email'] ?></td>
			<td><?php echo $mostrar['mensaje'] ?></td>
		</tr>
	<?php 
	}
	 ?>
	</table>
    </center>
</body>
</html>