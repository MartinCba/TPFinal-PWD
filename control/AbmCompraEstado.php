<?php

class AbmCompraEstado
{
    /**
     * Espera como parámetro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idcompraestado', $param) and array_key_exists('idcompra', $param) and array_key_exists('idcompraestadotipo', $param) and array_key_exists('cefechaini', $param) and array_key_exists('cefechafin', $param)) {
            $obj = new CompraEstado();
            $objCompra = new Compra();
            $objCompra->setIdcompra($param["idcompra"]);
            $objCompra->cargar();
            $objCompraEstadoTipo = new CompraEstadoTipo();
            $objCompraEstadoTipo->setIdcompraestadotipo($param["idcompraestadotipo"]);
            $objCompraEstadoTipo->cargar();
            $obj->setear($param['idcompraestado'], $objCompra, $objCompraEstadoTipo, $param["cefechaini"], $param["cefechafin"]);
        }
        return $obj;
    }

    /**
     * Espera como parámetro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraestado'])) {
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'], null, null, null, null);
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
        if (isset($param['idcompraestado'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Permite crear un objeto.
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        $param['idcompraestado'] = null;
        $objCompraEstado = $this->cargarObjeto($param);
        if ($objCompraEstado != null and $objCompraEstado->insertar()) {
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
            $objCompraEstado = $this->cargarObjetoConClave($param);
            if ($objCompraEstado != null and $objCompraEstado->eliminar()) {
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
            $objCompraEstado = $this->cargarObjeto($param);
            if ($objCompraEstado != null and $objCompraEstado->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite buscar un objeto.
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> null) {
            if (isset($param['idcompraestado'])) {
                $where .= " and idcompraestado =" . $param['idcompraestado'];
            }
            if (isset($param['idcompra'])) {
                $where .= " and idcompra =" . $param['idcompra'];
            }
            if (isset($param['idcompraestadotipo'])) {
                $where .= " and idcompraestadotipo =" . $param['idcompraestadotipo'];
            }
            if (isset($param['cefechaini'])) {
                $where .= " and cefechaini ='" . $param['cefechaini'] . "'";
            }
            if (isset($param['cefechafin'])) {
                $where .= " and cefechafin =" . $param['cefechafin'];
            }
        }
        $objCompraEstado = new CompraEstado();
        $arreglo = $objCompraEstado->listar($where);
        return $arreglo;
    }

    /**
     * Cancela una compra del cliente.
     * @param array $param
     * @return array
     */
    public function cancelarCompraCliente($param)
    {
        $arreglo["idcompra"] = $param["idcompra"];
        $listaCompraEstadoConId = $this->buscar($arreglo);
        $compraCancelada = false;
        $i = 0;
        while (!$compraCancelada && $i < count($listaCompraEstadoConId)) {
            if ($listaCompraEstadoConId[$i]->getObjCompraEstadoTipo()->getIdcompraestadotipo() == 4) {
                $compraCancelada = true;
            } else {
                $i++;
            }
        }
        $arregloCompraEstado = $this->buscar(null);
        $compraAvanzada2 = false;
        $i = 0;
        while ((!$compraAvanzada2) && ($i < count($arregloCompraEstado))) {
            if (
                $arregloCompraEstado[$i]->getObjCompraEstadoTipo()->getIdcompraestadotipo() > $param["idcompraestadotipo"]
                && $arregloCompraEstado[$i]->getObjCompra()->getIdcompra() == $param["idcompra"]
            ) {
                $compraAvanzada2 = true;
            } else {
                $i++;
            }
        }

        if ($param["idcompraestadotipo"] == 1) {
            if (!$compraCancelada) {
                if (!$compraAvanzada2) {
                    $fechaActual = date('Y-m-d H:i:s');
                    $param["cefechafin"] = $fechaActual;
                    if ($this->modificacion($param)) {
                        $param["idcompraestado"] = null;
                        $param["idcompraestadotipo"] = 4;
                        $param["cefechaini"] = $fechaActual;
                        $param["cefechafin"] = $fechaActual;
                        if ($this->alta($param)) {
                            $objAbmCompraItem = new AbmCompraItem();
                            $listaCompraItem = $objAbmCompraItem->buscar($arreglo);
                            if ($listaCompraItem) {
                                foreach ($listaCompraItem as $compraItem) {
                                    $cantidadItems = $compraItem->getCicantidad();
                                    $objProducto = $compraItem->getObjProducto();
                                    $nuevoStock = $cantidadItems + $objProducto->getProcantstock();
                                    $objAbmProducto = new AbmProducto();
                                    $arregloParaModificar["idproducto"] = $objProducto->getIdproducto();
                                    $arregloParaModificar["pronombre"] = $objProducto->getPronombre();
                                    $arregloParaModificar["prodetalle"] = $objProducto->getProdetalle();
                                    $arregloParaModificar["procantstock"] = $nuevoStock;
                                    $arregloParaModificar["proprecio"] = $objProducto->getProprecio();
                                    $arregloParaModificar["prodeshabilitado"] = $objProducto->getProdeshabilitado();
                                    if ($objAbmProducto->modificacion($arregloParaModificar)) {
                                        $respuesta["respuesta"] = "Se canceló la compra y se actualizó el stock correctamente";
                                    } else {
                                        $respuesta["errorMsg"] = "No se pudo actualizar el stock";
                                    }
                                }
                            }
                        } else {
                            $respuesta["errorMsg"] = "No se pudo cancelar la compra";
                        }
                    } else {
                        $respuesta["errorMsg"] = "No se pudo cancelar la compra";
                    }
                } else {
                    $respuesta["errorMsg"] = "La compra ya está avanzada";
                }
            } else {
                $respuesta["errorMsg"] = "La compra ya está cancelada";
            }
        } else {
            $respuesta["errorMsg"] = "Solo se puede cancelar la compra si estuviera en estado 'iniciada'";
        }
        return $respuesta;
    }

