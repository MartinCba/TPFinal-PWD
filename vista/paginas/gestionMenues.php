<?php
include_once("../../configuracion.php");
$tituloPagina = "Gestión de Menúes";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar menues ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
} elseif (($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) && (!isset($arregloMenuPadre))) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar menues ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
} elseif (!$subMenuDeshabilitado) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar menues ya que la página se encuentra deshabilitada.</h1>";
} elseif (!$existeSubMenu) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar menues ya que la página no existe.</h1>";
} else {
?>

    <a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>

    <!-- Tabla para gestionar Menú -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de Menúes</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dgMenu" class="easyui-datagrid" style="width:60%"
            url="../accion/administrador/listarMenues.php"
            toolbar="#toolbarMenu"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idmenu" width="15">Id</th>
                    <th field="menombre" width="80">Nombre</th>
                    <th field="medescripcion" width="100">Descripcion</th>
                    <th field="idpadre" width="55">Id Padre</th>
                    <th field="medeshabilitado" width="50">Estado</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarMenu">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMenu()">Nuevo Menú</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editMenu()">Editar Menú</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyMenu()">Habilitar/Deshabilitar</a>
        </div>

        <div id="dlgMenu" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgMenu-buttons'">
            <form id="fmMenu" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion del Menú</h3>
                <div style="margin-bottom:10px">
                    <label for="menombre">Nombre:</label>
                    <input name="menombre" class="easyui-textbox" required="true" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <label for="medescripcion">Descripción:</label>
                    <input name="medescripcion" class="easyui-textbox" required="true" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <label for="idpadre">Id padre:</label>
                    <input name="idpadre" class="easyui-numberbox" required="true" style="width:100%">
                </div>
                <!--  <div>
                <input type="hidden" name="medeshabilitado" value="medeshabilitado">
            </div>  -->
                <div>
                    <input type="hidden" name="idmenu" value="idmenu">
                </div>
            </form>
        </div>
        <div id="dlgMenu-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMenu()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgMenu').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    <br>

    <!-- Tabla para gestionar MenuRol -->
    <h1 class="display-5 pb-3 fw-bold">Gestion de relaciones Menú-Rol</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dgMenuRol" class="easyui-datagrid" style="width:60%"
            url="../accion/administrador/listarMenuRoles.php"
            toolbar="#toolbarMenuRol"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idmenu" width="25">Id Menú</th>
                    <th field="menombre" width="25">Nombre del Menú</th>
                    <th field="idrol" width="25">Id Rol</th>
                    <th field="rodescripcion" width="25d">Descripción</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarMenuRol">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMenuRol()">Nueva relación Menú-Rol</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyMenuRol()">Eliminar relación Menú-Rol</a>
        </div>

        <div id="dlgMenuRol" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgMenuRol-buttons'">
            <form id="fmMenuRol" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion del menuRol</h3>
                <div style="margin-bottom:10px">
                    <label for="idmenu">Id Menu:</label>
                    <input name="idmenu" class="easyui-numberbox" required="true" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <label for="idrol">Id Rol:</label>
                    <input name="idrol" class="easyui-numberbox" required="true" style="width:100%">
                </div>
            </form>
        </div>
        <div id="dlgMenuRol-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMenuRol()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgMenuRol').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    <br>

    <!-- Tabla para gestionar Roles -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de Roles</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dg3" class="easyui-datagrid" style="width:60%"
            url="../accion/administrador/listarRoles.php"
            toolbar="#toolbar3"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idrol" width="50">Id Rol</th>
                    <th field="rodescripcion" width="50">Descripcion</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar3">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRol()">Nuevo Rol</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editRol()">Editar Rol</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyRol()">Eliminar Rol</a>
        </div>

        <div id="dlg3" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg3-buttons'">
            <form id="fm3" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion del Rol</h3>
                <div style="margin-bottom:10px">
                    <label for="rodescripcion">Descripción:</label>
                    <input name="rodescripcion" class="easyui-textbox" required="true" style="width:100%">
                </div>
                <div>
                    <input type="hidden" name="idrol" value="idrol">
                </div>
            </form>
        </div>
        <div id="dlg3-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveRol()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg3').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>

<?php
}
include_once("../estructura/pie.php");
?>