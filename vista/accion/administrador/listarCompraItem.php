<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmCompraItem.
$objAbmCompraItem = new AbmCompraItem();

// Llama al método listarCompraItem para obtener la lista de ítems de compra.
$arregloSalida = $objAbmCompraItem->listarCompraItem();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>