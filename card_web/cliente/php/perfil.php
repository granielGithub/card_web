<?php
// Se incluye la conexión a la BD
include 'Configuracion.php';

// Se mantiene iniciada la sesion
session_start();

// Se revisa si ya hay un usuario logeado, en caso de que no, se le redirecciona a la pagina login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Se solicita la conexion a la bd para cambiar la contraseña
require_once "config.php";

// Se definen variable sin atributos
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Se procesa el formulario al apretar el boton
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Se valida la nueva contraseña
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Por favoy ingrese la nueva contraseña.";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }

    // Se confirma la nueva contraseña
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor confirme la contraseña.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // Se checan errores antes de actualizar la bd
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Se hace una actualizacion de la contraseña
        $sql = "UPDATE clientes SET password = ? WHERE id_cliente = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Se unen las variables para los parametros
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Configura parametros
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id_cliente"];

            // Se ejecuta
            if(mysqli_stmt_execute($stmt)){
                // Se actualiza la contraseña, se cierra la sesion y se redirecciona a la pagina login
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Algo salió mal, por favor vuelva a intentarlo.";
            }
        }

        // Cierre de declaracion
        mysqli_stmt_close($stmt);
    }

    // Cierre de conexion
    mysqli_close($link);
}


// Se da (set) el ID del cliente que se encuentra en la sesión
$_SESSION['sessCustomerID'] = $_SESSION['id_cliente'];
// Se obtiene (get) los detalles de inicio de sesión por el ID del cliente
$query = $db->query("SELECT * FROM clientes WHERE id_cliente = ".$_SESSION['sessCustomerID']);
// Se asocia la consulta a la variable $custRow para recorrerla más adelante
$custRow = $query->fetch_assoc();
?>