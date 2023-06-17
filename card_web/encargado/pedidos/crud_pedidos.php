<?php
// Incluye la clase para conectarse a la BD
require_once('../conexion.php');
	// Clase CrudPedido
	class CrudPedido{
		// Constructor de la clase vacia
		public function __construct(){
		}

		// Funcion para leer o mostrar los datos
		public function mostrar(){
			$db=Db::conectar();
			$listaPedido=[];
			// Se hace una consulta a la tabla pedidos y clientes
			$select=$db->query('SELECT * FROM pedidos, clientes WHERE pedidos.id_cliente = clientes.id_cliente ORDER BY id_pedido');
			// Se recorren los datos de ambas tablas
			foreach($select->fetchAll() as $pedido){
				$myPedido= new Pedido();
				$myPedido->setIdPedido($pedido['id_pedido']);
				$myPedido->setIdCliente($pedido['id_cliente']);
				$myPedido->setPrecioTotal($pedido['precio_total']);
				$myPedido->setFechaPedido($pedido['fecha_pedido']);
				$myPedido->setTiempoEntrega($pedido['tiempo_entrega']);
				$myPedido->setEstadoPedido($pedido['estado_pedido']);
				$myPedido->setNombre($pedido['nombre']);

				$listaPedido[]=$myPedido;

			}
			return $listaPedido;
		}

		// Funcion para mostrar los detalles del pedido
		public function mostrarDetallePedido(){
			$id_pedido=$_GET["id_pedido"];
			$db=Db::conectar();
			$listaDetallePedido=[];
			// Se hace una consulta a la tabla productos y detalle pedido
			$select=$db->query("SELECT productos.id_producto,productos.nombre_producto,productos.descripcion FROM productos,detalle_pedido 
			                    INNER JOIN pedidos 
								WHERE pedidos.id_pedido = detalle_pedido.id_pedido 
								AND detalle_pedido.id_pedido = '.$id_pedido.'
								AND productos.id_producto = detalle_pedido.id_producto");
			// Se recorren los datos de ambas tablas
			foreach($select->fetchAll() as $detallePedido){
				$myDetallePedido= new detallePedido();
				$myDetallePedido->setIdProducto($detallePedido['id_producto']);
				$myDetallePedido->setNombreProducto($detallePedido['nombre_producto']);
				$myDetallePedido->setDescripcion($detallePedido['descripcion']);
				

				$listaDetallePedido[]=$myDetallePedido;

			}
			return $listaDetallePedido;
		}

		// Funcion eliminar pedido
		public function eliminar($id_pedido){
			$db=Db::conectar();
			// Se elimina de la tabla pedidos
			$eliminar=$db->prepare('DELETE FROM pedidos WHERE id_pedido=:id_pedido');
			$eliminar->bindValue('id_pedido',$id_pedido);
			$eliminar->execute();
			// Se elimina de la tabla detalle_pedido
			$eliminar=$db->prepare('DELETE FROM detalle_pedido WHERE id_pedido=:id_pedido');
			$eliminar->bindValue('id_pedido',$id_pedido);
			$eliminar->execute();
			// Se cancela la transaccion realizada
			$eliminar=$db->prepare('DELETE FROM transaccion WHERE id_pedido=:id_pedido');
			$eliminar->bindValue('id_pedido',$id_pedido);
			$eliminar->execute();
			// Se cancela la venta realizada
			$eliminar=$db->prepare('DELETE FROM ventas WHERE id_pedido=:id_pedido');
			$eliminar->bindValue('id_pedido',$id_pedido);
			$eliminar->execute();
			// Se cancela los detalles de la venta realizada
			$eliminar=$db->prepare('DELETE FROM detalle_venta WHERE id_pedido=:id_pedido');
			$eliminar->bindValue('id_pedido',$id_pedido);
			$eliminar->execute();
		}

		// Funcion para buscar pedidos
		public function obtenerPedido($id_pedido){
			$db=Db::conectar();
			// Se consultan los datos de los pedidos
			$select=$db->prepare('SELECT * FROM pedidos WHERE id_pedido=:id_pedido');
			$select->bindValue('id_pedido',$id_pedido);
			$select->execute();
			// Se recorren los datos
			$pedido=$select->fetch();
			$myPedido= new Pedido();
			$myPedido->setIdPedido($pedido['id_pedido']);
			$myPedido->setIdCliente($pedido['id_cliente']);
			$myPedido->setPrecioTotal($pedido['precio_total']);
			$myPedido->setFechaPedido($pedido['fecha_pedido']);
			$myPedido->setTiempoEntrega($pedido['tiempo_entrega']);
			$myPedido->setEstadoPedido($pedido['estado_pedido']);

			return $myPedido;

		}

		// Funcion para buscar los detalles del pedido
		public function obtenerDetallePedido($id_pedido){
			$db=Db::conectar();
			// Se consultan los datos de la tabla productos y detalle pedido
			$select=$db->prepare("SELECT productos.id_producto,productos.nombre_producto,productos.descripcion FROM productos,detalle_pedido INNER JOIN 
			pedidos WHERE pedidos.id_pedido = detalle_pedido.id_pedido AND detalle_pedido.id_pedido = :id_pedido AND productos.id_producto = detalle_pedido.id_producto");
			
			$select->bindValue('id_pedido',$id_pedido);
			$select->execute();
			// Se recorren los datos de ambas tablas
			$detallePedido=$select->fetch();
			$myDetallePedido= new detallePedido();

			$myDetallePedido->setIdProducto($detallePedido['id_producto']);
			$myDetallePedido->setNombreProducto($detallePedido['nombre_producto']);
			$myDetallePedido->setDescripcion($detallePedido['descripcion']);

			return $myDetallePedido;

		}

		// Funcion para actualizar detalles del pedidos
		public function actualizarPedido($pedido){
			$db=Db::conectar();
			// Se hace un update a la tabla pedidos
			$actualizar=$db->prepare("UPDATE pedidos SET id_cliente=:id_cliente, precio_total=:precio_total, fecha_pedido=:fecha_pedido, tiempo_entrega=:tiempo_entrega, estado_pedido=:estado_pedido WHERE id_pedido=:id_pedido");
			$actualizar->bindValue('id_pedido',$pedido->getIdPedido());
			$actualizar->bindValue('id_cliente',$pedido->getIdCliente());
			$actualizar->bindValue('precio_total',$pedido->getPrecioTotal());
			$actualizar->bindValue('fecha_pedido',$pedido->getFechaPedido());
			$actualizar->bindValue('tiempo_entrega',$pedido->getTiempoEntrega());
			$actualizar->bindValue('estado_pedido',$pedido->getEstadoPedido());
			$actualizar->execute();
		}
	}
?>