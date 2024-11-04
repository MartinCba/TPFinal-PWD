<?php

class AbmRol
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idrol', $param) and array_key_exists('rodescripcion', $param)) {
            $obj = new Rol();
            $obj->setear($param['idrol'], $param['rodescripcion']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idrol'])) {
            $obj = new Rol();
            $obj->setear($param['idrol'], null);
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
        if (isset($param['idrol'])) {
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
        $param['idrol'] = null;
        $objRol = $this->cargarObjeto($param);
        if ($objRol != null and $objRol->insertar()) {
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
            $objRol = $this->cargarObjetoConClave($param);
            if ($objRol != null and $objRol->eliminar()) {
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
            $objRol = $this->cargarObjeto($param);
            if ($objRol != null and $objRol->modificar()) {
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
            if (isset($param['idrol'])) {
                $where .= " and idrol =" . $param['idrol'];
            }
            if (isset($param['rodescripcion'])) {
                $where .= " and rodescripcion ='" . $param['rodescripcion'] . "'";
            }
        }
        $objRol = new Rol();
        $arreglo = $objRol->listar($where) ?: [];
        return $arreglo;
    }

    public function eliminarRol($param)
    {
        $objAbmUsuarioRol = new AbmUsuarioRol();
        $objAbmMenuRol = new AbmMenuRol();
        if ($objAbmUsuarioRol->buscar($param) || $objAbmMenuRol->buscar($param)) {
            $respuesta["errorMsg"] = "No se pudo dar de baja el rol debido a que existe un UsuarioRol o un MenuRol con ese id.";
        } else {
            if ($this->baja($param)) {
                $respuesta["respuesta"] = "Se dio de baja el Rol correctamente!";
            } else {
                $respuesta["errorMsg"] = "No se pudo dar de baja el Rol";
            }
        }
        return $respuesta;
    }

    public function listarRoles()
    {
        $listaRoles = $this->buscar(null);
        $arregloSalida = array();
        foreach ($listaRoles as $elemento) {
            $nuevoElemento['idrol'] = $elemento->getIdrol();
            $nuevoElemento['rodescripcion'] = $elemento->getRodescripcion();
            array_push($arregloSalida, $nuevoElemento);
        }
        return $arregloSalida;
    }
}
