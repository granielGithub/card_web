<?php 

// Se incluye el arhivo Configuracion para conectarse a la BD
include 'cliente/Configuracion.php';


/*
// CLIENTE FANTASMA QUE NO EXISTE EN LA BD, SOLO PARA QUE LOS VISITANTES GESTIONEN EL CARRITO
// Se asocia la consulta a la variable $custRow para recorrer los datos
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/base.css">
    <title>SLOW FASHION.</title>
</head>
<body>
<header>	
<center><img  src="logo.png" width="300" height="300"></center>

	<nav>

		<ul>
			<li><a href="index.php">Inicio</a></li>
            <li><a href="encargado/login.php">Gerente</a></li>
            <li><a href="cliente/login.php">Iniciar sesión</a></li>
		</ul>
	</nav>
</header>

<section class="main">
	<section class="articles">
    <div class="lista_productos">
    <h1 align="center">Bienvenido a nuestra tienda.</h1><br>
    <h1 align="center">Productos</h1>
    <div>
        <?php
        //Se obtienen (get) los datos de los productos por medio de una consulta
        $query = $db->query("SELECT * FROM productos ORDER BY id_producto DESC LIMIT 15");
        if($query->num_rows > 0){ 
            //Se asocia la consulta a la variable row
            while($row = $query->fetch_assoc()){
        ?>
        <div class="productos">
            <div>
                <div>
                    <!--Se obtiene la imagen del producto por medio de su ID desde imagen_db.php-->
                    <img src="cliente/imagen_db.php?id_producto=<?php echo $row["id_producto"]; ?>" width="120" height="120"/>
                    <h4 class="nombre_producto"><?php echo $row["nombre_producto"]; ?></h4>
                    <p class="descripcion"><?php echo $row["descripcion"]; ?></p>
                    <div>
                        <div>
                            <p class="precio"><?php echo '$'.$row["precio"].' MXN'; ?></p>
                        </div>
                        <div>
                            <!--Se ejecuta una acción al dar clic sobre el link agregar carrito-->
                            <!--Envia el ID del producto al archivo AccionCarta.php para almacenarlo-->
                            <a class="add_carrito" onclick="alert('INICIE SESION PARA USAR EL CARRITO');">Añadir al carro</a>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }else{ ?>
        <!--Si no existe ningun producto en la BD muestra el sig. mensaje en pantalla-->
        <p align="center">No existen productos.</p>
        <?php } ?>
    
        </div>
    </div>
 
    </div>
    </section>

    
	
</section>

</body>
</html>