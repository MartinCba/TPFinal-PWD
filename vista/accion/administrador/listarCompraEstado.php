<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmCompraEstado.
$objAbmCompraEstado = new AbmCompraEstado();

// Llama al método listarCompraEstado para obtener la lista de estados de compra.
$arregloSalida = $objAbmCompraEstado->listarCompraEstado();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>