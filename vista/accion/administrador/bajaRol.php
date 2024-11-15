<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmRol.
$objAbmRol = new AbmRol();

// Llama al método eliminarRol con los datos proporcionados.
$respuesta = $objAbmRol->eliminarRol($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
