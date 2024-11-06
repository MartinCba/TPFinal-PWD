<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmProducto.
$objAbmProducto = new AbmProducto();

// Llama al método listarProductos para obtener la lista de productos.
$arregloSalida = $objAbmProducto->listarProductos();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>