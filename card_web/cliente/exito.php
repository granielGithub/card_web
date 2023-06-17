<?php
// Se revisa que se haya realizado un pedido
if(!isset($_REQUEST['id_pedido']))
{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
    <title>Compra Exitosa</title>
</head>
<body>

<!--CABECERA-->
<header>
	<!--Menu de navegación-->
	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="pedidos/pedidos.php">Pedidos</a></li>
			<li><a href="contacto.php">Contacto</a></li>
			<li><a href="perfil.php">Perfil</a></li>
            <li><a href="../index.php">Salir</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

<!--SECCION PRINCIPAL-->
<section class="main">
	<!--SECCION SECUNDARIO-->
	<section>
      <h2 align="center">¡Pago exitoso!</h2> 
      <br>
      <br>
      <br>
      <p class="exito" align="center">Su compra ha sido exitosa. La ID del pedido es #<?php echo $_GET['id_pedido']; ?>.</p>
  </section>
</section>
<!--FIN SECCION-->

</body>
</html>