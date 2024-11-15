<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmCompraItem.
$objAbmCompraItem = new AbmCompraItem();

// Llama al método eliminarCompraItem con los datos proporcionados.
$respuesta = $objAbmCompraItem->eliminarCompraItem($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
