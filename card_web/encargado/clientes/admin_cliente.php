<?php
// MVC
// Se incluyen los archivos crud_cliente y cliente para usar sus funciones
require_once('crud_cliente.php');
require_once('cliente.php');
// Se crean dos instantes una para crudCliente y cliente para usarlas
$crud = new CrudCliente();
$cliente= new Cliente();

//ELIMINAR CLIENTE... AL DAR CLIC EN EL BOTON ENVIA UNA RESPUESTA
	if($_REQUEST['action'] == 'removeCliente' && !empty($_REQUEST['id_cliente'])){
		// Envia al crud el ID del cliente y lo elimina
        $crud->eliminar($_REQUEST['id_cliente']);
		// Recarga la misma pagina
		header('Location: clientes.php');
    } else
	echo "Error al eliminar cliente";

 

?>