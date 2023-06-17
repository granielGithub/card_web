<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/base.css">
	<link rel="stylesheet" href="../../assets/css/estilos.css">
    <title>Ingresar producto</title>
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

<h2 align="center">Ingresar nuevo producto</h2>
<!--Formulario para ingresar un nuevo producto-->
<form action='admin_articulo.php' method='post' enctype='multipart/form-data' class="ingresar_articulo">

			<label for="nombre_producto">Nombre:</label>
			<input type='text' name='nombre_producto' placeholder="Nombre del producto" required>

			<label for="descripcion">Descripcion</label>
			<input type='text' name='descripcion' placeholder="Descripcion del producto" required>

			<label for="precio">Precio</label>
			<input type='number' name='precio' placeholder="Precio del producto" required>

			<label for="existencia">Existencia</label>
			<input type='number' name='existencia' placeholder="Existencias del producto" required>

			<label for="estado_producto">Estado</label>
			<select name="estado_producto" required>
				<option></option>
				<option>disponible</option>
				<option>no disponible</option>
				<option>agotado</option>
			</select>

          	<label for="imagen_producto">Imagen</label>
            <input type="file" id="imagen_producto" name="imagen_producto" multiple>

			<label for="id_categoria">Categoria</label>
			<select name="id_categoria" required>
				<option></option>
				<option>1</option>
				<option>2</option>
			</select>
		<!--Input oculto que envia el valor insertar al admin_articulo.php-->
		<input type='hidden' name='insertar' value='insertar'>
		<!--Input submit que al dar clic envie los datos-->
		<input class="ingresar" type='submit' value='Guardar'>
	<!--Boton para regresar-->
	<a class="volverv2" href="productos.php">Regresar</a>
</form>

</body>
</html>