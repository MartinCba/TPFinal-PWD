<?php
include_once("../../configuracion.php");

$tituloPagina = "Contacto";

// Inicia una nueva sesión.
$sesionInicial = new Session();

// Verifica si la sesión es válida.
if ($sesionInicial->validar()) {
    // Si la sesión es válida, incluye el encabezado privado.
    include_once("../estructura/encabezadoPrivado.php");
} else {
    // Si la sesión no es válida, cierra la sesión e incluye el encabezado público.
    $sesionInicial->cerrar();
    include_once("../estructura/encabezadoPublico.php");
}
?>

<!-- Botón para regresar a la página de inicio -->
<a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2" href="inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>

<!-- Título de la página -->
<h1 class="display-5 fw-bold">Contacto</h1>

<!-- Mapa de Google Maps -->
<iframe class="w-100 h-100 border border-dark border-5 rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3681.0079818375702!2d-68.05829494799443!3d-38.94228593854499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x960a33dc04b92efd%3A0x3936815d48857757!2sThe%20Coffee%20Store!5e1!3m2!1ses-419!2sar!4v1730892032068!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- Información de contacto -->
<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h3>Dirección</h3>
                <p>Dr. Luis Federico Leloir 351 (Neuquén Capital)</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h3>Teléfono</h3>
                <p>+54 299 592-4473</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h3>Email</h3>
                <p>contacto@coffeestore.com.ar</p>
            </div>
        </div>
    </div>
</div>

<?php
// Incluye el pie de página.
include_once("../estructura/pie.php");
?>