<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmUsuario.
$objAbmUsuario = new AbmUsuario();

// Intenta cambiar el estado del usuario con los datos proporcionados.
if ($objAbmUsuario->baja($datos)) {
    // Si la operación es exitosa, establece un mensaje de respuesta positivo.
    $respuesta["respuesta"] = "Se cambió el estado del usuario correctamente!";
} else {
    // Si la operación falla, establece un mensaje de error.
    $respuesta["errorMsg"] = "No se pudo cambiar el estado del usuario";
}

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
