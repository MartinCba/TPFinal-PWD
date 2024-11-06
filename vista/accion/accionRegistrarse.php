<?php
include_once "../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Verifica que los datos necesarios estén presentes.
if (isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail'])) {
    // Crea una instancia de la clase AbmUsuario.
    $objAbmUsuario = new AbmUsuario();

    // Llama al método registrarse con los datos proporcionados.
    $direccion = $objAbmUsuario->registrarse($datos);

    // Redirige a la dirección devuelta por el método registrarse.
    header($direccion);
}
