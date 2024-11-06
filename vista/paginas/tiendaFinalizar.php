<?php
include_once("../../configuracion.php");
$tituloPagina = "Finalizar Compra";
include_once("../estructura/encabezadoPrivado.php");
?>

<a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/tienda.php"><i class="bi bi-arrow-90deg-left"></i></a>

<?php
$datos = data_submitted();
if ($datos['transaccion'] == "exito") {
    echo '<h1 class="display-5 pb-3 fw-bold">Operación exitosa. Se esta revisando su compra.</h1>';
} elseif ($datos['transaccion'] == "fallo") {
    echo '<h1 class="display-5 pb-3 fw-bold">Hubo un error con la compra.</h1>';
} elseif ($datos['transaccion'] == "stock") {
    echo '<h1 class="display-5 pb-3 fw-bold">Uno de los productos no tiene stock suficiente.</h1>';
}
?>

<?php
include_once("../estructura/pie.php");
?>