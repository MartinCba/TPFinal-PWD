<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmUsuario.
$objAbmUsuario = new AbmUsuario();

// Llama al método listarUsuarios para obtener la lista de usuarios.
$arregloSalida = $objAbmUsuario->listarUsuarios();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>