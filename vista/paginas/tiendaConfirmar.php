<?php
include_once("../../configuracion.php");
$tituloPagina = "Confirmar Compra";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso3) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder a la confirmación de la compra ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
} elseif (($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) && (!isset($arregloMenuPadre))) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder a la confirmación de la compra ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
} elseif (!$subMenuDeshabilitado) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder a la confirmación de la compra ya que la página se encuentra deshabilitada.</h1>";
} elseif (!$existeSubMenuTienda) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder a la confirmación de la compra ya que la página no existe.</h1>";
} else {
?>

    <a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/carrito.php"><i class="bi bi-arrow-90deg-left"></i></a>


    <?php
    $datos = data_submitted();
    if ($datos['compra'] == "Comprar" && isset($datos['idcompra'])) {
        $objAbmCompraItem = new AbmCompraitem();
        $arregloItems = $objAbmCompraItem->buscar(['idcompra' => $datos['idcompra']]);
        if (!empty($arregloItems)) {
            echo '<h1 class="display-5 pb-3 fw-bold">Confirmar Compra</h1>';
            $totalPagar = 0;
            foreach ($arregloItems as $item) {
                echo '<div class="text-center">Producto: ' . $item->getObjProducto()->getPronombre();
                echo '&nbsp;&nbsp;Cantidad: ' . $item->getCicantidad() . '</div>';
                $totalPagar += ($item->getObjProducto()->getProprecio()) * $item->getCicantidad();
            }
            echo '<div class="text-center mt-5"><b>Total a pagar: </b>$' . $totalPagar . '</div>';
            echo '<form method="post" action="../accion/tienda/accionTiendaConfirmar.php" class="text-center">';
            echo '<input type="hidden" name="idcompra" id="idcompra" value="' . $datos['idcompra'] . '">';
            echo '<input type="submit" value="Comprar" class="btn btn-dark m-3"></form>';
        }
    }
    ?>

<?php
}
include_once("../estructura/pie.php");
?>