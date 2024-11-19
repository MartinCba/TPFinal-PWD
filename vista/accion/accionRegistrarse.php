<?php
include_once "../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Verifica que los datos necesarios estén presentes.
if (isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail'])) {
    // Crea una instancia de la clase AbmUsuario.
    $objAbmUsuario = new AbmUsuario();

    // Llama al método registrarse con los datos proporcionados.
    $retorno = $objAbmUsuario->registrarse($datos);

    // Si el registro fue exitoso, envía un correo al usuario.
    if($retorno["registro"]){
        //Creo la instancia para enviar un correo
        $mail = new mail();
    
        //llamo la funcion que envia un mail al usuario
        $mail->enviarMail($datos['usmail'],$datos['usnombre'],"registro",null);
    }


    // Redirige a la dirección devuelta por el método registrarse.
    header($retorno["direccion"]);
}
