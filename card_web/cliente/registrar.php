<?php 

include("con_db.php");

if (isset($_POST['register'])) {
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['telefono']) >= 1 && strlen($_POST['email']) >= 1  && strlen($_POST['mensaje']) >= 1) {
	    $nombre = trim($_POST['nombre']);
        $telefono = trim($_POST['telefono']);
	    $email = trim($_POST['email']);
		$mensaje = trim($_POST['mensaje']);
	    $consulta = "INSERT INTO datos(nombre, telefono, email, mensaje) VALUES ('$nombre', '$telefono', '$email','$mensaje')";
	    $resultado = mysqli_query($conex,$consulta);
	    if ($resultado) {
			
	    	?> 
			<center>
	    	<h3 class="ok">¡Se a enviado correctamente!</h3>
			</center>
           <?php
	    } else {
	    	?> 
	    	<h3 class="bad">¡Ups ha ocurrido un error!</h3>
           <?php
	    }
    }   else {
	    	?> 
	    	<h3 class="bad">¡Por favor complete los campos!</h3>
           <?php
    }
}

?>