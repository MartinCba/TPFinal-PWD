<?php
include_once("../../../configuracion.php");

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Verifica que los datos necesarios estén presentes.
if (isset($datos['idproducto']) && isset($datos['cantidad'])) {
    // Crea una instancia de la clase AbmCompra.
    $objAbmCompra = new AbmCompra();

    // Llama al método agregarProductoACarrito con los datos proporcionados.
    $redireccion = $objAbmCompra->agregarProductoACarrito($datos);

    // Redirige a la dirección devuelta por el método agregarProductoACarrito.
    header($redireccion);
} else {
    // Si faltan datos, redirige a la página de productos con un mensaje de error.
    header("Location:../../paginas/productos.php?idproducto=" . $datos['idproducto'] . "&error=1");
}
