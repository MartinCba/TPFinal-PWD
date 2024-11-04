<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tituloPagina ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Barra Superior INICIO -->
    <nav class="navbar bg-dark bg-gradient navbar-dark position-absolute top-0 w-100">
        <div class="container-fluid">
            <a href="../paginas/inicio.php" class="navbar-brand fw-bold"><img id="logoPrincipal" src="../img/favicon.png" alt="Logo Tienda de cafe"> Coffee store</a>

            <button
                type="button"
                class="navbar-toggler collapsed"
                data-bs-target="#navbarNav"
                data-bs-toggle="collapse"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="text-white bi bi-person-fill"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav align-items-end">
                    <li class="nav-item">
                        <a href="../paginas/login.php" class="nav-link text-white">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a href="../paginas/registrarse.php" class="nav-link text-white">Registrarse</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- Barra Superior FIN -->

            <!-- Contenido Principal INICIO -->
            <div class="container mt-2 d-grid gap-5">
                <div class="py-3">