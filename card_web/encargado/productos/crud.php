<?php
// MVC
// MODULO

// Incluye la clase para conectarse a la BDs
require_once('../conexion.php');
	// Clase CrudArticulo
	class CrudArticulo{
		// Constructor vacia de la clase
		public function __construct(){}

		// Función para mostrar los datos del producto
		public function mostrar(){
			$db=Db::conectar();
			$listaArticulos=[];
			// Se hace una consulta a la tabla productos
			$select=$db->query('SELECT * FROM productos ORDER BY id_producto');
			// Se recorren los datos del producto
			foreach($select->fetchAll() as $articulo){
				$myArticulo= new Articulo();
				$myArticulo->setIdProducto($articulo['id_producto']);
				$myArticulo->setNombreProducto($articulo['nombre_producto']);
				$myArticulo->setDescripcion($articulo['descripcion']);
				$myArticulo->setPrecio($articulo['precio']);
				$myArticulo->setExistencia($articulo['existencia']);
				$myArticulo->setEstadoProducto($articulo['estado_producto']);
				$myArticulo->setImagenProducto($articulo['imagen_producto']);
				$myArticulo->setIdCategoria($articulo['id_categoria']);
				$listaArticulos[]=$myArticulo;
			}
			return $listaArticulos;
		}

		// Funcion para eliminar producto
		public function eliminar($id_producto){
			$db=Db::conectar();
			// Se elimina de la BD
			$eliminar=$db->prepare('DELETE FROM productos WHERE id_producto=:id_producto');
			$eliminar->bindValue('id_producto',$id_producto);
			$eliminar->execute();
		}

		// Funcion para buscar producto
		public function obtenerArticulo($id_producto){
			$db=Db::conectar();
			// Se consultan los datos de los pedidos
			$select=$db->prepare('SELECT * FROM productos WHERE id_producto=:id_producto');
			$select->bindValue('id_producto',$id_producto);
			$select->execute();
			// Se recorren los datos
			$articulo=$select->fetch();
			$myArticulo= new Articulo();
			$myArticulo->setIdProducto($articulo['id_producto']);
			$myArticulo->setNombreProducto($articulo['nombre_producto']);
			$myArticulo->setDescripcion($articulo['descripcion']);
			$myArticulo->setPrecio($articulo['precio']);
			$myArticulo->setExistencia($articulo['existencia']);
			$myArticulo->setEstadoProducto($articulo['estado_producto']);
			$myArticulo->setImagenProducto($articulo['imagen_producto']);
			$myArticulo->setIdCategoria($articulo['id_categoria']);
			return $myArticulo;
		}

	}
?>