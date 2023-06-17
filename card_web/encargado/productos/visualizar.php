<?php
// Se incluye el archivo para conectarse a la BD
include '../Configuracion.php';
// Incluye la clase crud y articulo
require_once('crud.php');
require_once('articulo.php');
// Se crean las instancias de las dos clases
$crud= new CrudArticulo();
$articulo=new Articulo();
// Busca el producto por el ID, que es enviado por GET
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
    <title>Detalles del producto</title>
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

<!--Tabla que muestra los detalles de un articulo en especifico-->
<div>
    <h2 align="center">Detalles del Producto</h2>
    <form>
        <div>
            <label>Clave</label>
            <input type="text" value="<?php echo $articulo->getIdProducto()?>" readonly>
        </div>
        <div>
            <label>Nombre</label>
            <input type="text" value="<?php echo $articulo->getNombreProducto()?>" readonly>
        </div>
        <div>
            <label>Descripcion</label>
            <textarea readonly><?php echo $articulo->getDescripcion() ?></textarea>
        </div>
        <div>
            <label>Precio</label>
            <input type="text" value="$<?php echo $articulo->getPrecio() ?>" readonly>
        </div>
        <div>
            <label>Existencia</label>
            <input type="text" value="<?php echo $articulo->getExistencia() ?>" readonly>
        </div>
        <div>
            <label>Estado</label>
            <input type="text" value="<?php echo $articulo->getEstadoProducto() ?>" readonly>
        </div>
        <div>
            <label>Categoria</label>
            <input type="text" value="<?php echo $articulo->getIdCategoria() ?>" readonly>
        </div>
    </form>
</div>
<!--Boton para regresar-->
<a class="volver" href="productos.php">Regresar</a>

</body>
</html>