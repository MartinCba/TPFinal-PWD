<?php
    include_once("../../configuracion.php");
    $tituloPagina = "Actualizar Login";
    include_once("../estructura/encabezadoPrivado.php");

    if (!$permiso) {
        echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
        echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede actualizar su información ya que no tiene los permisos necesarios en su rol.</h1>";
    // Verifica que el menu padre no se encuentre deshabilitado
    } elseif (($rolActivo -> getIdrol() == $arregloObjMenuRol2[0] -> getObjRol() -> getIdrol()) && (!isset($arregloMenuPadre))) {
        echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
        echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede actualizar su información ya que la página se encuentra deshabilitada en una jerarquía superior del menú.</h1>";
    } elseif (!$subMenuDeshabilitado) {
        echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
        echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede actualizar su información ya que la página se encuentra deshabilitada.</h1>";
    } elseif (!$existeSubMenu) {
        echo "<a class='btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2' href='inicio.php'><i class='bi bi-arrow-90deg-left'></i></a>";
        echo "<br><br><br><h1 class='display-5 pb-3 fw-bold'>No puede actualizar su información ya que la página no existe.</h1>";
    } else {
?>

<a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2" href="inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>

<!-- Tabla para gestionar Usuario -->
<h1 class="display-5 pb-3 fw-bold">Gestión de Usuarios</h1>
<p class="lead">Pulse los botones para realizar las acciones que desee.</p>

<div class="d-flex justify-content-center">
    <table id="dgActLog" class="easyui-datagrid" style="width:700px"
            url="../accion/cliente/listarUsuarioActual.php"
            toolbar="#toolbarActLog"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idusuario" width="30">Id</th>
                <th field="usnombre" width="60">Nombre</th>
                <th field="uspass" width="120">Contraseña</th>
                <th field="usmail" width="55">Email</th>
            </tr>
        </thead>
    </table>
    <div id="toolbarActLog">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editLogin()">Editar Usuario</a>
    </div>

    <div id="dlgActLog" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgActLog-buttons'">
        <form id="fmActLog" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion del usuario</h3>
            <div style="margin-bottom:10px">
            <div>
                <input type="hidden" name="idusuario" value="idusuario">
            </div>
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
        </form>
    </div>
    <div id="dlgActLog-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveLogin()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgActLog').dialog('close')" style="width:90px">Cancelar</a>
    </div>
</div>

<?php
    }
    include_once("../estructura/pie.php");
?>