<?php

header("Content-Type: text/html; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate ");

// Carpeta princpial del proyecto.
$PROYECTO = "TPFinal-PWD";

// Variable que almacena el directorio del proyecto.
$ROOT = $_SERVER["DOCUMENT_ROOT"] . "/TPFinal-PWD/";

include_once($ROOT . "util/funciones.php");

// Almacena la ruta del directorio raíz del proyecto en una variable de sesión.
// Esto permite que la ruta raíz esté disponible en diferentes páginas y scripts durante la sesión del usuario.
$_SESSION["ROOT"] = $ROOT;
