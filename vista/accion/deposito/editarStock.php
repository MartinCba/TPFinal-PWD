<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmProducto.
$objAbmProducto = new AbmProducto();

// Llama al método editarStock con los datos proporcionados.
$respuesta = $objAbmProducto->editarStock($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
