<?php

class Session
{
    // Constructor que Inicia la sesión.
    public function __construct()
    {
        session_start();
    }

    // Actualiza las variables de sesión con los valores ingresados.
    public function iniciar($nombreUsuario, $psw)
    {
        $resp = false;
        $objAbmUsuario = new AbmUsuario();
        $sesionActual['usnombre'] = $nombreUsuario;
        $sesionActual['uspass'] = $psw;
        $sesionActual['usdeshabilitado'] = null;
        $objSesionActual = $objAbmUsuario->buscar($sesionActual);
        if ($objSesionActual) {
            $usuarioSesionActual = $objSesionActual[0];
            if ($usuarioSesionActual->getUsdeshabilitado() == NULL) {
                $_SESSION['idusuario'] = $usuarioSesionActual->getIdusuario();
                $resp = true;
            } else {
                $this->cerrar();
            }
        } else {
            $this->cerrar();
        }
        return $resp;
    }

    // Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
    public function validar()
    {
        $resp = false;
        if ($this->activa() && isset($_SESSION['idusuario'])) {
            $resp = true;
        }
        return $resp;
    }

    // Devuelve true o false si la sesión está activa o no. 
    public function activa()
    {
        $resp = false;
        if (session_status() == PHP_SESSION_ACTIVE) {
            $resp = true;
        }
        return $resp;
    }

    // Devuelve el usuario logeado.
    public function getUsuario()
    {
        $objUsuario = null;
        if ($this->validar()) {
            $objAbmUsuario = new AbmUsuario();
            if ($listaUsuarios = $objAbmUsuario->buscar($_SESSION)) {
                $objUsuario = $listaUsuarios[0];
            }
        }
        return $objUsuario;
    }

    // Devuelve el rol del usuario logeado.
    public function getRol()
    {
        $listaRoles = null;
        if ($this->validar()) {
            $objAbmUsuarioRol = new AbmUsuarioRol();
            if ($listaUsuarioRol = $objAbmUsuarioRol->buscar(["idusuario" => $_SESSION['idusuario']])) {
                for ($i = 0; $i < count($listaUsuarioRol); $i++) {
                    $listaRoles[$i] = $listaUsuarioRol[$i]->getObjRol();
                }
            }
        }
        return $listaRoles;
    }

    //  Cierra la sesión actual.
    public function cerrar()
    {
        session_destroy();
    }

    public function obtenerRolActivo()
    {
        $objAbmRol = new AbmRol();
        $rol = NULL;
        if (isset($_SESSION['rolactivo'])) {
            $rol = $objAbmRol->buscar(["idrol" => $_SESSION['rolactivo']]);
            $rol = $rol[0];
        }
        return $rol;
    }

    public function establecerRolActivo($idrol)
    {
        $resp = false;
        $roles = $this->getRol();
        $i = 0;
        while ($i < count($roles) && !$resp) {
            if ($roles[$i]->getIdrol() == $idrol) {
                $_SESSION['rolactivo'] = $idrol;
                $resp = true;
            }
            $i++;
        }
    }
}
