<?php
include 'Configuracion.php';
include 'carrito.php';
$carrito = new Carrito; 

if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
    if($_REQUEST['action'] == 'añadirCarrito' && !empty($_REQUEST['id_producto']))
    {
        $productID = $_REQUEST['id_producto'];
        $query = $db->query("SELECT * FROM productos WHERE id_producto = ".$productID);
        $fila = $query->fetch_assoc();
        $articuloDato = array(
            'id_producto' => $fila['id_producto'],
            'nombre_producto' => $fila['nombre_producto'],
            'precio' => $fila['precio'],
            'cantidad' => 1
        );
        
        $insertArticulo = $carrito->insert($articuloDato);
        $redirectLoc = $insertArticulo?'index.php':'index.php';
        header("Location: ".$redirectLoc);

    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id_producto'])){
        $articuloDato = array(
            '' => $_REQUEST['id_producto'],
            'cantidad' => $_REQUEST['cantidad']
        );
        // Se actualiza la cantidad y el total a pagar
        $updateArticulo = $cart->update($articuloDato);
        echo $updateArticulo?'ok':'err';die;
         }
    elseif($_REQUEST['action'] == 'eliminarArticuloCarrito' && !empty($_REQUEST['id_producto']))
    {//Elimina del carrito el producto especificado
        $eliminarArticulo = $carrito->eliminar($_REQUEST['id_producto']);
        header("Location: index.php");



        //Se efectua esta ultima acción cuando el cliente por fin realiza su pedido
    }
    elseif($_REQUEST['action'] == 'Orden' && $carrito->total_productos() > 0 && !empty($_SESSION['sessCustomerID']))
    {
        /***************INSERTAR DATOS EN LAS TABLA pedidos*******************/
        $insertarOrden = $db->query("INSERT INTO pedidos (id_cliente, precio_total, fecha_pedido, tiempo_entrega, estado_pedido) 
        VALUES ('".$_SESSION['sessCustomerID']."', '".$carrito->total()."', '".date("Y-m-d H:i:s")."', '".("24:00 hrs")."', '".("pendiente")."')");
        
        //Condición. Si se inserta en la tabla "pedidos", de igual forma agregará detalles a la tabla "detalle_pedidos"
        if($insertarOrden)
        {
            /***************INSERTAR DATOS EN LA TABLA detalle_pedido*******************/
            $orderID = $db->insert_id;
            $sql = '';
            //Se obtienen (get) los productos almacenados en el carrito
            $carritoarticulos = $carrito->contents();
            //Recorre los datos y se insertan valores a la tabla detalle_pedido mediante una consulta
            foreach($carritoarticulos as $articulo){
                $sql .= "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES ('".$orderID."', '".$articulo['id_producto']."', '".$articulo['cantidad']."');";
            }
            // Se inserta los detalles del pedido en la base de datos
            $insertarOrdenArticulos = $db->multi_query($sql);



        /***************INSERTAR DATOS EN LAS TABLAS: transaccion, ventas y detalle_ventas*******************/
        //Se revisa que se haya dado clic y se haya recibido la respuesta "insertar" del input del formulario de pago
           //Conexion a la base de datos, por medio de Mysqli
           $Host = 'localhost';
           $Username = 'root';
           $Password = '';
           $dbName = 'tienda';
           //Crear conexion con la abse de datos
           $db = new mysqli($Host, $Username, $Password, $dbName);
           
           //Cerciorar la conexion
           if($db->connect_error)
           {
               die("Conexion fallida: " . $db->connect_error);
           }	

           //Se guarda el total a pagar en una variable
           $total_pagar = $carrito->total();

           //>>>>>>>>>>>>>SE INSERTAN DATOS EN LA TABLA TRANSACCION<<<<<<<<<<<<<<<<<<<<<<<
           $db->query("INSERT INTO transaccion (id_cliente, id_pedido, num_cuenta, referencia, monto) 
                       VALUES ('$_SESSION[sessCustomerID]', '$orderID', '$_POST[num_cuenta]', '4152002827087700', '$total_pagar') ");
           //Guardamos el ID del registro insertado en transaccion
           $id_transaccion = $db->insert_id;


           //>>>>>>>>>>>>SE INSERTAN DATOS EN LA TABLA VENTAS<<<<<<
           //Antes se genera un codigo unico (o folio) para el comprobante de pago
           function generarCodigo($longitud)
           {
            $key = '';
            $pattern = '1234567890';
            $max = strlen($pattern)-1;
           }
           //Aqui se puede cambiar la longuitud del codigo y se guarda en una variable
           $comprobante = generarCodigo(10);

           $db->query("INSERT INTO ventas (id_cliente, id_pedido, num_comprobante, venta_total) 
                       VALUES ('$_SESSION[sessCustomerID]', '$orderID', '$Comprobante', '$total_pagar') ");
           //Guardamos el ID del registro insertado en ventas
           $id_venta = $db->insert_id;


            //>>>>>>>>>>>SE INSERTAN DATOS EN LA TABLA DETALLE_VENTA<<<<
            //Se crea una variable con valor vacio para almacenar multiples consultas
            $sql = '';
            //Se obtiene la cantidad de productos que compró el cliente
            $detalle_venta = $carrito->contents();
            //Recorre los datos con la variable $articulo y se insertan valores a la tabla detalle_pedido mediante una consulta
            foreach($detalle_venta as $articulo){
                $sql .= "INSERT INTO detalle_venta (id_venta, id_pedido, id_producto, cantidad_venta, id_transaccion) 
                         VALUES ('".$id_venta."', '".$orderID."', '".$articulo['id_producto']."', '".$articulo['cantidad']."', '".$id_transaccion."');";

                         
            }
            //Se inserta los detalles del pedido en la base de datos
            $insertarDetalles= $db->multi_query($sql);


        /****************************************FIN*******/


            
            if($insertarOrdenArticulos){
                // Una vez realizado el pedido, se vacia el carrito para hacer un nuevo pedido
                $carrito->destroy();
                // Manda a una pagina mostrando un mensaje de que el pedido se realizo y muestra el ID del pedido
                header("Location: exito.php?id_pedido=$orderID");
            }else{
                header("Location: pago.php");
            }
        }else{
            header("Location: pago.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}

?>