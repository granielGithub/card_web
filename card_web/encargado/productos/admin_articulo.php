<?php
// MVC

// Se hace uso de las clases Crud y Articulo
require_once('crud.php');
require_once('articulo.php');
// Se crean las instancias de las clases
$crud= new CrudArticulo();
$articulo= new Articulo();

	// Si el elemento insertar no viene nulo llama al crud e inserta un producto
	if (isset($_POST['insertar'])) {
	// ******CARGAR IMAGEN DEL PRODUCTO Y TODOS LOS DATOS DEL PRODUCTO********
		$revisar = getimagesize($_FILES["imagen_producto"]["tmp_name"]);
		if($revisar !== false){
			$image = $_FILES['imagen_producto']['tmp_name'];
			$imgContenido = addslashes(file_get_contents($image));
			
			// Credenciales Mysqli
			$Host = 'localhost';
			$Username = 'root';
			$Password = '';
			$dbName = 'tienda';
			// Crear conexion con la abse de datos
			$db = new mysqli($Host, $Username, $Password, $dbName);
			
			// Cerciorar la conexion
			if($db->connect_error){
				die("Connection failed: " . $db->connect_error);
			}
			
			// Insertar los datos y la imagen en la base de datos
			$insertar = $db->query("INSERT INTO productos (nombre_producto, descripcion, precio, existencia, estado_producto, imagen_producto, id_categoria) VALUES ('$_POST[nombre_producto]', '$_POST[descripcion]', '$_POST[precio]', '$_POST[existencia]', '$_POST[estado_producto]', '$imgContenido', '$_POST[id_categoria]')");

		}else{
			echo "Por favor seleccione imagen a subir.";
		}
		
		// Envia a la pagina de inicio
		header('Location: productos.php');

	// Si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el producto
	}elseif(isset($_POST['actualizar'])){
	// ******ACTUALIZA IMAGEN DEL PRODUCTO Y TODOS LOS DATOS DEL PRODUCTO********
			$image = $_FILES['imagen_producto']['tmp_name'];
			$imgContenido = addslashes(file_get_contents($image));
			
			// Credenciales Mysqli
			$Host = 'localhost';
			$Username = 'root';
			$Password = '';
			$dbName = 'tienda';
			// Crear conexion con la abse de datos
			$db = new mysqli($Host, $Username, $Password, $dbName);
			
			// Cerciorar la conexion
			if($db->connect_error){
				die("Connection failed: " . $db->connect_error);
			}		
			// Actualiza los datos y la imagen en la base de datos
			$actualizar = $db->query("UPDATE productos SET nombre_producto='$_POST[nombre_producto]', descripcion='$_POST[descripcion]', precio='$_POST[precio]', existencia='$_POST[existencia]', estado_producto='$_POST[estado_producto]', imagen_producto='$imgContenido', id_categoria='$_POST[id_categoria]' WHERE id_producto='$_POST[id_producto]' ");
			//$actualizar = $db->query("UPDATE productos SET nombre_producto = '".$_POST['nombre_producto']."', descripcion = '".$_POST['descripcion']."', precio = '".$_POST['precio']."', existencia = '".$_POST['existencia']."', estado_producto = '".$_POST['estado_producto']."'imagen_producto='.$imgContenido.', id_categoria = '".$_POST['id_categoria']."' WHERE id_producto = '".$_POST['id_producto']."' ");

		// Envia a la pagina de inicio
		header('Location: productos.php');

	//ELIMINAR PRODUCTO... AL DAR CLIC EN EL BOTON SE ENVIA UNA RESPUESTA Y AQUI SE RECIBE
	}elseif ($_REQUEST['action'] == 'removeProducto' && !empty($_REQUEST['id_producto'])) {
			$crud->eliminar($_REQUEST['id_producto']);
			// Envia a la pagina de inicio
			header('Location: productos.php');
		// Si la variable accion enviada por GET es == 'a', envía a la página actualizar.php
	}elseif($_POST['accion']=='a'){
			header('Location: actualizar.php');
	}


?>