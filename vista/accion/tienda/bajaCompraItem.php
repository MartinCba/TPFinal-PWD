<?php
include_once("../../../configuracion.php");

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Verifica que el dato necesario esté presente.
if (isset($datos['idcompraitem'])) {
    // Crea una instancia de la clase AbmCompraitem.
    $objAbmItem = new AbmCompraitem();

    // Llama al método eliminarItemDeCompra con los datos proporcionados.
    $objAbmItem->eliminarItemDeCompra($datos);
}

// Redirige a la página del carrito.
header("Location:../../paginas/carrito.php");
