var url;

// FUNCIONES PARA LA GESTION DE USUARIOS

/**
 * Abre el diálogo para crear un nuevo usuario.
 */
function newUser() {
  $("#dlg").dialog("open").dialog("center").dialog("setTitle", "Nuevo Usuario");
  $("#fm").form("clear");
  url = "../accion/administrador/altaUsuarios.php";
}

/**
 * Abre el diálogo para editar un usuario seleccionado.
 */
function editUser() {
  var row = $("#dg").datagrid("getSelected");
  if (row) {
    $("#dlg")
      .dialog("open")
      .dialog("center")
      .dialog("setTitle", "Editar Usuario");
    $("#fm").form("load", row);
    url = "../accion/administrador/editarUsuarios.php";
  }
}

/**
 * Envía el formulario para guardar un usuario (nuevo o editado).
 */
function saveUser() {
  $("#fm").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlg").dialog("close"); // Cierra el diálogo
        $("#dg").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

/**
 * Cambia el estado de un usuario seleccionado.
 */
function destroyUser() {
  var row = $("#dg").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Cambiar el estado del Usuario?",
      function (r) {
        if (r) {
          $("#fm").form("load", row);
          url = "../accion/administrador/bajaUsuarios.php";
          $("#fm").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dg").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

// FUNCIONES PARA LA GESTION DE USUARIOROL

/**
 * Abre el diálogo para crear una nueva relación Usuario-Rol.
 */
function newUsuarioRol() {
  $("#dlg2")
    .dialog("open")
    .dialog("center")
    .dialog("setTitle", "Nueva relación Usuario-Rol");
  $("#fm2").form("clear");
  url = "../accion/administrador/altaUsuarioRol.php";
}

/**
 * Abre el diálogo para editar una relación Usuario-Rol seleccionada.
 */
function editUsuarioRol() {
  var row = $("#dg2").datagrid("getSelected");
  if (row) {
    $("#dlg5")
      .dialog("open")
      .dialog("center")
      .dialog("setTitle", "Editar relación Usuario-Rol");
    $("#fm5").form("load", row);
    url = "../accion/administrador/editarUsuarioRol.php";
  }
}

/**
 * Envía el formulario para guardar una relación Usuario-Rol (nueva o editada).
 */
function saveUsuarioRol() {
  $("#fm2").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlg2").dialog("close"); // Cierra el diálogo
        $("#dg2").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

/**
 * Envía el formulario para guardar una relación Usuario-Rol editada.
 */
function saveUsuarioRolEdit() {
  $("#fm5").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlg5").dialog("close"); // Cierra el diálogo
        $("#dg2").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

/**
 * Elimina una relación Usuario-Rol seleccionada.
 */
function destroyUsuarioRol() {
  var row = $("#dg2").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Estás seguro que quieres eliminar el UsuarioRol definitivamente?",
      function (r) {
        if (r) {
          $("#fm2").form("load", row);
          url = "../accion/administrador/bajaUsuarioRol.php";
          $("#fm2").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dg2").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

// FUNCIONES PARA LA GESTION DE ROLES

/**
 * Abre el diálogo para crear un nuevo rol.
 */
function newRol() {
  $("#dlg3").dialog("open").dialog("center").dialog("setTitle", "Nuevo Rol");
  $("#fm3").form("clear");
  url = "../accion/administrador/altaRol.php";
}

/**
 * Envía el formulario para guardar un rol (nuevo o editado).
 */
function saveRol() {
  $("#fm3").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlg3").dialog("close"); // Cierra el diálogo
        $("#dg3").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

/**
 * Abre el diálogo para editar un rol seleccionado.
 */
function editRol() {
  var row = $("#dg3").datagrid("getSelected");
  if (row) {
    $("#dlg3").dialog("open").dialog("center").dialog("setTitle", "Editar Rol");
    $("#fm3").form("load", row);
    url = "../accion/administrador/editarRol.php";
  }
}

/**
 * Elimina un rol seleccionado.
 */
function destroyRol() {
  var row = $("#dg3").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Estás seguro que quieres eliminar el Rol definitivamente?",
      function (r) {
        if (r) {
          $("#fm3").form("load", row);
          url = "../accion/administrador/bajaRol.php";
          $("#fm3").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dg3").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

// FUNCIONES PARA LA GESTION DE MENUES

/**
 * Abre el diálogo para crear un nuevo menú.
 */
function newMenu() {
  $("#dlgMenu")
    .dialog("open")
    .dialog("center")
    .dialog("setTitle", "Nuevo Menu");
  $("#fmMenu").form("clear");
  url = "../accion/administrador/altaMenues.php";
}

/**
 * Abre el diálogo para editar un menú seleccionado.
 */
function editMenu() {
  var row = $("#dgMenu").datagrid("getSelected");
  if (row) {
    $("#dlgMenu")
      .dialog("open")
      .dialog("center")
      .dialog("setTitle", "Editar Menu");
    $("#fmMenu").form("load", row);
    url = "../accion/administrador/editarMenues.php";
  }
}

/**
 * Envía el formulario para guardar un menú (nuevo o editado).
 */
function saveMenu() {
  $("#fmMenu").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlgMenu").dialog("close"); // Cierra el diálogo
        $("#dgMenu").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

/**
 * Cambia el estado de un menú seleccionado.
 */
function destroyMenu() {
  var row = $("#dgMenu").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Cambiar el estado del Menu?",
      function (r) {
        if (r) {
          $("#fmMenu").form("load", row);
          url = "../accion/administrador/bajaMenues.php";
          $("#fmMenu").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dgMenu").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

// FUNCIONES PARA LA GESTION DE MENUROL

/**
 * Abre el diálogo para crear una nueva relación Menu-Rol.
 */
function newMenuRol() {
  $("#dlgMenuRol")
    .dialog("open")
    .dialog("center")
    .dialog("setTitle", "Nuevo MenuRol");
  $("#fmMenuRol").form("clear");
  url = "../accion/administrador/altaMenuRol.php";
}

/**
 * Envía el formulario para guardar una relación Menu-Rol (nueva o editada).
 */
function saveMenuRol() {
  $("#fmMenuRol").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlgMenuRol").dialog("close"); // Cierra el diálogo
        $("#dgMenuRol").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

/**
 * Elimina una relación Menu-Rol seleccionada.
 */
function destroyMenuRol() {
  var row = $("#dgMenuRol").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Estás seguro que quieres eliminar el MenuRol definitivamente?",
      function (r) {
        if (r) {
          $("#fmMenuRol").form("load", row);
          url = "../accion/administrador/bajaMenuRol.php";
          $("#fmMenuRol").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dgMenuRol").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

// FUNCIONES PARA LA GESTION DE USUARIO CLIENTE

/**
 * Abre el diálogo para editar un usuario seleccionado.
 */
function editLogin() {
  var row = $("#dgActLog").datagrid("getSelected");
  if (row) {
    $("#dlgActLog")
      .dialog("open")
      .dialog("center")
      .dialog("setTitle", "Editar Usuario");
    $("#fmActLog").form("load", row);
    url = "../accion/cliente/editarUsuario.php";
  }
}

/**
 * Envía el formulario para guardar un usuario editado.
 */
function saveLogin() {
  $("#fmActLog").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlgActLog").dialog("close"); // Cierra el diálogo
        $("#dgActLog").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

// FUNCIONES PARA LA GESTION DE COMPRAESTADO

/**
 * Avanza al siguiente estado de una compra seleccionada.
 */
function siguienteEstado() {
  var row = $("#dgCompraEstado").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Seguro que desea avanzar la CompraEstado?",
      function (r) {
        if (r) {
          $("#fmCompraEstado").form("load", row);
          url = "../accion/administrador/siguienteEstadoCompra.php";
          $("#fmCompraEstado").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              console.log("Respuesta cruda del servidor:", result);
              var result = JSON.parse(result);
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dgCompraEstado").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

/**
 * Cancela el estado de una compra seleccionada.
 */
function cancelarCompraEstado() {
  var row = $("#dgCompraEstado").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Seguro que desea cancelar la CompraEstado?",
      function (r) {
        if (r) {
          $("#fmCompraEstado").form("load", row);
          url = "../accion/administrador/cancelarCompraEstado.php";
          $("#fmCompraEstado").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dgCompraEstado").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

// FUNCIONES PARA LA GESTION DE COMPRA

/**
 * Cambia el estado de una compra seleccionada.
 */
function destroyCompra() {
  var row = $("#dgClienteCompra").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Cambiar el estado del Menu?",
      function (r) {
        if (r) {
          $("#fmClienteCompra").form("load", row);
          url = "../accion/cliente/bajaClienteCompra.php";
          $("#fmClienteCompra").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $("#dgClienteCompra").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

/**
 * Muestra el detalle de una compra seleccionada.
 */
function muestraDetalleCompra() {
  var row = $("#dgCompraEstado").datagrid("getSelected");
  if (row) {
    window.location.href = "detalleCompra.php?idcompra=" + row.idcompra;
  }
}

// FUNCIONES PARA LA GESTION DE PRODUCTOS

/**
 * Abre el diálogo para crear un nuevo producto.
 */
function newProducto() {
  $("#dlgProductos")
    .dialog("open")
    .dialog("center")
    .dialog("setTitle", "Nuevo Producto");
  $("#fmProductos").form("clear");
  url = "../accion/deposito/altaProducto.php";
}

/**
 * Abre el diálogo para editar un producto seleccionado.
 */
function editProducto() {
  var row = $("#dgProductos").datagrid("getSelected");
  if (row) {
    $("#dlgProductos")
      .dialog("open")
      .dialog("center")
      .dialog("setTitle", "Editar Producto");
    $("#fmProductos").form("load", row);
    url = "../accion/deposito/editarProducto.php";
  }
}

/**
 * Envía el formulario para guardar un producto (nuevo o editado).
 */
function saveProducto() {
  $("#fmProductos").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlgProductos").dialog("close"); // Cierra el diálogo
        $("#dgProductos").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

/**
 * Cambia el estado de un producto seleccionado.
 */
function destroyProducto() {
  var row = $("#dgProductos").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Cambiar el estado del Producto?",
      function (r) {
        if (r) {
          $("#fmProductos").form("load", row);
          url = "../accion/deposito/bajaProducto.php";
          $("#fmProductos").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dgProductos").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

// FUNCIONES PARA LA GESTION DEL STOCK

/**
 * Abre el diálogo para editar el stock de un producto seleccionado.
 */
function editStock() {
  var row = $("#dgStock").datagrid("getSelected");
  if (row) {
    $("#dlgStock")
      .dialog("open")
      .dialog("center")
      .dialog("setTitle", "Editar Stock");
    $("#fmStock").form("load", row);
    url = "../accion/deposito/editarStock.php";
  }
}

/**
 * Envía el formulario para guardar el stock editado de un producto.
 */
function saveStock() {
  $("#fmStock").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlgStock").dialog("close"); // Cierra el diálogo
        $("#dgStock").datagrid("reload"); // Recarga los datos del usuario
      }
    },
  });
}

// FUNCIONES PARA GESTIONAR LA COMPRA DESDE EL CLIENTE

/**
 * Cancela una compra seleccionada por el cliente.
 */
function cancelarCompraCliente() {
  var row = $("#dgSeg").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Seguro que desea cancelar la CompraEstado?",
      function (r) {
        if (r) {
          $("#fmSeg").form("load", row);
          url = "../accion/cliente/cancelarCompraCliente.php";
          $("#fmSeg").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dgSeg").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

/**
 * Muestra el detalle de una compra seleccionada por el cliente.
 */
function verDetalleCliente() {
  var row = $("#dgSeg").datagrid("getSelected");
  if (row) {
    window.location.href = "detalleCompra.php?idcompra=" + row.idcompra;
  }
}

// FUNCION PARA ELIMINAR COMPRAITEM

/**
 * Elimina un ítem de compra seleccionado.
 */
function eliminarCompraItem() {
  var row = $("#dgCompraItem").datagrid("getSelected");
  if (row) {
    $.messager.confirm(
      "Confirmar",
      "Desea eliminar el Item definitivamente?",
      function (r) {
        if (r) {
          $("#fmCompraItem").form("load", row);
          url = "../accion/administrador/bajaCompraItem.php";
          $("#fmCompraItem").form("submit", {
            url: url,
            iframe: false,
            onSubmit: function () {
              return $(this).form("validate");
            },
            success: function (result) {
              var result = eval("(" + result + ")");
              if (result.errorMsg) {
                $.messager.show({
                  title: "Error",
                  msg: result.errorMsg,
                });
              } else {
                $.messager.show({
                  title: "Operacion exitosa",
                  msg: result.respuesta,
                });
                $("#dgCompraItem").datagrid("reload"); // Recarga los datos del menú
              }
            },
          });
        }
      }
    );
  }
}

// FUNCIONES PARA QUE EL DEPOSITO PUEDA CARGAR UNA IMAGEN DEL PRODUCTO

/**
 * Abre el diálogo para cargar una imagen de un producto.
 */
function cargarImagen() {
  $("#dlgImg")
    .dialog("open")
    .dialog("center")
    .dialog("setTitle", "Cargar Imagen");
  $("#fmImg").form("clear");
  url = "../accion/deposito/cargarImagen.php";
}

/**
 * Envía el formulario para guardar la imagen de un producto.
 */
function saveImagen() {
  $("#fmImg").form("submit", {
    url: url,
    iframe: false,
    onSubmit: function () {
      return $(this).form("validate");
    },
    success: function (result) {
      var result = eval("(" + result + ")");
      if (result.errorMsg) {
        $.messager.show({
          title: "Error",
          msg: result.errorMsg,
        });
        $("#dlgImg").dialog("close");
      } else {
        $.messager.show({
          title: "Operacion exitosa",
          msg: result.respuesta,
        });
        $("#dlgImg").dialog("close"); // Cierra el diálogo
        $("#dgProductos").datagrid("reload");
      }
    },
  });
}
