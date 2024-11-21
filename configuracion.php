<?php

header("Content-Type: text/html; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate ");

// Carpeta princpial del proyecto.
$PROYECTO = "TPFinal-PWD";

// Establecer la zona horaria
date_default_timezone_set('America/Argentina/Buenos_Aires');

// Variable que almacena el directorio del proyecto.
$ROOT = $_SERVER["DOCUMENT_ROOT"] . "/TPFinal-PWD/";

include_once($ROOT . "util/funciones.php");

// Almacena la ruta del directorio raíz del proyecto en una variable global.
$GLOBALS["ROOT"] = $ROOT;
