<?php

/**
 * Recoge los datos enviados a través de los métodos POST, GET y FILES,
 * los combina en un solo array y reemplaza los valores vacíos con "null".
 * @return array Un array que contiene todos los datos enviados.
 */
function data_submitted()
{
    $_AAux = array();
    if (!empty($_POST)) {
        $_AAux = $_POST;
    } else {
        if (!empty($_GET)) {
            $_AAux = $_GET;
        }
    }
    if (!empty($_FILES)) {
        array_push($_AAux, $_FILES);
    }
    if (count($_AAux)) {
        foreach ($_AAux as $indice => $valor) {
            if ($valor == "") {
                $_AAux[$indice] = "null";
            }
        }
    }
    return $_AAux;
}
/**
 * Función de autocarga para incluir automáticamente archivos de clases.
 * Busca el archivo de la clase en los directorios especificados 
 * y lo incluye si se encuentra.
 * @param string
 */
spl_autoload_register(function ($class_name) {
    $directorys = array(
        $GLOBALS['ROOT'] . 'modelo/',
        $GLOBALS['ROOT'] . 'modelo/conector/',
        $GLOBALS['ROOT'] . 'control/',
    );
    foreach ($directorys as $directory) {
        if (file_exists($directory . $class_name . ".php")) {
            require_once($directory . $class_name . ".php");
            return;
        }
    }
});
