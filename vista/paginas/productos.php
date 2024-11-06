<?php
include_once("../../configuracion.php");
$tituloPagina = "Productos";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso3) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al producto ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
} elseif (($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) && (!isset($arregloMenuPadre))) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al producto ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
} elseif (!$subMenuDeshabilitado) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al producto ya que la página se encuentra deshabilitada.</h1>";
} elseif (!$existeSubMenuTienda) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al producto ya que la página no existe.</h1>";
} else {
?>

    <?php
    $datos = data_submitted();
    $arregloProductos = [];
    if (isset($datos['idproducto'])) {
        $objAbmProducto = new AbmProducto();
        $arregloProductos = $objAbmProducto->buscar($datos);
    }
    $objProducto = NULL;
    if (!empty($arregloProductos)) {
        $objProducto = $arregloProductos[0];
    }
    ?>

    <a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/tienda.php"><i class="bi bi-arrow-90deg-left"></i></a>
    <h1 class="display-5 pb-3 fw-bold">Producto: <?php echo $objProducto->getPronombre() ?></h1>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card text-white bg-dark">
                <?php
                $archivo = "../img/productos/" . $objProducto->getIdproducto() . ".jpg";
                if (file_exists($archivo)) {
                    echo "<img src='" . $archivo . "' class='card-img-left rounded' alt='producto'>";
                } else {
                    echo "<img src='../img/productos/0.jpg' class='card-img-left rounded' alt='producto'>";
                }
                ?>
            </div>
        </div>
        <div class="col">
            <div class="card bg-transparent border border-dark h-100">
                <div class="card-body">
                    <h5 class="card-title mt-5"></h5>
                    <p><?php echo $objProducto->getProdetalle() ?></p>
                    <?php
                    if ($objProducto->getProcantstock() > 0 && $objProducto->getProdeshabilitado() == NULL) {
                        echo '<div class="col-12 mt-5">
                                        <p>Unidades disponibles: ' . $objProducto->getProCantstock() . '</p>
                                    </div>
                                    <form method="post" action="../accion/tienda/accionTienda.php">
                                    <div class="col-12 mt-5">
                                        <small>Cantidad</small>
                                        <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="' . $objProducto->getProcantstock() . '">';
                        if (isset($datos['error'])) {
                            if ($datos['error'] == 1) {
                                echo '<div style="color:red">Hubo un error con la compra. Intente de nuevo.</div>';
                            }
                            if ($datos['error'] == 2) {
                                echo '<div style="color:red">Falta de stock. Revise su carro de compras.</div>';
                            }
                        }
                        echo '<input type="hidden" name="idproducto" id="idproducto" value="' . $datos['idproducto'] . '">';
                        echo '<input type="hidden" name="maxStock" id="maxStock" value="' . $objProducto->getProcantstock() . '">
                                    </div>
                                    <div class="col">
                                        <input type="submit" class="btn btn-dark mt-5" id="compra" name="compra" value="Agregar al carrito">
                                    </div>
                                    </form>';
                    } else {
                        echo '<div class="col-12">
                                    <h6>No disponible por el momento</h6>
                                </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
}
include_once("../estructura/pie.php");
?>