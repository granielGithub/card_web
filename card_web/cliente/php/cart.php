<?php
// Se incluye el arhivo Configuracion para conectarse a la BD
include 'Configuracion.php';
//Se incluye el arhivo La-Carta para gestionar el carrito
include 'carrito.php';
//Inicialización de una instancia de Cart (carrito) para usarlo
$carrito = new Carrito;

// Se revisa si ya hay un usuario logeado, en caso de que no, se le redirecciona a la pagina login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Se manda (set) el ID del cliente que inicio la sesión
$_SESSION['sessCustomerID'] = $_SESSION['id_cliente'];
// Se obtienen (get) los detalles del cliente por medio de su ID
$query = $db->query("SELECT * FROM clientes WHERE id_cliente = ".$_SESSION['sessCustomerID']);
// Asociamos la consulta para recorrerla más adelante con la variable $custRow
$custRow = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
    <title>Carrito</title>
</head>

<!--CABECERA-->
<header>
	
	<!--Menu de navegación-->
	<nav>
        <ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="pedidos/pedidos.php">Pedidos</a></li>
			<li><a href="contacto.php">Contacto</a></li>
			<li><a href="perfil.php">Perfil</a></li>
            <li><a href="cart.php">Carrito</a></li>
            <li><a href="../index.php">Salir</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

<body>

<!--Contenido lateral aqui va-->
    <!--CONTENIDO LATERAL-->
	<aside>
	<h3 align="center" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Carrito de Compras</h3>
	<div>
    <table class="pedidos">
    <tbody>
        <?php
        if($carrito->total_productos() > 0){
            //Se obtienen (get) los productos seleccionados de la sesión actual y las almacena en carritoArticulos
            $carritoArticulos = $carrito->contents();
            //Se recorren con un foreach los datos de los productos seleccionados y los almacena en la variable articulo
            foreach($carritoArticulos as $articulo){
        ?>
        <tr>
            <!--Se imprimen en pantalla los datos de los productos agregados al carrito-->
            Producto: <input type="text" value="<?php echo $articulo["nombre_producto"]; ?>" readonly>
            Precio: <input type="text" value="<?php echo '$'.$articulo["precio"].' MXN'; ?>" readonly>
            Cantidad: <input type="number" class="form-control text-center" value="<?php echo $articulo["cantidad"]; ?>" readonly>
            Sub Total: <input type="text" value="<?php echo '$'.$articulo["subtotal"].' MXN'; ?>" readonly> 
        </tr>
        <?php } }else{ ?>
        <!--Si no se ha agregado ningun producto al carrito, se mostrará el sig. mensaje-->
        <tr><td colspan="5"><h3>Sin productos.</h3></td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <?php if($carrito->total_productos() > 0){ ?>
            <!--Se obtiene el total a pagar almacenado en $cart desde La-Carta.php-->
            <td class="total"><h3>Total:</h3><input type="text" value="<?php echo '$'.$carrito->total().' MXN'; ?>" readonly></td>
            <!--Al dar clic en comprar, redirige a la pagina pagos.php para poder comprar y pagar-->
            <br>
            <br>
            <td><a class="comprar" href="pago.php">Comprar</a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
		</div>
	</aside>
	<!--FIN CONTENIDO LATERAL-->

</body>
</html>