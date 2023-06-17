<?php
    // Clase detallePedido
	class detallePedido{
        // Se declaran las variables donde se trataran los datos de detalle_pedido
        private $id_pedido; // Clave del pedido
        private $id_producto; // Clave de cliente
		private $nombre_producto;
		private $descripcion;
		private $precio;
		private $existencia;
        private $estado_producto;
        private $cantidad;

        // Funcion constructor vacio
		function __construct()
		{
		}

        // Get y Set de id_pedido
		public function getIdPedido(){
    		return $this->id_pedido;
		}
		public function setIdPedido($id_pedido){
			$this->id_pedido = $id_pedido;
		}

        // Get y Set de id_producto
        public function getIdProducto(){
            return $this->id_producto;
        }
        public function setIdProducto($id_producto){
            $this->id_producto = $id_producto;
        }

        // Get y Set de nombre_producto
        public function getNombreProducto(){
            return $this->nombre_producto;
        }
        public function setNombreProducto($nombre_producto){
            $this->nombre_producto = $nombre_producto;
        }	

        // Get y Set de descripción
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        // Get y Set de precio
        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }

        // Get y Set de existencia
        public function getExistencia(){
            return $this->existencia;
        }
        public function setExistencia($existencia){
            $this->existencia = $existencia;
        }

        // Get y Set de estado_producto
        public function getEstadoProducto(){
            return $this->estado_producto;
        }
        public function setEstadoProducto($estado_producto){
            $this->estado_producto = $estado_producto;
        }

        // Get y Set de cantidad
        public function getCantidad(){
            return $this->cantidad;
        }
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }
    
	}
?>