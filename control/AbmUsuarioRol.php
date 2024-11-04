<?php

class AbmUsuarioRol
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idusuario', $param) and array_key_exists('idrol', $param)) {
            $obj = new UsuarioRol();
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param["idusuario"]);
            $objUsuario->cargar();
            $objRol = new Rol();
            $objRol->setIdrol($param["idrol"]);
            $objRol->cargar();
            $obj->setear($objUsuario, $objRol);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $obj = new UsuarioRol();
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param["idusuario"]);
            $objUsuario->cargar();
            $objRol = new Rol();
            $objRol->setIdrol($param["idrol"]);
            $objRol->cargar();
            $obj->setear($objUsuario, $objRol);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo están seteados los campos claves.
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idusuario']) and isset($param["idrol"])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Permite crear un objeto.
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        //$param['Patente'] = null;
        $objUsuarioRol = $this->cargarObjeto($param);
        // verEstructura($objAuto);
        if ($objUsuarioRol != null and $objUsuarioRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Permite eliminar un objeto.
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuarioRol = $this->cargarObjetoConClave($param);
            if ($objUsuarioRol != null and $objUsuarioRol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    // duda sobre si se puede modificar
    /**
     * Permite modificar un objeto.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuarioRol = $this->cargarObjeto($param);
            if ($objUsuarioRol != null and $objUsuarioRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite buscar un objeto.
     * @param array $param
     * @return boolean
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario =" . $param['idusuario'];
            }
            if (isset($param['idrol'])) {
                $where .= " and idrol =" . $param['idrol'];
            }
        }
        $objUsuarioRol = new UsuarioRol();
        $arreglo = $objUsuarioRol->listar($where);
        return $arreglo;
    }

    public function crearUsuarioRol($param)
    {
        $arreglo1["idusuario"] = $param["idusuario"];
        $arreglo2["idrol"] = $param["idrol"];
        $objAbmUsuario = new AbmUsuario();
        $objAbmRol = new AbmRol();
        if ($objAbmUsuario->buscar($arreglo1)) {
            if ($objAbmRol->buscar($arreglo2)) {
                if ($this->buscar($param)) {
                    $respuesta["errorMsg"] = "Ya existe esa relación con el idusuario y el idrol ingresados!";
                } else {
                    if ($this->alta($param)) {
                        $respuesta["respuesta"] = "Se dio de alta el UsuarioRol correctamente!";
                    } else {
                        $respuesta["errorMsg"] = "No se pudo realizar el alta del UsuarioRol";
                    }
                }
            } else {
                $respuesta["errorMsg"] = "No existe un Rol con el id ingresado";
            }
        } else {
            $respuesta["errorMsg"] = "No existe un Usuario con el id ingresado";
        }
        return $respuesta;
    }

    public function editarUsuarioRol($param)
    {
        $objAbmRol = new AbmRol();
        $arreglo["idrol"] = $param["idrol"];
        $listaRol = $objAbmRol->buscar($arreglo);
        $arregloObjUsuarioRol = $this->buscar(['idusuario' => $param['idusuario']]);
        if (count($arregloObjUsuarioRol) == 1) {
            if ($listaRol) {
                if ($this->modificacion($param)) {
                    $respuesta["respuesta"] = "Se modificó el usuario rol correctamente!";
                } else {
                    $respuesta["errorMsg"] = "No se pudo realizar la modificacion";
                }
            } else {
                $respuesta["errorMsg"] = "No existe el rol ingresado";
            }
        } elseif (count($arregloObjUsuarioRol) > 1) {
            $respuesta["errorMsg"] = "No se puede modificar debido a que existe mas de un usuariorol con el idusuario, debe ser creado una nueva relacion usuariorol";
        }
        return $respuesta;
    }

    public function listarUsuarioRol()
    {
        $listaUsuariosRol = $this->buscar(null);
        $arregloSalida = array();
        foreach ($listaUsuariosRol as $elemento) {
            $nuevoElemento['idusuario'] = $elemento->getObjUsuario()->getIdusuario();
            $nuevoElemento['usnombre'] = $elemento->getObjUsuario()->getUsnombre();
            $nuevoElemento['idrol'] = $elemento->getObjRol()->getIdrol();
            $nuevoElemento['rodescripcion'] = $elemento->getObjRol()->getRodescripcion();
            array_push($arregloSalida, $nuevoElemento);
        }
        return $arregloSalida;
    }
}
