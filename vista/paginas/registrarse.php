<?php
include_once("../../configuracion.php");
$tituloPagina = "Registrarse";
// Crea una nueva instancia de la clase Session.
$sesionRegistro = new Session();

// Recopila y procesa los datos enviados.
$datos = data_submitted();

// Verifica si la sesión es válida.
if ($sesionRegistro->validar()) {
    // Obtiene los roles del usuario.
    $roles = $sesionRegistro->getRol();
    if ($roles != NULL) {
        if ($roles !== null && count($roles) > 0) {
            // Crea una nueva instancia de la clase AbmRol.
            $objRol = new AbmRol;
            if (isset($datos["idrol"])) {
                // Si se proporciona un idrol, busca el rol correspondiente.
                $rolActivo = $objRol->buscar(['idrol' => $datos["idrol"]]);
            } else {
                // Si no se proporciona un idrol, asigna por defecto el idrol con mayor jerarquía.
                $rolActivo = $objRol->buscar(['idrol' => $roles[0]->getIdrol()]);
            }
        }
    }
    // Redirige a la página segura con el idrol activo.
    header("Location:paginaSegura.php?idrol=" . $rolActivo[0]->getIdrol());
} else {
    // Si la sesión no es válida, cierra la sesión.
    $sesionRegistro->cerrar();
    // Incluye el encabezado público.
    include_once("../estructura/encabezadoPublico.php");
}
?>

<a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>
<h1 class="mb-5 fw-bold">Registrarse</h1>
<div class="d-flex justify-content-center">
    <div class="w-50">
        <form method="post" action="../accion/accionRegistrarse.php" class="needs-validation p-5 border border-dark" novalidate>
            <div class="form-group">
                <label for="usnombre">Nombre de Usuario:</label>
                <input id="usnombre" name="usnombre" class="form-control" type="text" required pattern="^[a-zA-Z][a-zA-Z0-9]*$">
                <div class="valid-feedback">
                    Correcto.
                </div>
                <div class="invalid-feedback">
                    Incorrecto.
                </div>
            </div>
            <div class="form-group">
                <label>Contraseña:</label><br />
                <input id="uspass" name="uspass" class="form-control" type="password" required pattern="^[a-zA-Z0-9][a-zA-Z0-9]*$">
                <div class="valid-feedback">
                    Correcto.
                </div>
                <div class="invalid-feedback">
                    Incorrecto.
                </div>
            </div>
            <div class="form-group">
                <label>Email:</label><br />
                <input id="usmail" name="usmail" class="form-control" type="email" required>
                <div class="valid-feedback">
                    Correcto.
                </div>
                <div class="invalid-feedback">
                    Incorrecto.
                </div>
            </div>
            <br />
            <input type="submit" class="btn btn-dark" value="Registrarse">
        </form>
        <script src="../js/function.js"></script>
    </div>
</div>

<?php
include_once("../estructura/pie.php");
?>