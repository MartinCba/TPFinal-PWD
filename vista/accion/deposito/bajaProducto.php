<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmProducto.
$objAbmProducto = new AbmProducto();

// Intenta cambiar el estado del producto llamando al método baja con los datos proporcionados.
if ($objAbmProducto->baja($datos)) {
    // Si el cambio de estado es exitoso, establece un mensaje de respuesta positivo.
    $respuesta["respuesta"] = "Se cambió el estado del producto correctamente";
} else {
    // Si el cambio de estado falla, establece un mensaje de error.
    $respuesta["errorMsg"] = "No se pudo cambiar el estado del producto";
}

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
