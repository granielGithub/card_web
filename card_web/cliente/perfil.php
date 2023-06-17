<?php
// Se incluye la conexión a la BD
include 'Configuracion.php';
//Se solicita el php
require_once "php/perfil.php";
?>

<!--AQUI EMPIEZA EL HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <title>Perfil</title>
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

<!--SECCION PRINCIPAL-->
<section class="main">
	<!--SECCION SECUNDARIO-->
	<section>
    <h2 align="center">Perfil del Cliente</h2>
    <!--Datos generales del cliente-->
    <form action="perfil.php" method="post">
        <div>
            <label>Usuario</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION["usuario"]); ?>" readonly>
        </div>
        <div>
            <label>Nombre</label>
            <input type="text" value="<?php echo $custRow['nombre']; ?>" readonly>
        </div>
        <div>
           
            <label>Apellido paterno</label>
            <input type="text" value="<?php echo $custRow['apellidoPaterno']; ?>" readonly>
            <label>Apellido materno</label>
            <input type="text" value="<?php echo $custRow['apellidoMaterno']; ?>" readonly>
        </div>
        <div>
            <label>Correo</label>
            <input type="text" value="<?php echo $custRow['email']; ?>" readonly>
        </div>
        <div>
            <label>Telefono</label>
            <input type="text" value="<?php echo $custRow['telefono']; ?>" readonly>
        </div>
         <div>
            <label>calle</label>
            <input type="text" value="<?php echo $custRow['calle']; ?>" readonly>
            
        </div>
        <div>
            <label>numero de casa</label>
            <input type="text" value="<?php echo $custRow['n_casa']; ?>" readonly>
            
        </div>
        <div>
            <label>codigo postal</label>
            <input type="text" value="<?php echo $custRow['codigoPostal']; ?>" readonly>
            
        </div>
        <div>
            <label>detalles</label>
            <input type="text" value="<?php echo $custRow['masDetalles']; ?>" readonly>
            
        </div>

    </form>
        
    <div>
        <h3 align="center">Cambiar contraseña</h3>
        <p align="center">Complete este formulario para cambiar de contraseña.</p>
        <!--Formulario para cambiar la contraseña-->
        <form action="perfil.php" method="post">
            <!--Se valida que el input no este vacio-->
            <div <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>>
                <label>Nueva contraseña</label>
                <input type="password" name="new_password" value="<?php echo $new_password; ?>" required>
                <span><?php echo $new_password_err; ?></span>
            </div>
            <!--Se valida que el segundo input tampoco este vacio-->
            <div <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                <label>Confirmar contraseña</label>
                <input type="password" name="confirm_password" required>
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <input class="actualizar" type="submit" value="Enviar">
            </div>
        </form>
    </div>

    </section>
</section>
<!--FIN SECCION-->

</body>
</html>
<!--AQUI TERMINA EL HTML-->