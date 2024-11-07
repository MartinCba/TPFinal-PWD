<?php
include_once("../../configuracion.php");
$tituloPagina = "Coffee store";
// Crea una nueva instancia de la clase Session.
$sesionInicial = new Session();

// Verifica si la sesión es válida.
if ($sesionInicial->validar()) {
    // Si la sesión es válida, incluye el encabezado privado.
    include_once("../estructura/encabezadoPrivado.php");
} else {
    // Si la sesión no es válida, cierra la sesión.
    $sesionInicial->cerrar();
    // Incluye el encabezado público.
    include_once("../estructura/encabezadoPublico.php");
}
?>

<h4 class="text-dark ">Encuentra productos nacionales e importados exclusivos y al mejor precio.</h4>

<div id="carouselInicio" class="carousel slide w-50 mt-5 m-auto" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button class="active" data-bs-target="#carouselInicio" data-bs-slide-to="0"></button>
        <button data-bs-target="#carouselInicio" data-bs-slide-to="1"></button>
        <button data-bs-target="#carouselInicio" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="login.php"><img class="d-block w-100  border-5 rounded" src="../img/gallery1.jpg" alt="Nosotros"></a>
        </div>
        <div class="carousel-item">
            <a href="login.php"><img class="d-block w-100  border-5 rounded" src="../img/gallery2.jpg" alt="Proyecto"></a>
        </div>
        <div class="carousel-item">
            <a href="login.php"><img class="d-block w-100  border-5 rounded" src="../img/gallery3.jpg" alt="Contacto"></a>
        </div>
    </div>

    <button class="carousel-control-prev" data-bs-target="#carouselInicio" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" data-bs-target="#carouselInicio" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
<h4 class="mt-4"><a href="login.php" class="text-decoration-none text-dark fw-bold">Inicia sesión</a> para ver nuestro catálogo.</h4>

<?php
include_once("../estructura/pie.php");
?>