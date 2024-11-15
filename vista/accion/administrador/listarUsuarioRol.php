<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmUsuarioRol.
$objAbmUsuarioRol = new AbmUsuarioRol();

// Llama al método listarUsuarioRol para obtener la lista de relaciones Usuario-Rol.
$arregloSalida = $objAbmUsuarioRol->listarUsuarioRol();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>