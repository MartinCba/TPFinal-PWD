<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmMenuRol.
$objAbmMenuRol = new AbmMenuRol();

// Intenta eliminar el MenuRol con los datos proporcionados.
if ($objAbmMenuRol->baja($datos)) {
    // Si la operación es exitosa, establece un mensaje de respuesta positivo.
    $respuesta["respuesta"] = "Se eliminó correctamente el MenuRol";
} else {
    // Si la operación falla, establece un mensaje de error.
    $respuesta["errorMsg"] = "No se pudo eliminar el MenuRol";
}

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
