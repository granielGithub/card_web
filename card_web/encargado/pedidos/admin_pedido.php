<?php
// MVC
// Se hace uso de las clases crudPedido y pedido
require_once('crud_pedidos.php');
require_once('pedido.php');
// Instancias para hacer uso de crudPedido y Pedido
$crud = new CrudPedido();
$pedido= new Pedido();
// Se revisa que se haya dado clic en el boton actualizar del formulario
if(isset($_POST['actualizar'])){
    // Se mandan los datos de los productos
    $pedido->setIdPedido($_POST['id_pedido']);
    $pedido->setIdCliente($_POST['id_cliente']);
    $pedido->setPrecioTotal($_POST['precio_total']);
    $pedido->setFechaPedido($_POST['fecha_pedido']);
    $pedido->setTiempoEntrega($_POST['tiempo_entrega']);
    $pedido->setEstadoPedido($_POST['estado_pedido']);
    $crud->actualizarPedido($pedido);
    header('Location: pedidos.php');

}elseif($_POST['accion']=='a'){
    header('Location: actualizarPedido.php');
}

//ELIMINAR EL PEDIDO... AL DAR CLIC EN EL BOTON ENVIA UNA RESPUESTA
if($_REQUEST['action'] == 'removePedido' && !empty($_REQUEST['id_pedido'])){
    $crud->eliminar($_REQUEST['id_pedido']);
    //Carga la misma pagina
    header('Location: pedidos.php');
} else
echo "Error al eliminar el pedido";

?>