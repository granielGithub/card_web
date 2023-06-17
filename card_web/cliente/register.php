<?php
// Se solicita la conexion a la bd
require_once "config.php";
// Se solicita el php
require_once "php/registro.php"
?>

<!--Aqui empieza el HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <title>Registro</title>
</head>
<body>
    <!--CABECERA-->
<header>
	<!--Menu de navegación-->
	<nav>
		<ul>
			<li><a href="../index.php">Inicio</a></li>
            <li><a href="../encargado/login.php">Gerente</a></li>
            <li><a href="login.php">Iniciar sesión</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

<div>
        <h2 align="center">Registrate</h2>
        <p align="center">Por favor acomplete el formulario, para poder iniciar sesion.</p>
        <!--Formulario de registro-->
        <form class="ingresar_articulo" action="register.php" method="post">
        <!--Se guardarán todos los datos en la tabla Clientes de la BD Tienda-->
        <!--Se enviaron los datos mediante el name de cada input-->
            <div>
                <label>Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" required>
            </div>
            <div>
                <label>Apellido paterno</label>
                <input type="text" name="apellidoPaterno" placeholder="Apellido paterno" required>
            </div>
            <div>
                <label>Apellido materno</label>
                <input type="text" name="apellidoMaterno" placeholder="Apellido materno" required>
            </div>
            <div>
                <label>Email</label>
                <input type="text" name="email" placeholder="E-mail" required>
            </div>
            <div>
                <label>Telefono</label>
                <input type="text" name="telefono" placeholder="Celular" required>
            </div>
            <div>Direccion</div>
            <div>
                <label>calle</label>
                <input type="text" name="calle" placeholder="calles/crusamientos" required>
                
            </div>
            <div>
                <label>n° casa</label>
                <input type="text" name="n_casa" placeholder="numero de casa" required>
               </div>
               <div>
               <label>codigo postal</label>
                <input type="text" name="codigoPostal" placeholder="codigo postal" required>
               </div>
               <div>
               <label>detalles del lugar</label>
                <input type="text" name="masDetalles" placeholder="detalles mas especificos" required>
               </div>
            <!--Se procesa el usuario y contraseña-->
            <!--Valida que no este vacio el input usuario-->
            <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
                <label>Usuario</label>
                <input type="text" name="usuario" placeholder="Usuario" value="<?php echo $username; ?>" required>
                <span><?php echo $username_err; ?></span>
            </div>
            <!--Valida que no este vacio el input contraseña-->
            <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña" value="<?php echo $password; ?>" required>
                <span><?php echo $password_err; ?></span>
            </div>
            <!--Valida que no este vacio el input confirmar contraseña-->
            <div <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                <label>Confirmar Contraseña</label>
                <input type="password" name="confirm_password" placeholder="Confirma tu contraseña" value="<?php echo $confirm_password; ?>" required>
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <input class="ingresar" type="submit" value="Registrarse">
            </div>
            <p>¿Ya tienes una cuenta? <a href="login.php">Ingresa aquí</a>.</p>
        </form>
    </div>

<!--PIE DE PAGINA-->

<!--FIN PIE DE PAGINA-->
</body>
</html>