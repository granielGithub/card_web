<?php
// include database configuration file
include 'Configuracion.php';

// initializ shopping cart class
include 'carrito.php';
$carrito = new Carrito;

// redirect to home if cart is empty
if($carrito->total_productos() <= 0){
    header("Location: index.php");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = $_SESSION['id_cliente'];

// get customer details by session customer ID
$query = $db->query("SELECT * FROM clientes WHERE id_cliente = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/pedidos.css">
   
    <title>Pago</title>
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
	<section class="articles">


    <!--Detalles del cliente que hizo pedido-->
    <div class="shipAddr"><br>
        <h4>Detalles de envío</h4><br>
        <p>Nombre:&nbsp;&nbsp;<?php echo $custRow['nombre']; ?></p>
        <p>Apellido paterno:&nbsp;&nbsp;<?php echo $custRow['apellidoPaterno']; ?></p>
        <p>Apellido materno:&nbsp;&nbsp;<?php echo $custRow['apellidoMaterno']; ?></p>
        <p>Correo:&nbsp;&nbsp;<?php echo $custRow['email']; ?></p>
        <p>Teléfono:&nbsp;&nbsp;<?php echo $custRow['telefono']; ?></p>
        <p>calle:&nbsp;&nbsp;<?php echo $custRow['calle']; ?></p>
        <p>numero de casa:&nbsp;&nbsp;<?php echo $custRow['n_casa']; ?></p>
        <p># postal:&nbsp;&nbsp;<?php echo $custRow['codigoPostal']; ?></p>
        <p>mas referencias:&nbsp;&nbsp;<?php echo $custRow['masDetalles']; ?></p>

    </div>
    <p><img src="paypal.png" width="800px" height="300px"></img></p>

    <div class="footBtn">
        <a class="seguir_comprando" href="index.php">Seguir Comprando</a>
        <a class="seguir_comprando" href="borrarcarro.php">vaciar carrito</a>

    </div>
    </div>
</div>
</section>
</section>
<!--FIN SECCION-->


	<!--CONTENIDO LATERAL-->
	<aside class="">
    <a class="seguir_comprando" href="pago.php">regresar</a>

        <h1 align="center">Pagar con paypal</h1> <br>
    <!--Formulario de pago con tarjeta-->
    <div id="left">
        <form class="form-pago" action='carritoAccion.php?action=Orden' method="post" >
            <div>
                <label for="num_cuenta"> </label>USUARIO:
                <div class="div_pago"><input name="num_cuenta" maxlength="16" placeholder="manertag" value="" required></div>
            </div>
            
            <div>
                <label>CONTRASEÑA: </label>
                <div class="div_pago"><input type="password" placeholder="8 digitos o mas" maxlength="10" name="password" required></div>
            </div>
            <div>
                <input type='hidden' name='insertar' value='insertar'>
                <input class="pagar" type="submit" name="pagar" value="Pagar">
            </div>
        </form>
    </div>
	</aside>


	</aside>





    

	<!--FIN CONTENIDO LATERAL-->

</body>
</html>