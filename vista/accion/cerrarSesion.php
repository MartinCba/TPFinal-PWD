<?php
include_once("../../configuracion.php");

// Inicia una nueva sesión.
$sesionCierre = new Session();

// Cierra la sesión actual.
$sesionCierre->cerrar();

// Redirige a la página de inicio.
header('Location:../paginas/inicio.php');
