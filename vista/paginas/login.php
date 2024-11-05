<?php
include_once("../../configuracion.php");
$tituloPagina = "Login";
// Crea una nueva instancia de la clase Session.
$sesionLogin = new Session();

// Verifica si la sesión es válida.
if ($sesionLogin->validar()) {
    // Si la sesión es válida, incluye el encabezado privado.
    include_once("../estructura/encabezadoPrivado.php");
} else {
    // Si la sesión no es válida, cierra la sesión.
    $sesionLogin->cerrar();
    // Incluye el encabezado público.
    include_once("../estructura/encabezadoPublico.php");
}
// Recopila y procesa los datos enviados.
$datos = data_submitted();
?>

<a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start" href="../paginas/inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>
<h1 class="mb-5 fw-bold">Login</h1>
<div class="d-flex justify-content-center">
    <div class="w-50">
        <form method="post" action="../accion/verificarLogin.php" class="needs-validation p-5 border border-dark" novalidate>
            <div style="color:red">
                <?php
                $mensaje = "";

                // Verifica si existe un error en los datos enviados.
                if (isset($datos['error'])) {
                    // Si hay un error, asigna el mensaje de error a la variable $mensaje.
                    $mensaje = $datos['error'];
                }

                // Si $mensaje no está vacío, muestra el mensaje de error.
                if (!$mensaje == "") {
                    echo $mensaje;
                }
                ?>
            </div>
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
            <br />
            <input type="submit" class="btn btn-dark" value="Iniciar Sesión">
        </form>
        <script src="../js/function.js"></script>
    </div>
</div>

<?php
include_once("../estructura/pie.php");
?>