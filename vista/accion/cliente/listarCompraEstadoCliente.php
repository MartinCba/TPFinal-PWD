<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmUsuario.
$objAbmUsuario = new AbmUsuario();

// Llama al método listarCompraEstadoCliente para obtener el estado de las compras del cliente.
$arregloSalida = $objAbmUsuario->listarCompraEstadoCliente();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
