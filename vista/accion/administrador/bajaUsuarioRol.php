<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmUsuarioRol.
$objAbmUsuarioRol = new AbmUsuarioRol();

// Intenta eliminar el UsuarioRol con los datos proporcionados.
if ($objAbmUsuarioRol->baja($datos)) {
    // Si la operación es exitosa, establece un mensaje de respuesta positivo.
    $respuesta["respuesta"] = "Se eliminó correctamente el UsuarioRol";
} else {
    // Si la operación falla, establece un mensaje de error.
    $respuesta["errorMsg"] = "No se pudo eliminar el UsuarioRol";
}

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