    public function cambiarEstado($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraEstado = $this->cargarObjeto($param);
            if ($objCompraEstado != null) {
                // Instanciar el objeto CompraEstadoTipo
                $objCompraEstadoTipo = new CompraEstadoTipo();
                $objCompraEstadoTipo->setIdcompraestadotipo($param['idcompraestadotipo']);
                $objCompraEstadoTipo->cargar();

                // Asignar el objeto CompraEstadoTipo al objeto CompraEstado
                $objCompraEstado->setObjCompraEstadoTipo($objCompraEstadoTipo);
                $objCompraEstado->setCefechaini($param['cefechaini']);
                $objCompraEstado->setCefechafin($param['cefechafin']);
                if ($objCompraEstado->modificar()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }

    /**
     * Cancela un estado de compra.
     * @param array $param
     * @return array
     */
    public function cancelarCompraEstado($param)
    {
        $arreglo["idcompra"] = $param["idcompra"];

        $listaCompraEstadoConId = $this->buscar($arreglo);
        $compraCancelada = false;
        $i = 0;
        while (!$compraCancelada && $i < count($listaCompraEstadoConId)) {
            if ($listaCompraEstadoConId[$i]->getObjCompraEstadoTipo()->getIdcompraestadotipo() == 4) {
                $compraCancelada = true;
            } else {
                $i++;
            }
        }
        $arregloCompraEstado = $this->buscar(null);
        $compraAvanzada2 = false;
        $i = 0;
        while ((!$compraAvanzada2) && ($i < count($arregloCompraEstado))) {
            if (
                $arregloCompraEstado[$i]->getObjCompraEstadoTipo()->getIdcompraestadotipo() > $param["idcompraestadotipo"]
                && $arregloCompraEstado[$i]->getObjCompra()->getIdcompra() == $param["idcompra"]
            ) {
                $compraAvanzada2 = true;
            } else {
                $i++;
            }
        }

        if ($param["idcompraestadotipo"] <= 3 && $param["idcompraestadotipo"] > 0) {
            if (!$compraCancelada) {
                if (!$compraAvanzada2) {
                    $fechaActual = date('Y-m-d H:i:s');
                    $param["cefechafin"] = $fechaActual;
                    if ($this->modificacion($param)) {
                        $param["idcompraestado"] = null;
                        $param["idcompraestadotipo"] = 4;
                        $param["cefechaini"] = $fechaActual;
                        $param["cefechafin"] = $fechaActual;
                        if ($this->alta($param)) {
                            $objAbmCompraItem = new AbmCompraItem();
                            $listaCompraItem = $objAbmCompraItem->buscar($arreglo);
                            if ($listaCompraItem) {
                                foreach ($listaCompraItem as $compraItem) {
                                    $cantidadItems = $compraItem->getCicantidad();
                                    $objProducto = $compraItem->getObjProducto();
                                    $nuevoStock = $cantidadItems + $objProducto->getProcantstock();
                                    $objAbmProducto = new AbmProducto();
                                    $arregloParaModificar["idproducto"] = $objProducto->getIdproducto();
                                    $arregloParaModificar["pronombre"] = $objProducto->getPronombre();
                                    $arregloParaModificar["prodetalle"] = $objProducto->getProdetalle();
                                    $arregloParaModificar["procantstock"] = $nuevoStock;
                                    $arregloParaModificar["proprecio"] = $objProducto->getProprecio();
                                    $arregloParaModificar["prodeshabilitado"] = $objProducto->getProdeshabilitado();
                                    if ($objAbmProducto->modificacion($arregloParaModificar)) {
                                        $respuesta["respuesta"] = "Se canceló la compra y se actualizó el stock correctamente";
                                    } else {
                                        $respuesta["errorMsg"] = "No se pudo actualizar el stock";
                                    }
                                }
                            } else {
                                $respuesta["respuesta"] = "Se canceló la compra pero no tenía items";
                            }
                        } else {
                            $respuesta["errorMsg"] = "No se pudo cancelar la compra";
                        }
                    } else {
                        $respuesta["errorMsg"] = "No se pudo cancelar la compra";
                    }
                } else {
                    $respuesta["errorMsg"] = "La compra ya está avanzada";
                }
            } else {
                $respuesta["errorMsg"] = "La compra ya está cancelada";
            }
        } else {
            $respuesta["errorMsg"] = "No se puede cancelar la compra al siguiente estado debido a que el estado 'enviada' o 'cancelada' es el último estado";
        }
        return $respuesta;
    }

    /**
     * Lista todos los estados de compra.
     * @return array
     */
    public function listarCompraEstado()
    {
        $listaCompraEstado = $this->buscar(null);
        $arregloSalida = array();
        foreach ($listaCompraEstado as $elemento) {
            $nuevoElemento['idcompraestado'] = $elemento->getIdcompraestado();
            $nuevoElemento['idcompra'] = $elemento->getObjCompra()->getIdcompra();
            $nuevoElemento['idcompraestadotipo'] = $elemento->getObjCompraEstadoTipo()->getIdcompraestadotipo();
            $nuevoElemento['cetdescripcion'] = $elemento->getObjCompraEstadoTipo()->getCetdescripcion();
            $nuevoElemento['cefechaini'] = $elemento->getCefechaini();
            $nuevoElemento['cefechafin'] = $elemento->getCefechafin();
            $nuevoElemento['usnombre'] = $elemento->getObjCompra()->getObjUsuario()->getUsnombre();
            array_push($arregloSalida, $nuevoElemento);
        }
        return $arregloSalida;
    }

    /**
     * Avanza al siguiente estado de compra.
     * @param array $param
     * @return array
     */
    public function siguienteEstadoCompra($param)
    {
        $arreglo["idcompra"] = $param["idcompra"];
        $listaCompraEstadoConId = $this->buscar($arreglo);
        $compraCancelada = false;
        $i = 0;
        while (!$compraCancelada && $i < count($listaCompraEstadoConId)) {
            if ($listaCompraEstadoConId[$i]->getObjCompraEstadoTipo()->getIdcompraestadotipo() == 4) {
                $compraCancelada = true;
            } else {
                $i++;
            }
        }
        $arregloCompraEstado = $this->buscar(null);
        $compraAvanzada2 = false;
        $i = 0;
        while ((!$compraAvanzada2) && ($i < count($arregloCompraEstado))) {
            if (
                $arregloCompraEstado[$i]->getObjCompraEstadoTipo()->getIdcompraestadotipo() > $param["idcompraestadotipo"]
                && $arregloCompraEstado[$i]->getObjCompra()->getIdcompra() == $param["idcompra"]
            ) {
                $compraAvanzada2 = true;
            } else {
                $i++;
            }
        }

        if ($param["idcompraestadotipo"] < 3 && $param["idcompraestadotipo"] > 0) { // verifica que el id de compraestado tipo sea "iniciada" o "aceptada"
            if (!$compraCancelada) { // verifica que la compra no haya sido cancelada
                if (!$compraAvanzada2) { // verifica que la compra no haya sido avanzada
                    // Verificar si la compra tiene productos
                    $objAbmCompraItem = new AbmCompraItem();
                    $compraItems = $objAbmCompraItem->buscar(['idcompra' => $param['idcompra']]);
                    if (count($compraItems) == 0) {
                        // No hay productos en la compra, cambiar el estado a "cancelada"
                        $param['idcompraestadotipo'] = 4; // Suponiendo que 4 es el ID del estado "cancelada"
                        $param['cefechaini'] = date('Y-m-d H:i:s');
                        $param['cefechafin'] = null;
                        $this->cambiarEstado($param);
                        $respuesta["respuesta"] = "La compra ha sido cancelada porque no tiene productos.";
                    } else {
                        $fechaActual = date('Y-m-d H:i:s');
                        $param["cefechafin"] = $fechaActual;
                        if ($this->modificacion($param)) {
                            $param["idcompraestado"] = null;
                            $param["idcompraestadotipo"] = $param["idcompraestadotipo"] + 1;
                            $param["cefechaini"] = $fechaActual;
                            $param["cefechafin"] = null;
                            if ($this->alta($param)) {
                                $respuesta["respuesta"] = "Se cambió el estado de la compra correctamente";
                            } else {
                                $respuesta["errorMsg"] = "No se pudo cambiar el estado de la compra";
                            }
                        } else {
                            $respuesta["errorMsg"] = "No se pudo cambiar el estado de la compra";
                        }
                    }
                } else {
                    $respuesta["errorMsg"] = "La compra ya ha sido avanzada";
                }
            } else {
                $respuesta["errorMsg"] = "La compra ya ha sido cancelada";
            }
        } else {
            $respuesta["errorMsg"] = "No se puede pasar la compra al siguiente estado debido a que el estado 'enviada' o 'cancelada' es el último estado";
        }
        return $respuesta;
    }
}
