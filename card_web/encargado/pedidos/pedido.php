<?php
    // Clase Pedido
	class pedido{
        // Se declaran las variables donde se trataran los datos del pedido
        private $id_pedido; //Clave del pedido
        private $id_cliente; //la clave de cliente
		private $precio_total;
		private $fecha_pedido;
		private $tiempo_entrega;
		private $estado_pedido;
        private $nombre;

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

        // Get y Set de id_cliente
        public function getIdCliente(){
            return $this->id_cliente;
        }
        public function setIdCliente($id_cliente){
            $this->id_cliente = $id_cliente;
        }

        // Get y Set de precio_tota
        public function getPrecioTotal(){
            return $this->precio_total;
            }
        public function setPrecioTotal($precio_total){
            $this->precio_total = $precio_total;
        }

        // Get y Set de fecha_pedido
        public function getFechaPedido(){
            return $this->fecha_pedido;
        }
        public function setFechaPedido($fecha_pedido){
            $this->fecha_pedido = $fecha_pedido;
        }

        // Get y Set de tiempo_entrega
        public function getTiempoEntrega(){
            return $this->tiempo_entrega;
        }
        public function setTiempoEntrega($tiempo_entrega){
            $this->tiempo_entrega = $tiempo_entrega;
        }

        // Get y Set de estado_pedido
        public function getEstadoPedido(){
            return $this->estado_pedido;
        }
        public function setEstadoPedido($estado_pedido){
            $this->estado_pedido = $estado_pedido;
        }

        // Get y Set de nombre
        public function getNombre(){
            return $this->nombre;
            }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }	

	}
?>