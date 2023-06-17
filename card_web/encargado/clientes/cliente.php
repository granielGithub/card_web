<?php
// MODULO
// Clase cliente
	class cliente{
		// Se declaran las variables donde se trataran los datos del cliente
        private $id_cliente;
		private $nombre;
		private $apellidoPaterno;
		private $apellidoMaterno;
		private $email;
		private $telefono;
		private $calle;
		private $n_casa;
		private $codigoPostal;
		private $masDetalles;
		private $usuario;
		private $password;

		// Funcion constructor vacio
		function __construct(){
		}

		// Get y Set de id_cliente
		public function getIdCliente(){
		return $this->id_cliente;
		}
		public function setIdCliente($id_cliente){
			$this->id_cliente = $id_cliente;
		}

		// Get y Set de nombre
		public function getNombre(){
		return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}	

		// Get y Set de apellidoPaterno
		public function getApellidoPaterno(){
			return $this->apellidoPaterno;
		}
		public function setApellidoPaterno($apellidoPaterno){
			$this->apellidoPaterno = $apellidoPaterno;
		}

		// Get y Set de apellidoMaterno
		public function getApellidoMaterno(){
			return $this->apellidoMaterno;
		}
		public function setApellidoMaterno($apellidoMaterno){
			$this->apellidoMaterno = $apellidoMaterno;
		}

		// Get y Set de email
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}

		// Get y Set de telefono
		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		// Get y Set de  calle
		public function getcalle(){
			return $this->calle;
		}
		public function setcalle($calle){
			$this->calle = $calle;
		}

		// Get y Set de  n_casa
		public function getn_casa(){
			return $this->n_casa;
		}
		public function setn_casa($n_casa){
			$this->n_casa = $n_casa;
		}

		// Get y Set de  codigoPostal
		public function getcodigoPostal(){
			return $this->codigoPostal;
		}
		public function setcodigoPostal($codigoPostal){
			$this->codigoPostal = $codigoPostal;
		}

		// Get y Set de  masDetalles
		public function getmasDetalles(){
			return $this->masDetalles;
		}
		public function setmasDetalles($masDetalles){
			$this->masDetalles = $masDetalles;
		}
		// Get y Set de usuario
		public function getUsuario(){
			return $this->usuario;
		}
		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}

		// Get y Set de contraseña
		public function getPassword(){
			return $this->password;
		}
		public function setPassword($password){
			$this->password = $password;
		}
	}
?>