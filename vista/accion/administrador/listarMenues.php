<?php
include_once "../../../configuracion.php";

// Crea una instancia de la clase AbmMenu.
$objAbmMenu = new AbmMenu();

// Llama al método listarMenues para obtener la lista de menús.
$arregloSalida = $objAbmMenu->listarMenues();

// Devuelve el arreglo de salida en formato JSON.
echo json_encode($arregloSalida);
?>