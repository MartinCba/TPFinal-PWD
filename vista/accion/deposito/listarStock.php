<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmProducto.
$objAbmProducto = new AbmProducto();

// Llama al método listarStock para obtener la lista de stock de productos.
$arregloSalida = $objAbmProducto->listarStock();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>