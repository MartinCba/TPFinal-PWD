<?php
include_once "../../../configuracion.php";

function logToFile($data) {
    $logFile = 'log.txt'; // El archivo donde guardarás los logs
    $currentData = file_get_contents($logFile);
    $currentData .= $data . "\n"; // Agrega el nuevo dato
    file_put_contents($logFile, $currentData); // Escribe en el archivo
  }

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmCompraEstado.
$objAbmCompraEstado = new AbmCompraEstado();

//obtengo la id de la compra
$idCompra = $datos["idcompra"];

//instancio la compra
$compra = new AbmCompra();

//obtengo el objeto usuario con el id de la compra
$objUsuario = $compra->compraPorUsuario($idCompra);

//instancio el mail
$mail = new mail();

//envio el mail al usuario con el estado confirmado.
$mail->enviarMail($email = $objUsuario->getUsmail(), $nombre = $objUsuario->getUsnombre(),"confirmado",null );


// Llama al método siguienteEstadoCompra con los datos proporcionados.
$respuesta = $objAbmCompraEstado->siguienteEstadoCompra($datos);


$respuesta = json_encode($respuesta);
// Devuelve la respuesta en formato JSON.
echo $respuesta;
logToFile(print_r($respuesta,true));


?>