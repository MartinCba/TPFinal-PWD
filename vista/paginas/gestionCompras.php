<?php
include_once("../../configuracion.php");
$tituloPagina = "Gestión de Compras";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar compras ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
} elseif (($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) && (!isset($arregloMenuPadre))) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar compras ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
} elseif (!$subMenuDeshabilitado) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar compras ya que la página se encuentra deshabilitada.</h1>";
} elseif (!$existeSubMenu) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar compras ya que la página no existe.</h1>";
} else {
?>

    <a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>

    <!-- Tabla para gestionar CompraEstado -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de relación Compra-Estado</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dgCompraEstado" class="easyui-datagrid" style="width:80%"
            url="../accion/administrador/listarCompraEstado.php"
            toolbar="#toolbarCompraEstado"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idcompraestado" width="50">Id Compra Estado</th>
                    <th field="idcompra" width="40">Id Compra</th>
                    <th field="idcompraestadotipo" width="65">Id CompraEstadoTipo</th>
                    <th field="cetdescripcion" width="60">Estado</th>
                    <th field="cefechaini" width="55">Fecha de inicio</th>
                    <th field="cefechafin" width="50">Fecha de fin</th>
                    <th field="usnombre" width="50">Comprador</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarCompraEstado">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="siguienteEstado()">Siguiente Estado</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="cancelarCompraEstado()">Cancelar Compra</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="muestraDetalleCompra()">Detalles de la Compra</a>
        </div>

        <div id="dlgCompraEstado" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgCompraEstado-buttons'">
            <form id="fmCompraEstado" method="post" novalidate style="margin:0;padding:20px 50px">
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
        <div id="dlgCompraEstado-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompraEstado()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgCompraEstado').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    <br>

    <!-- Tabla para gestionar CompraItem -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de relación Compra-Item</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dgCompraItem" class="easyui-datagrid" style="width:80%"
            url="../accion/administrador/listarCompraItem.php"
            toolbar="#toolbarCompraItem"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idcompraitem" width="15">Id Compra Item</th>
                    <th field="idproducto" width="10">Id Producto</th>
                    <th field="pronombre" width="10">Nombre Producto</th>
                    <th field="cicantidad" width="15">Cantidad</th>
                    <th field="idcompra" width="10">Id Compra</th>
                    <th field="usnombre" width="15">Comprador</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarCompraItem">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarCompraItem()">Eliminar CompraItem</a>
        </div>

        <div id="dlgCompraItem" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgCompraItem-buttons'">
            <form id="fmCompraItem" method="post" novalidate style="margin:0;padding:20px 50px">
                <div>
                    <input type="hidden" name="idcompraitem" value="idcompraitem">
                </div>
                <div>
                    <input type="hidden" name="idcompra" value="idcompra">
                </div>
            </form>
        </div>
        <div id="dlgCompraItem-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompraEstado()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgCompraItem').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>

<?php
}
include_once("../estructura/pie.php");
?>