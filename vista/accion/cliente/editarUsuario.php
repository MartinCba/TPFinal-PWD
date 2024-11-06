<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmUsuario.
$objAbmUsuario = new AbmUsuario();

// Llama al método editarUsuarioActual con los datos proporcionados.
$respuesta = $objAbmUsuario->editarUsuarioActual($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
