<?php
include_once("../../configuracion.php");
$tituloPagina = "Sobre nosotros";

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
<h1 class="display-5 pb-3 fw-bold">Sobre nosotros</h1>
<p class="lead">Este proyecto fue creado por el Grupo 16, integrado por:</p>

<table class='table table-striped table-dark'>
    <thead>
        <tr>
            <th scope='col'>Alumno</th>
            <th scope='col'>Legajo</th>
            <th scope='col'>Mail</th>
            <th scope='col'>GitHub</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope='row'>Hernandez, Martín Alejandro</th>
            <td>FAI-4433</td>
            <td>malejandro.hernandez@est.fi.uncoma.edu.ar</td>
            <td><a href="https://github.com/MartinCba" class="link-light">MartinCba</a></td>
        </tr>
        <tr>
            <th scope='row'>Metzger, German</th>
            <td>FAI-3521</td>
            <td>german.metzger@est.fi.uncoma.edu.ar</td>
            <td><a href="https://github.com/GermanMetzger" class="link-light">GermanMetzger</a></td>
        </tr>
        <tr>
            <th scope='row'>Villegas, Martín</th>
            <td>FAI-3236</td>
            <td>martin.villegas@est.fi.uncoma.edu.ar</td>
            <td><a href="https://github.com/Martin-VillegasReibold" class="link-light">Martin-VillegasReibold</a></td>
        </tr>
    </tbody>
</table>

<p class="lead">Por medio de este trabajo final se logran integrar los conceptos vistos a lo largo de toda la cursada de la materia Programación Web Dinámica. Y para ello se implementó una tienda On-Line que consta de 2 vistas: una pública y otra privada; y a su vez se siguió una serie de pautas que se explican a detalle en el apartado de <a href="../paginas/acercaDe.php" class="link-dark fw-bold">Acerca del proyecto</a>.</p>


<?php
include_once("../estructura/pie.php");
?>