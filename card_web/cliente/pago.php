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
	<link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/tabla.css">
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


    <h1 align="center">Vista previa del pedido</h1>
    <br>
    <center><table border="1" class="tabla_articulos">
    <thead>
        <tr>
            <td>Producto</td>
            <td>Precio</td>
            <td>Cantidad</td>
            <td>Sub Total</td>
        </tr>
    </thead>
    
        <?php
        if($carrito->total_productos() > 0){
            // Se obtienen (get) los productos del carrito
            $carritoArticulos = $carrito->contents();
            // Se recorren los datos del producto
            foreach($carritoArticulos as $articulo){
        ?>
        <tr>
        <!--Se muestra en pantalla los datos-->
        
            <td><?php echo $articulo["nombre_producto"]; ?></td>
            <td><?php echo '$'.$articulo["precio"].' MXN'; ?></td>  
            <td><?php echo $articulo["cantidad"]; ?></td>
            <td><?php echo '$'.$articulo["subtotal"].' MXN'; ?></td>    
            <!--boton para actualizar el monto-->


        </tr>

            
        </form>
    </div></td>
        </tr>

        <?php
 
     }
      
      }else{ ?>
        <tr><td colspan="4"><p>No hay articulos en tu carta.</p></td>
        <?php } ?>
    
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <!--Total a pagar obtenida de $carrito->Total-->
            <?php if($carrito->total_productos() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.$carrito->total().' MXN'; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    </center>


    <!--Detalles del cliente que hizo pedido
    <div class="shipAddr">
        <h4>Detalles de envío</h4>
        <p>Nombre:&nbsp;&nbsp;<?php echo $custRow['nombre']; ?></p>
        <p>Apellido paterno:&nbsp;&nbsp;<?php echo $custRow['apellidoPaterno']; ?></p>
        <p>Apellido materno:&nbsp;&nbsp;<?php echo $custRow['apellidoMaterno']; ?></p>
        <p>Correo:&nbsp;&nbsp;<?php echo $custRow['email']; ?></p>
        <p>Teléfono:&nbsp;&nbsp;<?php echo $custRow['telefono']; ?></p>
        <p>calle:&nbsp;&nbsp;<?php echo $custRow['calle']; ?></p>
        <p>numero de casa:&nbsp;&nbsp;<?php echo $custRow['n_casa']; ?></p>
        <p># postal:&nbsp;&nbsp;<?php echo $custRow['codigoPostal']; ?></p>
        <p>mas referencias:&nbsp;&nbsp;<?php echo $custRow['masDetalles']; ?></p>
            -->

    </div>
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
        <h1 align="center">ya casi finaliza :)</h1> <br>
    <!--Formulario de pago con tarjeta-->
    <div class="container">
  <h2>metodos de pago<div class="div_pago"><img src="../assets/img/forma_pago.png" alt="forma de pago" width="128px" height="28px"></div></h2>
  <a class="seguir_comprando" href="pagotranferencia.php">tranferencia</a>
  <a class="seguir_comprando" href="pagotarjeta.php">tarjeta</a>
  <a class="seguir_comprando" href="pagopaypal.php">paypal</a>

</div>


    

	<!--FIN CONTENIDO LATERAL-->

</body>
</html>