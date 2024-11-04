<?php
include_once("../../configuracion.php");
$tituloPagina = "Coffee store";
$sesionInicial = new Session();
if ($sesionInicial->validar()) {
    include_once("../estructura/encabezadoPrivado.php");
} else {
    $sesionInicial->cerrar();
    include_once("../estructura/encabezadoPublico.php");
}
?>

<p class="lead">Encuentra productos nacionales e importados exclusivos y al mejor precio.</p>
<div id="carouselInicio" class="carousel slide carousel-fade carousel-dark w-50 m-auto" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button class="active" data-bs-target="#carouselInicio" data-bs-slide-to="0"></button>
        <button data-bs-target="#carouselInicio" data-bs-slide-to="1"></button>
        <button data-bs-target="#carouselInicio" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="quienesSomos.php"><img class="d-block w-100 border border-dark border-5 rounded" src="#" alt=""></a>
            <div class="carousel-caption">
                <h5>ffffff</h5>
                <p>Breve descripción sobre el equipo</p>
            </div>
        </div>
        <div class="carousel-item">
            <a href="acercaDe.php"><img class="d-block w-100 border border-dark border-5 rounded" src="#" alt=""></a>
            <div class="carousel-caption">
                <h5>fffffff</h5>
                <p>Información general sobre la página</p>
            </div>
        </div>
        <div class="carousel-item">
            <a href="contactenos.php"><img class="d-block w-100 border border-dark border-5 rounded" src="#" alt="Contacto"></a>
            <div class="carousel-caption">
                <h5>Contacto</h5>
                <p>Estamos para ayudarlo</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" data-bs-target="#carouselInicio" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" data-bs-target="#carouselInicio" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<?php
include_once("../estructura/pie.php");
?>