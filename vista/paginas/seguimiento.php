<?php
include_once("../../configuracion.php");
$tituloPagina = "Seguimiento";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al seguimiento de la compra ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
} elseif (($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) && (!isset($arregloMenuPadre))) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al seguimiento de la compra ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
} elseif (!$subMenuDeshabilitado) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al seguimiento de la compra ya que la página se encuentra deshabilitada.</h1>";
} elseif (!$existeSubMenu) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede acceder al seguimiento de la compra ya que la página no existe.</h1>";
} else {
?>

    <a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2" href="inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>

    <!-- Tabla para gestionar Usuario -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de Compras</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dgSeg" class="easyui-datagrid" style="width:900px"
            url="../accion/cliente/listarCompraEstadoCliente.php"
            toolbar="#toolbarSeg"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idcompraestado" width="85">Id Compra Estado</th>
                    <th field="idcompra" width="50">Id Compra</th>
                    <th field="idcompraestadotipo" width="107">Id Compra Estado Tipo</th>
                    <th field="cetdescripcion" width="90">Estado</th>
                    <th field="cefechaini" width="100">Fecha de Inicio</th>
                    <th field="cefechafin" width="100">Fecha de Fin</th>
                    <th field="usnombre" width="70">Comprador</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarSeg">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="cancelarCompraCliente()">Cancelar Compra</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="verDetalleCliente()">Detalles de la Compra</a>
        </div>
        <div id="dlgSeg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgSeg-buttons'">
            <form id="fmSeg" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion de la Compra</h3>
                <div>
                    <input type="hidden" name="idcompraestado" value="idcompraestado">
                </div>
                <div>
                    <input type="hidden" name="idcompra" value="idcompra">
                </div>
                <div>
                    <input type="hidden" name="idcompraestadotipo" value="idcompraestadotipo">
                </div>
                <div>
                    <input type="hidden" name="cefechaini" value="cefechaini">
                </div>
                <div>
                    <input type="hidden" name="cefechafin" value="cefechafin">
                </div>
            </form>
        </div>
    </div>

<?php
}
include_once("../estructura/pie.php");
?>