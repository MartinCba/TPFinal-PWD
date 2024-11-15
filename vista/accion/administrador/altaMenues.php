<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmMenu.
$objAbmMenu = new AbmMenu();

// Llama al método crearMenu con los datos proporcionados.
$respuesta = $objAbmMenu->crearMenu($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
?>