<?php
include_once("../../configuracion.php");

$tituloPagina = "Acerca Del proyecto";

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

<a class="btn btn-lg btn-dark text-center text-white float-start position-absolute d-flex justify-content-start mt-2" href="inicio.php"><i class="bi bi-arrow-90deg-left"></i></a>
<h1 class="display-5 pb-3 fw-bold">Acerca del proyecto</h1>

<div class="accordion" id="investigacion">
    <!-- Primera pregunta INICIO -->
    <div class="accordion-item bg-transparent border border-dark">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed text-white bg-dark bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta1" aria-expanded="false" aria-controls="pregunta1">
                ¿En que consta la vista pública de la tienda On-Line?
            </button>
        </h2>
        <div id="pregunta1" class="accordion-collapse collapse" data-bs-parent="#investigacion">
            <div class="accordion-body text-start">
                <p>En esta vista, se tiene acceso a información general del proyecto y la tienda. A su vez, permite acceder a la vista privada de la aplicación, a partir del ingreso de un usuario y contraseña válida.</p>
            </div>
        </div>
    </div>
    <!-- Primera pregunta FIN -->
    <!-- Segunda pregunta INICIO -->
    <div class="accordion-item bg-transparent border border-dark">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed text-white bg-dark bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta2" aria-expanded="false" aria-controls="pregunta2">
                ¿En que consta la vista privada de la tienda On-Line?
            </button>
        </h2>
        <div id="pregunta2" class="accordion-collapse collapse" data-bs-parent="#investigacion">
            <div class="accordion-body text-start bg-white">
                <p>Luego de concretarse el proceso de autenticación y dependiendo de el/los rol/es con el/los que cuente el usuario que ingresa al sistema, permite realizar diferentes operaciones. Los roles utilizados son: cliente, depósito y administrador.</p>
            </div>
        </div>
    </div>
    <!-- Segunda pregunta FIN -->
    <!-- Tercera pregunta INICIO -->
    <div class="accordion-item bg-transparent border border-dark">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed text-white bg-dark bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta3" aria-expanded="false" aria-controls="pregunta3">
                ¿Qué pautas básicas se siguió en el proceso de creación del proyecto de trabajo final?
            </button>
        </h2>
        <div id="pregunta3" class="accordion-collapse collapse" data-bs-parent="#investigacion">
            <div class="accordion-body text-start">
                <ol>
                    <li>La aplicación está desarrollada sobre una arquitectura MVC (Modelo-Vista-Control) utilizando PHP como lenguaje de programación.</li>
                    <li>Tiene páginas públicas y otras restringidas, que sólo pueden ser accedidas a partir de un usuario y contraseña, para lo cual se implementa un módulo de autenticación.</li>
                    <li>Posee un menú dinámico que puede ser gestionado por el administrador de la aplicación.</li>
                    <li>Cualquier usuario que tiene más de un rol asignado, puede cambiar de rol según lo desee.</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Tercera pregunta FIN -->
    <!-- Cuarta pregunta INICIO -->
    <div class="accordion-item bg-transparent border border-dark">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed text-white bg-dark bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta4" aria-expanded="false" aria-controls="pregunta4">
                ¿Qué se puede hacer desde el rol de Cliente?
            </button>
        </h2>
        <div id="pregunta4" class="accordion-collapse collapse" data-bs-parent="#investigacion">
            <div class="accordion-body text-start">
                <ul>
                    <li>Gestionar los datos de su cuenta, como cambiar su e-mail y contraseña.</li>
                    <li>Realizar la compra de uno o más productos con stock suficiente.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Cuarta pregunta FIN -->
    <!-- Quinta pregunta INICIO -->
    <div class="accordion-item bg-transparent border border-dark">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed text-white bg-dark bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta5" aria-expanded="false" aria-controls="pregunta5">
                ¿Qué se puede hacer desde el rol de Deposito?
            </button>
        </h2>
        <div id="pregunta5" class="accordion-collapse collapse" data-bs-parent="#investigacion">
            <div class="accordion-body text-start">
                <ul>
                    <li>Crear nuevos productos y administrar los existentes.</li>
                    <li>Acceder a los procedimientos que permite el cambio de estado de los productos.</li>
                    <li>Modificar el stock de los productos.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Quinta pregunta FIN -->
    <!-- Sexta pregunta INICIO -->
    <div class="accordion-item bg-transparent border border-dark">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed text-white bg-dark bg-gradient" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta6" aria-expanded="false" aria-controls="pregunta6">
                ¿Qué se puede hacer desde el rol de Administrador?
            </button>
        </h2>
        <div id="pregunta6" class="accordion-collapse collapse" data-bs-parent="#investigacion">
            <div class="accordion-body text-start">
                <ul>
                    <li>Crear nuevos usuarios al sistema, asignar los roles correspondientes y actualizar la información que se requiera.</li>
                    <li>Gestionar y administrar nuevos roles e ítems del menú. Vinculando item del menú al rol según corresponda.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Sexta pregunta FIN -->
</div>

<?php
include_once("../estructura/pie.php");
?>