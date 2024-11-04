<?php

class AbmUsuario
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idusuario', $param) and array_key_exists('usnombre', $param) and array_key_exists('uspass', $param) and array_key_exists('usmail', $param) and array_key_exists('usdeshabilitado', $param)) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], $param['usnombre'], $param['uspass'], $param['usmail'], $param["usdeshabilitado"]);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], null, null, null, null);
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
        if (isset($param['idusuario'])) {
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
        $param['idusuario'] = null;
        $param['uspass'] = md5($param['uspass']);
        $objUsuario = $this->cargarObjeto($param);
        if ($objUsuario != null and $objUsuario->insertar()) {
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
            $objUsuario = $this->cargarObjetoConClave($param);
            if ($objUsuario != null and $objUsuario->cambiarEstado()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite modificar un objeto.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuario = $this->cargarObjeto($param);
            if ($objUsuario != null and $objUsuario->modificar()) {
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
            if (isset($param['usnombre'])) {
                $where .= " and usnombre ='" . $param['usnombre'] . "'";
            }
            if (isset($param['uspass'])) {
                $where .= " and uspass ='" . $param['uspass'] . "'";
            }
            if (isset($param['usmail'])) {
                $where .= " and usmail ='" . $param['usmail'] . "'";
            }
            if (isset($param['usdeshabilitado'])) {
                $where .= " and usdeshabilitado ='" . $param['usdeshabilitado'] . "'";
            }
        }
        $objUsuario = new Usuario();
        $arreglo = $objUsuario->listar($where);
        return $arreglo;
    }

    public function registrarse($param)
    {
        $usuarioExiste = $this->buscar(['usnombre' => $param['usnombre']]);
        if ($usuarioExiste == []) {
            $param['usdeshabilitado'] = NULL;
            if ($this->alta($param)) {
                $param['idusuario'] = ($this->buscar(['usnombre' => $param['usnombre']]))[0]->getIdusuario();
                $param['idrol'] = 3;
                $thisRol = new AbmUsuarioRol();
                if ($thisRol->alta($param)) {
                    $direccion = 'Location:../paginas/login.php?error=Acaba de registrarse, debe iniciar sesion.';
                } else {
                    $direccion = 'Location:../paginas/registrarse.php';
                }
            }
        } else {
            $direccion = 'Location:../paginas/login.php?error=Nombre de usuario existente, inicie sesión.';
        }
        return $direccion;
    }

    public function editarUsuarioActual($param)
    {
        $arreglo["idusuario"] = $param["idusuario"];
        $listaUsuarios = $this->buscar($arreglo);
        $param["usdeshabilitado"] = $listaUsuarios[0]->getUsdeshabilitado();
        if ($param["uspass"] != $listaUsuarios[0]->getUspass()) {
            $param["uspass"] = md5($param["uspass"]);
        }
        if ($this->modificacion($param)) {
            $respuesta["respuesta"] = "Se modificó el usuario correctamente";
        } else {
            $respuesta["errorMsg"] = "No se pudo modificar el usuario";
        }
        return $respuesta;
    }

    public function listarCompraEstadoCliente()
    {
        $sesionActual = new Session();
        $usuario = $this->buscar(['usnombre' => $sesionActual->getUsuario()->getUsnombre(), 'uspass' => $sesionActual->getUsuario()->getUspass()]);
        $idUsuario = $usuario[0]->getIdusuario();
        $objAbmCompraEstado = new AbmCompraEstado();
        $listaCompraEstado = $objAbmCompraEstado->buscar(null);
        $arreglo = array();
        $arregloSalida = array();
        foreach ($listaCompraEstado as $elemento) {
            if ($elemento->getObjCompra()->getObjUsuario()->getIdusuario() == $idUsuario) {
                $nuevoElemento['idcompraestado'] = $elemento->getIdcompraestado();
                $nuevoElemento['idcompra'] = $elemento->getObjCompra()->getIdcompra();
                $nuevoElemento['idcompraestadotipo'] = $elemento->getObjCompraEstadoTipo()->getIdcompraestadotipo();
                $nuevoElemento['cetdescripcion'] = $elemento->getObjCompraEstadoTipo()->getCetdescripcion();
                $nuevoElemento['cefechaini'] = $elemento->getCefechaini();
                $nuevoElemento['cefechafin'] = $elemento->getCefechafin();
                $nuevoElemento['usnombre'] = $elemento->getObjCompra()->getObjUsuario()->getUsnombre();
                array_push($arregloSalida, $nuevoElemento);
            }
        }
        return $arregloSalida;
    }

    public function listarUsuarioActual()
    {
        $sesionActual = new Session();
        $usuarioActual = $this->buscar(['usnombre' => $sesionActual->getUsuario()->getUsnombre(), 'uspass' => $sesionActual->getUsuario()->getUspass()]);
        $arregloSalida = array();
        $arregloSalida2['idusuario'] = $usuarioActual[0]->getIdusuario();
        $arregloSalida2['usnombre'] = $usuarioActual[0]->getUsnombre();
        $arregloSalida2['uspass'] = $usuarioActual[0]->getUspass();
        $arregloSalida2['usmail'] = $usuarioActual[0]->getUsmail();
        array_push($arregloSalida, $arregloSalida2);
        return $arregloSalida;
    }

    public function crearUsuario($param)
    {
        $param["usdeshabilitado"] = null;
        if ($this->alta($param)) {
            $respuesta["respuesta"] = "Se dio de alta el usuario correctamente";
        } else {
            $respuesta["errorMsg"] = "No se pudo realizar el alta";
        }
        return $respuesta;
    }

    public function editarUsuarios($param)
    {
        $arreglo["idusuario"] = $param["idusuario"];
        $listaUsuarios = $this->buscar($arreglo);
        $param["usdeshabilitado"] = $listaUsuarios[0]->getUsdeshabilitado();
        if ($param["uspass"] != $listaUsuarios[0]->getUspass()) {
            $param["uspass"] = md5($param["uspass"]);
        }
        if ($this->modificacion($param)) {
            $respuesta["respuesta"] = "Se modificó el usuario correctamente!";
        } else {
            $respuesta["errorMsg"] = "No se pudo realizar la modificacion";
        }
        return $respuesta;
    }

    public function listarUsuarios()
    {
        $listaUsuarios = $this->buscar(null);
        $arregloSalida = array();
        foreach ($listaUsuarios as $elemento) {
            $nuevoElemento['idusuario'] = $elemento->getIdusuario();
            $nuevoElemento['usnombre'] = $elemento->getUsnombre();
            $nuevoElemento['uspass'] = $elemento->getUspass();
            $nuevoElemento['usmail'] = $elemento->getUsmail();
            if ($elemento->getUsdeshabilitado() == null || $elemento->getUsdeshabilitado() == "0000-00-00 00:00:00") {
                $nuevoElemento['usdeshabilitado'] = "Habilitado";
            } else {
                $nuevoElemento['usdeshabilitado'] = "Deshabilitado (" . $elemento->getUsdeshabilitado() . ")";
            }
            array_push($arregloSalida, $nuevoElemento);
        }
        return $arregloSalida;
    }
}
