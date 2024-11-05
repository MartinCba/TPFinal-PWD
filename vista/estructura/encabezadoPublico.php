<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tituloPagina ?></title>
    <!-- jQuery EasyUI v1.10.17 -->
    <link rel="stylesheet" href="../../util/jquery-easyui-1.10.17/themes/default/easyui.css">
    <link rel="stylesheet" href="../../util/jquery-easyui-1.10.17/themes/icon.css">
    <script src="../../util/jquery-easyui-1.10.17/jquery.min.js"></script>
    <script src="../../util/jquery-easyui-1.10.17/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../js/jeasyui.js"></script>
    <!-- Bootstrap Icons v1.11.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" type="image/jpg" href="../img/favicon.png" />
</head>

<body>
    <!-- Barra Superior INICIO -->
    <nav class="navbar bg-dark bg-gradient navbar-dark position-absolute top-0 w-100">
        <div class="container-fluid">
            <a href="../paginas/inicio.php" class="navbar-brand fw-bold"><img id="logoPrincipal" src="../img/favicon.png" alt="Logo"> Coffee store</a>

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

    <!-- Banner de Fondo INICIO -->
    <div class="banner-image w-100 vh-100 d-flex justify-content-center overflow-auto">
        <div class="content text-center mt-5 w-100">

            <!-- Contenido Principal INICIO -->
            <div class="container mt-2 d-grid gap-5">
                <div class="py-3">