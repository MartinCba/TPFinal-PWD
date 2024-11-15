<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmMenuRol.
$objAbmMenuRol = new AbmMenuRol();

// Llama al método crearMenuRol con los datos proporcionados.
$respuesta = $objAbmMenuRol->crearMenuRol($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
?>