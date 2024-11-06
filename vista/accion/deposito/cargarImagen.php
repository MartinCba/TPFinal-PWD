<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Verifica que los datos necesarios estén presentes.
if (isset($datos[0]["imagen"]) && isset($datos["idproducto"])) {
    // Crea una instancia de la clase AbmProducto.
    $objAbmProducto = new AbmProducto();

    // Llama al método cargaDeImagen con los datos proporcionados.
    $respuesta = $objAbmProducto->cargaDeImagen($datos);
} else {
    // Si faltan datos, establece un mensaje de error.
    $respuesta["errorMsg"] = "No se ha adjuntado ningún archivo";
}

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
