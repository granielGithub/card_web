<?php
	// Clase Db para usarse de manera global para conectarse a la BD
	class Db{
		// Se crea una variable estatica tipo Nulo y un constructor vacio
		private static $conexion=NULL;
		private function __construct (){}

		// Función para conectarse a la BD mediante PDO
		public static function conectar(){
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			// Se agrega el host, base de datos, usuario y contraseña
			self::$conexion= new PDO('mysql:host=localhost;dbname=tienda','root','',$pdo_options);
			return self::$conexion;
		}
	}
?>