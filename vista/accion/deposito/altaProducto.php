<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmProducto.
$objAbmProducto = new AbmProducto();

// Llama al método crearProducto con los datos proporcionados.
$respuesta = $objAbmProducto->crearProducto($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
