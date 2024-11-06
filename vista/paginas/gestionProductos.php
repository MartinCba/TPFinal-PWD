<?php
include_once("../../configuracion.php");
$tituloPagina = "Gestión de Productos";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar productos ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
} elseif (($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) && (!isset($arregloMenuPadre))) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar productos ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
} elseif (!$subMenuDeshabilitado) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar productos ya que la página se encuentra deshabilitada.</h1>";
} elseif (!$existeSubMenu) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar productos ya que la página no existe.</h1>";
} else {
?>

    <a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>

    <!-- Tabla para gestionar Productos -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de Productos</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dgProductos" class="easyui-datagrid" style="width:80%"
            url="../accion/deposito/listarProductos.php"
            toolbar="#toolbarProductos"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idproducto" width="20">Id</th>
                    <th field="pronombre" width="60">Nombre</th>
                    <th field="prodetalle" width="100">Detalle</th>
                    <th field="proprecio" width="35">Precio</th>
                    <th field="prodeshabilitado" width="75">Estado</th>
                    <th field="imagen" width="55">Imagen</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarProductos">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newProducto()">Nuevo Producto</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editProducto()">Editar Producto</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyProducto()">Habilitar/Deshabilitar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="cargarImagen()">Cargar Imagen</a>
        </div>

        <div id="dlgProductos" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgProductos-buttons'">
            <form id="fmProductos" method="post" novalidate style="margin:0;padding:20px 50px">
                <div>
                    <input type="hidden" name="idproducto" value="idproducto">
                </div>
                <div style="margin-bottom:10px">
                    <label for="pronombre">Nombre:</label>
                    <input name="pronombre" class="easyui-textbox" required="true" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <label for="prodetalle">Detalle:</label>
                    <input name="prodetalle" class="easyui-textbox" required="true" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <label for="proprecio">Precio:</label>
                    <input name="proprecio" class="easyui-numberbox" required="true" style="width:100%">
                </div>
                <div>
                    <input type="hidden" name="prodeshabilitado" value="prodeshabilitado">
                </div>
            </form>
        </div>
        <div id="dlgProductos-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveProducto()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgProductos').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    <br>

    <!-- Gestionar Stock de los productos -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de Stock</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dgStock" class="easyui-datagrid" style="width:80%"
            url="../accion/deposito/listarStock.php"
            toolbar="#toolbarStock"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idproducto" width="60">Id</th>
                    <th field="pronombre" width="60">Nombre</th>
                    <th field="prodetalle" width="100">Detalle</th>
                    <th field="procantstock" width="70">Stock</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarStock">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editStock()">Editar Stock</a>
        </div>

        <div id="dlgStock" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgStock-buttons'">
            <form id="fmStock" method="post" novalidate style="margin:0;padding:20px 50px">
                <div>
                    <input type="hidden" name="idproducto" value="idproducto">
                </div>
                <div>
                    <input type="hidden" name="pronombre" value="pronombre">
                </div>
                <div>
                    <input type="hidden" name="prodetalle" value="prodetalle">
                </div>
                <div style="margin-bottom:10px">
                    <label for="procantstock">Stock:</label>
                    <input name="procantstock" class="easyui-numberbox" required="true" style="width:100%">
                </div>
            </form>
        </div>
        <div id="dlgStock-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveStock()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgStock').dialog('close')" style="width:90px">Cancelar</a>
        </div>

        <!-- formulario para cargar imagen -->
        <div id="dlgImg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-img'">
            <form id="fmImg" method="post" enctype="multipart/form-data" novalidate style="margin:0;padding:20px 50px">
                <div class="col-12">
                    <label for="imagen" class="form-label"><strong>Cargar Imagen</strong></label>
                    <div style="margin-bottom:10px">
                        <label for="idproducto">Id Producto:</label>
                        <input name="idproducto" class="easyui-numberbox" required="true" style="width:100%">
                    </div>
                    <div class="col">
                        <input type="file" name="imagen" id="imagen" required=true>

                        <small class="text-muted">Formato permitido: .jpg</small>
                        <div class="invalid-feedback">Seleccione una imagen de su equipo</div>
                    </div>
                </div>
            </form>
        </div>
        <div id="dlg-buttons-img">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveImagen()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgImg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>

<?php
}
include_once("../estructura/pie.php");
?>