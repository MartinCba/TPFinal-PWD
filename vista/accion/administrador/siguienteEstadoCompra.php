<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmCompraEstado.
$objAbmCompraEstado = new AbmCompraEstado();

// Llama al método siguienteEstadoCompra con los datos proporcionados.
$respuesta = $objAbmCompraEstado->siguienteEstadoCompra($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
?>