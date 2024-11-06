<?php
include_once("../../../configuracion.php");

// Crea una instancia de la clase AbmCompra.
$objAbmCompra = new AbmCompra();

// Llama al método cancelarCompra para cancelar la compra actual.
$resp = $objAbmCompra->cancelarCompra();

// Redirige a la página de la tienda.
header("Location:../../paginas/tienda.php");
