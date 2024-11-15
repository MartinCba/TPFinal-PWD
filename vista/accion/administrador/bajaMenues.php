<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmMenu.
$objAbmMenu = new AbmMenu();

// Intenta cambiar el estado del Menú con los datos proporcionados.
if ($objAbmMenu->baja($datos)) {
    // Si la operación es exitosa, establece un mensaje de respuesta positivo.
    $respuesta["respuesta"] = "Se cambió el estado del Menú correctamente";
} else {
    // Si la operación falla, establece un mensaje de error.
    $respuesta["errorMsg"] = "No se pudo cambiar el estado del Menú";
}

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
