<?php
include_once '../../configuracion.php';

// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

// Inicia una nueva sesión.
$objSession = new Session();

// Intenta iniciar sesión con el nombre de usuario y la contraseña proporcionados.
$objSession->iniciar($datos["usnombre"], md5($datos["uspass"]));

// Verifica si la sesión es válida.
if ($objSession->validar()) {
    // Si la sesión es válida, redirige a la página segura.
    header('Location:../paginas/paginaSegura.php');
} else {
    // Si la sesión no es válida, redirige a la página de login con un mensaje de error.
    header('Location:../paginas/login.php?error=Usuario y/o contraseña incorrecto');
}
