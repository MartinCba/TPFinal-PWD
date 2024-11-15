<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmRol.
$objAbmRol = new AbmRol();

// Intenta dar de alta un nuevo rol con los datos proporcionados.
if ($objAbmRol->alta($datos)) {
    // Si la operación es exitosa, establece un mensaje de respuesta positivo.
    $respuesta["respuesta"] = "Se dio de alta el Rol correctamente!";
} else {
    // Si la operación falla, establece un mensaje de error.
    $respuesta["errorMsg"] = "No se pudo realizar el alta";
}

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
