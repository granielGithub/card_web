<?php
// MVC
// MODULO
// Se incluye el archivo de conexión a la BD
require_once('../conexion.php');
	// Se crea la clase CrudCliente
	class CrudCliente{
		// Constructor de la clase vacia
		public function __construct(){}

		// Función para leer o mostrar los datos del cliente
		public function mostrar(){
			$db=Db::conectar();
			$listaClientes=[];
			// Se hace una consulta a la tabla clientes
			$select=$db->query('SELECT * FROM clientes ORDER BY id_cliente');
			// Se recorren los datos
			foreach($select->fetchAll() as $cliente){
				$myCliente= new Cliente();
				$myCliente->setIdCliente($cliente['id_cliente']);
				$myCliente->setNombre($cliente['nombre']);
				$myCliente->setApellidoPaterno($cliente['apellidoPaterno']);
				$myCliente->setApellidoMaterno($cliente['apellidoMaterno']);
				$myCliente->setEmail($cliente['email']);
				$myCliente->setTelefono($cliente['telefono']);
				$myCliente->setcalle($cliente['calle']);
				$myCliente->setn_casa($cliente['n_casa']);
				$myCliente->setcodigoPostal($cliente['codigoPostal']);
				$myCliente->setmasDetalles($cliente['masDetalles']);
				$myCliente->setUsuario($cliente['usuario']);
				$myCliente->setPassword($cliente['password']);

				$listaClientes[]=$myCliente;

			}
			return $listaClientes;
		}

		// Función para eliminar cliente
		public function eliminar($id_cliente){
			$db=Db::conectar();
			// Se elimina de la tabla clientes
			$eliminar=$db->prepare('DELETE FROM clientes WHERE id_cliente=:id_cliente');
			$eliminar->bindValue('id_cliente',$id_cliente);
			$eliminar->execute();
		}

		// Función para buscar (por si se desea utilizar un buscador)
		public function obtenerCliente($id_cliente){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM clientes WHERE id_cliente=:id_cliente');
			$select->bindValue('id_cliente',$id_cliente);
			$select->execute();
			$cliente=$select->fetch();
			$myCliente= new Cliente();
			$myCliente->setIdCliente($cliente['id_cliente']);
			$myCliente->setNombre($cliente['nombre']);
			$myCliente->setApellidoPaterno($cliente['apellidoPaterno']);
			$myCliente->setApellidoMaterno($cliente['apellidoMaterno']);
			$myCliente->setEmail($cliente['email']);
			$myCliente->setTelefono($cliente['telefono']);
			$myCliente->setcalle($cliente['calle']);
			$myCliente->setn_casa($cliente['n_casa']);
			$myCliente->setcodigoPostal($cliente['codigoPostal']);
			$myCliente->setmasDetalles($cliente['masDetalles']);
			$myCliente->setUsuario($cliente['usuario']);
			$myCliente->setPassword($cliente['password']);

			return $myCliente;
			
		}

	}
?>