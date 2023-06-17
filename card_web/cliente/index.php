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

<!--Aqui empieza el HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
    <title>SHOP</title>
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
    <h1 align="center">Bienvenido <b><?php echo $custRow['nombre']; ?></b>, a nuestra tienda.</h1><br>
    <div class="lista_productos">
    <h1 align="center">Añade nuestros productos <b><?php echo $custRow['nombre']; ?></b></h1>
    <div>
        <?php
        //Se obtienen (get) los datos de los productos por medio de una consulta
        $query = $db->query("SELECT * FROM productos ORDER BY id_producto DESC LIMIT 15");
        if($query->num_rows > 0){ 
            //Se asocia la consulta a la variable row
            while($row = $query->fetch_assoc()){
        ?>
        <div class="productos">
            <div>
                <div>
                    <!--Se obtiene la imagen del producto por medio de su ID desde imagen_db.php-->
                    <img src="imagen_db.php?id_producto=<?php echo $row["id_producto"]; ?>" width="100" height="100"/>
                    <h4 class="nombre_producto"><?php echo $row["nombre_producto"]; ?></h4>
                    <p class="descripcion"><?php echo $row["descripcion"]; ?></p>
                    <div>
                        <div>
                            <p class="precio"><?php echo '$'.$row["precio"].' MXN'; ?></p>
                        </div>
                        <div>
                            <!--Se ejecuta una acción al dar clic sobre el link agregar carrito-->
                            <!--Envia el ID del producto al archivo AccionCarta.php para almacenarlo-->
                            <a class="add_carrito" href="carritoAccion.php?action=añadirCarrito&id_producto=<?php echo $row["id_producto"]; ?>">Añadir al carro</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }else{ ?>
        <!--Si no existe ningun producto en la BD muestra el sig. mensaje en pantalla-->
        <p align="center">No existen productos.</p>
        <?php } ?>
    
        </div>
    </div>
    <!--Panel cierra-->
 
    </div>
    </section>

    <!--Contenido lateral aqui va-->
    <!--CONTENIDO LATERAL-->
	<aside>
	<h3 align="center">Carrito de Compras</h3>
	<div>
    <table class="pedidos">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Sub Total</th>
        </tr>
    </thead>
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
            <td><?php echo $articulo["nombre_producto"]; ?></td>
            <td><?php echo '$'.$articulo["precio"].' MXN'; ?></td>
            <td><input type="button" class="form-control text-center" value="<?php echo $articulo["cantidad"];?>"onchange="updateCartItem(this, '<?php echo $articulo["ProductoID_producto"]; ?>')"></td>
            <td><?php echo '$'.$articulo["subtotal"].' MXN'; ?></td>


            <!-- boton de agregar al carrito-->
            <td><a href="carritoAccion.php?action=añadirCarrito&id_producto=<?php echo $articulo["id_producto"]; ?>" values
             onclick="return confirm('¿desea agregar?')"><img src="../assets/img/agregar.png" width="25px" height="25px"></a></a> 


   
            <!--boton de eliminar productos desde el carrito-->
            <a href="carritoAccion.php?action=eliminarArticuloCarrito&id_producto=<?php echo $articulo["ProductoID_producto"]; ?>"values
             onclick="return confirm('¿Eliminar del carrito?')"><img src="../assets/img/basurero.png" width="25px" height="25px"></a>
            </td>

            
        </tr>
        
        <?php } }else{ ?>
        <!--Si no se ha agregado ningun producto al carrito, se mostrará el sig. mensaje-->
        <tr><td colspan="5"><h3>Tu carrito no tiene nada.</h3></td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <?php if($carrito->total_productos() > 0){ ?>
            <!--Se obtiene el total a pagar almacenado en $cart desde La-Carta.php-->
            <td class="total"><strong>Total: <?php echo '$'.$carrito->total().' MXN'; ?></strong></td>
            <!--Al dar clic en comprar, redirige a la pagina pagos.php para poder comprar y pagar-->
            
            
            <td><a class="comprar" href="pago.php">Comprar</a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
		</div>
	</aside>
	<!--FIN CONTENIDO LATERAL-->

</section>
<!--SECCION PRINCIPAL-->

</body>
</html>