<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmUsuario.
$objAbmUsuario = new AbmUsuario();

// Llama al método listarUsuarioActual para obtener la información del usuario actual.
$arregloSalida = $objAbmUsuario->listarUsuarioActual();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>