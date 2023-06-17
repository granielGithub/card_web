<?php
// Se hace uso de la clase crudArticulo y Articulo (productos)
require_once('crud.php');
require_once('articulo.php');
// Se crean dos instancias para usarlas en este archivo
$crud= new CrudArticulo();
$articulo=new Articulo();
// Busca el producto por su ID, que es enviado por GET
$articulo=$crud->obtenerArticulo($_GET['id_producto']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/base.css">
	<link rel="stylesheet" href="../../assets/css/estilos.css">
    <title>Actualizar producto</title>
</head>
<body>
<!--CABECERA-->
<header>
	<!--Menu de navegación-->
	<nav>
		<ul>
			<li><a href="../index.php">Inicio</a></li>
			<li><a href="productos.php">Productos</a></li>
			<li><a href="../clientes/clientes.php">Clientes</a></li>
			<li><a href="../pedidos/pedidos.php">Pedidos</a></li>
            <li><a href="../../index.php">Salir</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->
<h2 align="center">Actualizar datos del producto</h2>
<!--Formulario para atualizar datos del producto-->
<form action='admin_articulo.php' method='post' enctype='multipart/form-data'>
			<input type='hidden' name='id_producto' value='<?php echo $articulo->getIdProducto()?>'> 

			<label for="id_producto">Clave</label>
			<input type="text" value="<?php echo $articulo->getIdProducto()?>" readonly>

			<label for="nombre_producto">Nombre</label>
			<input type='text' name='nombre_producto' value='<?php echo $articulo->getNombreProducto()?>' required>

			<label for="descripcion">Descripcion</label>
			<input type='text' name='descripcion' value='<?php echo $articulo->getDescripcion()?>' required>

			<label for="precio">Precio</label>
			<input type='number' name='precio' value='<?php echo $articulo->getPrecio() ?>' required>

			<label for="existencia">Existencia</label>
			<input type='number' name='existencia' value='<?php echo $articulo->getExistencia() ?>' required>

			<label for="estado_producto">Estado</label>
			<select name="estado_producto" value='<?php echo $articulo->getEstadoProducto()?>' required>
				<option>disponible</option>
				<option>no disponible</option>
				<option>agotado</option>
			</select>
			
			<label for="imagen_producto">Imagen</label>
            <input type="file" id="imagen_producto" name="imagen_producto" multiple required>

			<label for="id_categoria">Categoria</label>
			<select name="id_categoria" value='<?php echo $articulo->getIdCategoria()?>' required>
				<option>1</option>
				<option>2</option>
			</select>
		<!--Input oculto que envia una respuesta "actualizar" a admin_articulo.php-->
		<input type='hidden' name='actualizar' value='a'>
		<!--Input que se muestra para dar clic y enviar los datos-->
		<input class="actualizar" type='submit' value='Actualizar'>
	<!--Boton para regresar-->
	<a class="volverv2" href="productos.php">Regresar</a>
</form>

</body>
</html>