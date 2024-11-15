<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmMenuRol.
$objAbmMenuRol = new AbmMenuRol();

// Llama al método listarMenuRoles para obtener la lista de roles de menú.
$arregloSalida = $objAbmMenuRol->listarMenuRoles();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>