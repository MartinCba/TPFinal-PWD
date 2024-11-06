<?php
include_once("../../configuracion.php");
$tituloPagina = "Gestión de Usuarios";
include_once("../estructura/encabezadoPrivado.php");

if (!$permiso) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar usuarios ya que no tiene los permisos necesarios en su rol o el menú se encuentra deshabilitado.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
} elseif (($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) && (!isset($arregloMenuPadre))) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar usuarios ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
} elseif (!$subMenuDeshabilitado) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar usuarios ya que la página se encuentra deshabilitada.</h1>";
} elseif (!$existeSubMenu) {
    echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
    echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede gestionar usuarios ya que la página no existe.</h1>";
} else {
?>

    <a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>

    <!-- Tabla para gestionar Usuario -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de Usuarios</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dg" class="easyui-datagrid" style="width:60%"
            url="../accion/administrador/listarUsuarios.php"
            toolbar="#toolbar"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idusuario" width="15">Id</th>
                    <th field="usnombre" width="60">Nombre</th>
                    <th field="uspass" width="120">Contraseña</th>
                    <th field="usmail" width="55">Email</th>
                    <th field="usdeshabilitado" width="50">Estado</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo Usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Habilitar/Deshabilitar</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion del usuario</h3>
                <div style="margin-bottom:10px">
                    <label for="usnombre">Nombre:</label>
                    <input name="usnombre" class="easyui-textbox" required="true" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <label for="uspass">Contraseña:</label>
                    <input name="uspass" class="easyui-textbox" required="true" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <label for="usmail">Email:</label>
                    <input name="usmail" class="easyui-textbox" required="true" validType="email" style="width:100%">
                </div>
                <div>
                    <input type="hidden" name="usdeshabilitado" value="usdeshabilitado">
                </div>
                <div>
                    <input type="hidden" name="idusuario" value="idusuario">
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    <br>

    <!-- Tabla para gestionar UsuarioRol -->
    <h1 class="display-5 pb-3 fw-bold">Gestión de relaciones Usuarios-Rol</h1>
    <p class="lead">Pulse los botones para realizar las acciones que desee.</p>

    <div class="d-flex justify-content-center">
        <table id="dg2" class="easyui-datagrid" style="width:60%"
            url="../accion/administrador/listarUsuarioRol.php"
            toolbar="#toolbar2"
            rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idusuario" width="25">Id Usuario</th>
                    <th field="usnombre" width="25">Nombre de Usuario</th>
                    <th field="idrol" width="25">Id Rol</th>
                    <th field="rodescripcion" width="25d">Descripcion</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar2">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUsuarioRol()">Nueva relación Usuario-Rol</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUsuarioRol()">Editar relación Usuario-Rol</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUsuarioRol()">Eliminar relación Usuario-Rol</a>
        </div>

        <div id="dlg5" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg5-buttons'">
            <form id="fm5" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion del UsuarioRol</h3>
                <div>
                    <input type="hidden" name="idusuario" value="idusuario">
                </div>
                <div style="margin-bottom:10px">
                    <label for="idrol">Id Rol:</label>
                    <input name="idrol" class="easyui-numberbox" required="true" style="width:100%">
                </div>
            </form>
        </div>
        <div id="dlg5-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsuarioRolEdit()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg5').dialog('close')" style="width:90px">Cancelar</a>
        </div>

        <div id="dlg2" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg2-buttons'">
            <form id="fm2" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion del usuarioRol</h3>
                <div style="margin-bottom:10px">
                    <label for="idusuario">Id Usuario:</label>
                    <input name="idusuario" class="easyui-numberbox" required="true" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <label for="idrol">Id Rol:</label>
                    <input name="idrol" class="easyui-numberbox" required="true" style="width:100%">
                </div>
            </form>
        </div>
        <div id="dlg2-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsuarioRol()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')" style="width:90px">Cancelar</a>
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