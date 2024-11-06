<?php
include_once("../../configuracion.php");
$tituloPagina = "Detalle de la Compra";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso2) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al detalle de la compra ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
} else {

    if ($rolActivo->getIdrol() == 3) {
        echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='seguimiento.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    } elseif ($rolActivo->getIdrol() == 2) {
        echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='gestionComprasDeposito.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    } elseif ($rolActivo->getIdrol() == 1) {
        echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='gestionCompras.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    } else {
        echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    }
?>
    <h1 class="display-5 pb-3 fw-bold">Detalle Compra</h1>

    <div class="d-flex justify-content-center">
        <table id="detalleCompra" class="easyui-datagrid" style="width:800px"
            toolbar="#toolbarDetalleCompra"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="pronombre" width="85">Nombre del Producto</th>
                    <th field="cicantidad" width="50">Cantidad</th>
                    <th field="proprecio" width="107">Precio Unitario</th>
                    <th field="preciototal" width="105">Precio Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $arreglo["idcompra"] = $datos["idcompra"];
                $objAbmCompraItem = new AbmCompraItem();
                $arregloItems = $objAbmCompraItem->buscar($arreglo);
                $totalCompra = 0;
                foreach ($arregloItems as $compraItem) {
                    echo "<td>" . $compraItem->getObjProducto()->getPronombre() . "</td>";
                    echo "<td>" . $compraItem->getCicantidad() . "</td>";
                    echo "<td>" . $compraItem->getObjProducto()->getProprecio() . "</td>";
                    $precioTotalProducto = $compraItem->getCicantidad() * $compraItem->getObjProducto()->getProprecio();
                    echo "<td>" . $precioTotalProducto . "</td></tr>";
                    $totalCompra = $totalCompra + $precioTotalProducto;
                }
                echo "<tr><td></td><td></td><td></td><td>Precio Total de la Compra: " . $totalCompra . "</td></tr>";
                echo "</tbody></table>";
                ?>
    </div>

<?php
}
include_once("../estructura/pie.php");
?>