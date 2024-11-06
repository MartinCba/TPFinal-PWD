<?php
include_once("../../configuracion.php");
$tituloPagina = "Tienda";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder a la tienda ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
} elseif (($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) && (!isset($arregloMenuPadre))) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder a la tienda ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
} elseif (!$subMenuDeshabilitado) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder a la tienda ya que la página se encuentra deshabilitada.</h1>";
} elseif (!$existeSubMenu) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder a la tienda ya que la página no existe.</h1>";
} else {
?>

    <a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>
    <h1 class="display-5 pb-3 fw-bold">Tienda</h1>
    <?php
    $objAbmProducto = new AbmProducto();
    $arregloProductos = $objAbmProducto->buscar(NULL);
    echo '<div class="row text-center">';
    foreach ($arregloProductos as $producto) {
        if ($producto->getProdeshabilitado() == NULL && $producto->getProcantstock() > 0) {
            echo "<div class='col-3 mb-5'>";
            echo "    <div class='card text-white bg-dark'>";
            $archivo = "../img/productos/" . $producto->getIdproducto() . ".jpg";
            if (file_exists($archivo)) {
                echo "    <img src='../img/productos/" . $producto->getIdproducto() . ".jpg' class='card-img-top rounded-bottom' alt='articulo de tienda'>";
            } else {
                echo "    <img src='../img/productos/0.jpg' class='card-img-top rounded-bottom' alt='articulo de tienda'>";
            }
            echo "        <div class='card-body'>";
            echo "            <h5 class='card-title fw-bolder'>" . $producto->getPronombre() . "</h5>";
            echo "            <a href='productos.php?idproducto=" . $producto->getIdproducto() . "' class='stretched-link'></a>";
            echo "            <p class='card-text'>Precio: $" . $producto->getProprecio() . "</p>";
            echo "        </div>";
            echo "    </div>";
            echo "</div>";
        }
    }
    echo '</div>';
    ?>

<?php
}
include_once("../estructura/pie.php");
?>