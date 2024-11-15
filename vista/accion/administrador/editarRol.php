<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmRol.
$objAbmRol = new AbmRol();

// Intenta modificar el Rol con los datos proporcionados.
if ($objAbmRol->modificacion($datos)) {
    // Si la operación es exitosa, establece un mensaje de respuesta positivo.
    $respuesta["respuesta"] = "Se modificó el Rol correctamente";
} else {
    // Si la operación falla, establece un mensaje de error.
    $respuesta["errorMsg"] = "No se pudo modificar el Rol";
}

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
?>