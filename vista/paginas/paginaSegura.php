<?php
include_once("../../configuracion.php");
$tituloPagina = "Página Segura";
include_once("../estructura/encabezadoPrivado.php");
?>

<a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2" href="inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>

<?php
if (isset($datos['idrol'])) {
    echo "<h1 class='display-5 pb-3 fw-bold'>Ha cambiado de rol correctamente.</h1>";
} else {
    echo "<h1 class='display-5 pb-3 fw-bold'>Ha iniciado sesión correctamente!</h1>";
}
include_once("../estructura/pie.php");
?>