<?php
include_once "../../../configuracion.php";

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Crea una instancia de la clase AbmUsuarioRol.
$objAbmUsuarioRol = new AbmUsuarioRol();

// Llama al método crearUsuarioRol con los datos proporcionados.
$respuesta = $objAbmUsuarioRol->crearUsuarioRol($datos);

// Devuelve la respuesta en formato JSON.
echo json_encode($respuesta);
