<?php
include_once("../../../configuracion.php");

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();
$listaCompleta = json_decode($datos['listaCompleta'], true);
print_r($listaCompleta);


// Verifica que el dato necesario esté presente.
if (isset($datos['idcompra'])) {
    // Crea una instancia de la clase AbmCompra.
    $objAbmCompra = new AbmCompra();

    // Llama al método finalizarCompra con los datos proporcionados.
    $redireccion = $objAbmCompra->finalizarCompra($datos);

    //Creo la instancia para enviar un correo
    $mail = new mail();


    //llamo la funcion que envia un mail al usuario
    echo $mail->enviarMail($datos['usMail'],$datos['usNombre'],"revisando",$listaCompleta);

    // Redirige a la dirección devuelta por el método finalizarCompra.
    header($redireccion);
} else {
    // Si falta el dato, redirige a la página de finalización de tienda con un mensaje de error.
    header("Location:../../paginas/tiendaFinalizar.php?transaccion=fallo");
}
