<?php
//Se solicita la bd
require_once "config.php";
//Se solicita la conexion a los datos de php
require_once "php/login.php"
?>

<!--Aqui inicia el HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <title>Login</title>
</head>
<body>
    <!--CABECERA-->
<header>
	<!--Menu de navegación-->
	<nav>
		<ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../encargado/login.php">Gerente</a></li>
            <li><a href="../cliente/login.php">Iniciar sesión</a></li>
		</ul>
	</nav>
</header>
<!--FIN CABECERA-->

    <div>
        <h2 align="center">Iniciar Sesión</h2>
        <p align="center">Por favor, ingresar el usuario y contraseña para poder iniciar sesion como administrador.</p>

        <!--Formulario de incio de sesión-->
        <!--Se envian los datos de los inputs mediante el metodo POST-->
        <form action="login.php" method="post">
            <!--Revisa que el usuario no este vacio-->
            <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
                <label>Usuario</label>
                <input type="text" name="usuario" placeholder="usuario" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
            </div>
            <!--Revisa que la contraseña no este vacia-->
            <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                <label>Contraseña</label>
                <input type="password" placeholder="password" name="password">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <input class="actualizar" type="submit" value="Ingresar">
            </div>
        </form>
    </div>

<!--PIE DE PAGINA-->

<!--FIN PIE DE PAGINA-->
</body>
</html>