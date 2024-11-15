<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmMenu.
$objAbmMenu = new AbmMenu();

// Llama al método editarMenues con los datos proporcionados.
$respuesta = $objAbmMenu->editarMenues($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
?>