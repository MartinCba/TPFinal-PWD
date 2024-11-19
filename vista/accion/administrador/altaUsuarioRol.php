<?php
include_once "../../../configuracion.php";



// Obtiene los datos enviados desde el formulario.
$datos = data_submitted();

//isntancio el ABMusuario y ABMrol
$usuario = new AbmUsuario();
$rol = new AbmRol();

//seteo los ids y obtengo los objeto usuario y rol
$objUsuario = $usuario->cargarUsuarioConId($datos["idusuario"]);
$objRol = $rol->obtenerRolPorId($datos["idrol"]);

//insatncio la clase mail
$mail = new mail();

//envio el mail al usuario con el rol correspondiente
$mail->enviarMail($objUsuario->getUsmail(),$objUsuario->getUsnombre(),$objRol->getRodescripcion(),"");

// Crea una instancia de la clase AbmUsuarioRol.
$objAbmUsuarioRol = new AbmUsuarioRol();

// Llama al método crearUsuarioRol con los datos proporcionados.
$respuesta = $objAbmUsuarioRol->crearUsuarioRol($datos);

// Devuelve la respuesta en formato JSON.
//echo json_encode($respuesta);
