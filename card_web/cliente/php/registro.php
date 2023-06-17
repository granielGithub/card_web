<?php
// Se solicita la conexion a la bd
require_once "config.php";

// Se definen variables sin atributo
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Se procesa el formulario al apretar el boton
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Se valida el usuario
    if(empty(trim($_POST["usuario"]))){
        $username_err = "<p  style='color: red;'>Por favor ingrese un usuario.<p><br>";
    } else{
        // Se crea una declaracion
        $sql = "SELECT id_cliente FROM clientes WHERE usuario = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Se unen las variables para los parametros
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Configura parametros
            $param_username = trim($_POST["usuario"]);

            // Se ejecuta la declaracion
            if(mysqli_stmt_execute($stmt)){
                /* Resultado */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "<p  style='color: red;'>El usuario ya existe.<p><br>";
                } else{
                    $username = trim($_POST["usuario"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }

        // Cierre de declaracion
        mysqli_stmt_close($stmt);
    }

    // Se valida la contraseña
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contraseña.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Se valida la confirmacion de la contraseña
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "No coincide la contraseña.";
        }
    }

    // Se checan errores antes de actualizar la bd
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        //********SE VERIFICAN TODOS LOS CAMPOS ANTES DE AGREGAR*******
        if (isset($_POST['nombre']) && !empty($_POST['nombre']) 
        && isset($_POST['apellidoPaterno']) && !empty($_POST['apellidoPaterno'])
        && isset($_POST['apellidoMaterno']) && !empty($_POST['apellidoMaterno']) 
        && isset($_POST['email']) && !empty($_POST['email']) 
        && isset($_POST['telefono']) && !empty($_POST['telefono']) 
        && isset($_POST['calle']) && !empty($_POST['calle'] ) 
        && isset($_POST['n_casa']) && !empty($_POST['n_casa'] ) 
        && isset($_POST['codigoPostal']) && !empty($_POST['codigoPostal'] )
         && isset($_POST['masDetalles']) && !empty($_POST['masDetalles'] ) ) {
        // Se agrega el nuevo usuario
        $sql = "INSERT INTO clientes (nombre, apellidoPaterno, apellidoMaterno, email, telefono, calle, n_casa, codigoPostal, masDetalles, usuario, password) 
        VALUES ('$_POST[nombre]', '$_POST[apellidoPaterno]', '$_POST[apellidoMaterno]', '$_POST[email]', '$_POST[telefono]', '$_POST[calle]','$_POST[n_casa]', '$_POST[codigoPostal]', '$_POST[masDetalles]' , ?, ?)";}
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Se unen las variables para los parametros
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Se configura el parametro
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Se ejecuta la declaracion
            if(mysqli_stmt_execute($stmt)){
                // Se redirecciona a la pagina de login
                header("location: login.php");
            } else{
                echo "Error, por favor inténtalo de nuevo.";
            }
        }

        //Cierre de declaracion
        mysqli_stmt_close($stmt);
    }

    // Cierre de conexion a la bd
    mysqli_close($link);
}
?>