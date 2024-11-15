<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmRol.
$objAbmRol = new AbmRol();

// Llama al método listarRoles para obtener la lista de roles.
$arregloSalida = $objAbmRol->listarRoles();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>