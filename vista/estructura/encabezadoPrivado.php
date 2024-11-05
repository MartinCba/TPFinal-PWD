<?php
// Evita que los errores sean impresos en pantalla como parte de la salida.
// Oculta al usuario loguado el mensaje "Ignoring session_start() because a session is already active".
ini_set('display_errors', 0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tituloPagina ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/jpg" href="../img/favicon.png" />
    <!-- jQuery EasyUI v1.10.17 -->
    <link rel="stylesheet" href="../../util/jquery-easyui-1.10.17/themes/black/easyui.css">
    <link rel="stylesheet" href="../../util/jquery-easyui-1.10.17/themes/icon.css">
    <script src="../../util/jquery-easyui-1.10.17/jquery.min.js"></script>
    <script src="../../util/jquery-easyui-1.10.17/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../js/jeasyui.js"></script>
    <!-- Bootstrap Icons v1.11.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Bootstrap v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    // Recopila y procesa los datos enviados.
    $datos = data_submitted();

    // Crea una nueva instancia de la clase Session.
    $sesionActual = new Session();

    // Si no hay una sesión activa, redirige a la página de inicio.
    if (!$sesionActual->validar()) {
        header("Location:../paginas/inicio.php");
    }

    // Obtiene los roles correspondientes a la sesión actual.
    $roles = $sesionActual->getRol() ?? [];
    $rolActivo = NULL;

    if (count($roles) > 0) {
        if (isset($datos["idrol"])) {
            // Si se proporciona un idrol, establece el rol activo.
            $sesionActual->establecerRolActivo($datos["idrol"]);
            $rolActivo = $sesionActual->obtenerRolActivo();
        } else {
            // Si no se proporciona un idrol, asigna por defecto el idrol con mayor jerarquía.
            $rolActivo = $sesionActual->obtenerRolActivo();
        }
        if ($rolActivo == []) {
            $rolActivo = $roles[0];
        }

        // Crea una nueva instancia de la clase AbmMenuRol.
        $objAbmMenuRol = new AbmMenuRol();
        // Obtiene un arreglo de menuRol.
        $arregloMenu = $objAbmMenuRol->buscar(['idrol' => $rolActivo->getIdrol()]);

        if (count($arregloMenu) > 0) {
            // Crea una nueva instancia de la clase AbmMenu.
            $ObjAbmMenu = new AbmMenu();
            // Obtiene el arreglo del menú padre (es decir, de roles).
            $arregloMenuPadre = $ObjAbmMenu->buscar(['idmenu' => $rolActivo->getIdrol()]);
            if (is_array($arregloMenuPadre) && count($arregloMenuPadre) > 0) {
                $idMenuPadre = $arregloMenuPadre[0]->getIdmenu();
                // Obtiene el arreglo del submenú de hijos del menú padre (es decir, opciones de cada rol).
                $arregloSubMenu = $ObjAbmMenu->buscar(['idpadre' => $idMenuPadre]);
            } else {
                $arregloSubMenu = [];
            }
        } else {
            $arregloSubMenu = [];
        }
    } else {
        // Si no existen roles para la sesión actual, cierra la sesión y redirige.
        header("Location:../accion/cerrarSesion.php");
    }

    // Obtiene la ruta del script actual.
    $ruta1 = $_SERVER['PHP_SELF'];
    $ruta1 = explode("/", $ruta1);
    $ruta2 = $ruta1[count($ruta1) - 1];
    $ruta2 = explode(".", $ruta2);

    if (isset($arregloSubMenu)) {
        $i = 0;
        $subMenuDeshabilitado = false;
        while (($i < count($arregloSubMenu)) && (!$subMenuDeshabilitado)) {
            $subMenuActual = $arregloSubMenu[$i];
            // Verifica que el submenú se encuentre habilitado.
            if ($subMenuActual->getMedeshabilitado() != 'null') {
                $subMenuDeshabilitado = true;
            }
            $i++;
        }
        $i = 0;
        $existeSubMenu = false;
        $existeSubMenuTienda = false;
        while (($i < count($arregloSubMenu)) && (!$existeSubMenu)) {
            $subMenuActual = $arregloSubMenu[$i];
            // Verifica si el submenú existe.
            if ($subMenuActual->getMedescripcion() == $ruta2[0]) {
                $existeSubMenu = true;
            }
            if ($subMenuActual->getMedescripcion() == "tienda") {
                $existeSubMenuTienda = true;
            }
            $i++;
        }
    }

    // Verifica que el usuario tenga los permisos de rol correspondientes.
    $permiso = false;
    foreach ($arregloMenu as $menu) {
        $idMenuYSubmenu = $menu->getObjMenu()->getIdmenu();
        $objAbmMenuRol2 = new AbmMenuRol();
        $arregloObjMenuRol2 = $objAbmMenuRol2->buscar(['idmenu' => $idMenuYSubmenu]);
        if (($menu->getObjMenu()->getMedescripcion() == $ruta2[0]) && ($menu->getObjMenu()->getMedeshabilitado() == NULL) && $rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) {
            $permiso = true;
        }
    }

    // Verifica que el usuario tenga los permisos de rol correspondientes (en detalleCompra.php).
    $permiso2 = false;
    foreach ($arregloMenu as $menu) {
        $idMenuYSubmenu = $menu->getObjMenu()->getIdmenu();
        $objAbmMenuRol2 = new AbmMenuRol();
        $arregloObjMenuRol2 = $objAbmMenuRol2->buscar(['idmenu' => $idMenuYSubmenu]);
        if ($rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) {
            $permiso2 = true;
        }
    }

    // Verifica que el usuario tenga los permisos de rol correspondientes (en producto.php).
    $permiso3 = false;
    foreach ($arregloMenu as $menu) {
        $idMenuYSubmenu = $menu->getObjMenu()->getIdmenu();
        $objAbmMenuRol2 = new AbmMenuRol();
        $arregloObjMenuRol2 = $objAbmMenuRol2->buscar(['idmenu' => $idMenuYSubmenu]);
        if (($menu->getObjMenu()->getMedescripcion() == "tienda") && ($menu->getObjMenu()->getMedeshabilitado() == NULL) && $rolActivo->getIdrol() == $arregloObjMenuRol2[0]->getObjRol()->getIdrol()) {
            $permiso3 = true;
        }
    }
    ?>

    <header> <!-- Barra Superior INICIO -->
        <nav class="navbar bg-dark bg-gradient navbar-dark fixed-top">
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
                    <span class="text-white bi bi-person-fill"> <?php echo $sesionActual->getUsuario()->getusnombre(); ?></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarNav">
                    <ul class="navbar-nav align-items-end">
                        <li class="nav-item">
                            <div class="text-white">ROL: <?php echo $rolActivo->getRodescripcion(); ?></div>
                        </li>
                        <li class="nav-item dropdown">
                            <?php
                            // Genera un enlace desplegable para el menú.
                            echo "<a href='#' id='desplegable1' class='nav-link dropdown-toggle text-white' data-bs-toggle='dropdown'>";

                            // Verifica si existe el menú padre.
                            if (isset($arregloMenuPadre)) {
                                // Si el menú padre no está deshabilitado, muestra su nombre.
                                if ($arregloMenuPadre[0]->getMedeshabilitado() == NULL) {
                                    echo $arregloMenuPadre[0]->getMenombre();
                                } else {
                                    // Si el menú padre está deshabilitado, muestra "Sin opciones" y vacía el arreglo de menús.
                                    echo "Sin opciones";
                                    $arregloMenu = array();
                                }
                                echo "</a>";

                                // Genera la lista desplegable de menús.
                                echo "<ul class='dropdown-menu dropdown-menu-dark'>";
                                foreach ($arregloMenu as $menu) {
                                    // Verifica si el menú no está deshabilitado.
                                    if ($menu->getObjMenu()->getMedeshabilitado() == NULL) {
                                        // Verifica si la descripción del menú no está vacía y si tiene un menú padre.
                                        if (($menu->getObjMenu()->getMedescripcion() != "") && ($menu->getObjMenu()->getObjMenu() != NULL)) {
                                            $enlace = $menu->getObjMenu()->getMedescripcion() . ".php";
                                            $idrol = $rolActivo->getIdrol();
                                            // Genera el enlace para cada opción del menú.
                                            echo "<li><a class='dropdown-item text-white link-underline link-underline-opacity-0' href='" . $enlace . "?idrol=" . $rolActivo->getIdrol() . "' >" . $menu->getObjMenu()->getMenombre() . "</a></li>";
                                        }
                                    }
                                }
                            }
                            echo "</ul>";
                            ?>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" id="desplegable2" class=" nav-link text-white dropdown-toggle" data-bs-toggle="dropdown">Cambiar Rol</a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <?php
                                // Recorre cada rol del usuario.
                                foreach ($roles as $rol) {
                                    // Obtiene la descripción del rol.
                                    $nombreRol = $rol->getRodescripcion();
                                    // Obtiene el ID del rol.
                                    $idRol = $rol->getIdrol();
                                    // Genera un enlace para cada rol, que redirige a "paginaSegura.php" con el idrol correspondiente.
                                    echo "<li><a class='dropdown-item text-white link-underline link-underline-opacity-0 w-100' href='paginaSegura.php?idrol=" . $idRol . "'>" . $nombreRol . "</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../accion/cerrarSesion.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header> <!-- Barra Superior FIN -->

    <section> <!-- Contenido Principal INICIO -->
        <div class="content text-center w-100">
            <div class="container mt-2 d-grid gap-5">
                <div class="py-3">