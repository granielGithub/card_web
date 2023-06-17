<?php
// Se incluye el archivo para conectarse a la BD
include 'Configuracion.php';
include("registrar.php");  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/contacto.css">
    <title>Contacto</title>
</head>
<body>
<!--CABECERA-->
<header>
	<!--Menu de navegación-->
	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="pedidos/pedidos.php">Pedidos</a></li>
			<li><a href="contacto.php">Contacto</a></li>
			<li><a href="perfil.php">Perfil</a></li>
            <li><a href="../index.php">Salir</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

<!--SECCION-->
<section class="form_wrap">
        <section class="cantact_info">
            <section class="info_title">
                <span class="fa fa-user-circle"></span>
                <h2>¡Contactanos!</h2>
            </section>
            <section class="info_items">
                <p><span class="fa fa-envelope"></span> SistemaWeb@gmail.com</p>
                <p><span class="fa fa-mobile"></span> 902-8665-302</p>
            </section>
        </section>

        <form class="form_contact" action="contacto.php" method="post">
            <h2>Envia un mensaje</h2>
            <div class="user_info">
                <label for="Nombre">Nombre</label>
                <input type="nombre" name="nombre" placeholder="nombre">

                <label for="Celular">telefono</label>
                <input type="telefono" name="telefono" placeholder="telefono">

                <label for="Email">Email</label>
                <input type="email" name="email" placeholder="Email">

                <label for="Mensaje">Mensaje</label>
                <input type="mensaje" name="mensaje" placeholder="mensaje">

                <button class="boton"><input type="submit" name="register"></button>
            </div>
        </form>
</section>
<!--FIN SECCION-->

</body>
</html>