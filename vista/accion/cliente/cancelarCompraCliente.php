<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmCompraEstado.
$objAbmCompraEstado = new AbmCompraEstado();

// Llama al método cancelarCompraCliente con los datos proporcionados.
$respuesta = $objAbmCompraEstado->cancelarCompraCliente($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
