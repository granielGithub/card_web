<?php
// MODULO
	// Clase articulo
	class articulo{
		// Se declaran las variables donde se trataran los datos del articulo (producto)
        private $id_producto; 
		private $nombre_producto;
		private $descripcion;
		private $precio;
		private $existencia;
		private $estado_producto;
		private $imagen_producto;
		private $id_categoria;

		// Funcion constructor vacio
		function __construct()
		{
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

		// Get y Set de descripcion
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

		// Get y Set de imagen_producto
		public function getImagenProducto(){
			return $this->imagen_producto;
		}
		public function setImagenProducto($imagen_producto){
			$this->imagen_producto = $imagen_producto;
		}

		// Get y Set de id_categoria
		public function getIdCategoria(){
			return $this->id_categoria;
		}
		public function setIdCategoria($id_categoria){
			$this->id_categoria = $id_categoria;
		}

	}
?>