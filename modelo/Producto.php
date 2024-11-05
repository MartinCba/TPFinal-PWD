<?php

class Producto
{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $proprecio;
    private $prodeshabilitado;
    private $mensajeoperacion;

    /**
     * Constructor de la clase Producto.
     * Inicializa los atributos de la clase.
     */
    public function __construct()
    {
        $this->idproducto = null;
        $this->pronombre = null;
        $this->prodetalle = "";
        $this->procantstock = null;
        $this->proprecio = null;
        $this->prodeshabilitado = null;
        $this->mensajeoperacion = "";
    }

    /**
     * Setea los atributos de la clase Producto.
     * @param int $idproductoS
     * @param string $pronombreS
     * @param string $prodetalleS
     * @param int $procantstockS
     * @param float $proprecioS
     * @param string|null $prodeshabilitadoS
     */
    public function setear($idproductoS, $pronombreS, $prodetalleS, $procantstockS, $proprecioS, $prodeshabilitadoS)
    {
        $this->setIdproducto($idproductoS);
        $this->setPronombre($pronombreS);
        $this->setProdetalle($prodetalleS);
        $this->setProcantstock($procantstockS);
        $this->setProPrecio($proprecioS);
        $this->setProdeshabilitado($prodeshabilitadoS);
    }

    public function getIdproducto()
    {
        return $this->idproducto;
    }
    public function setIdproducto($nuevoIdproducto)
    {
        $this->idproducto = $nuevoIdproducto;
    }

    public function getPronombre()
    {
        return $this->pronombre;
    }
    public function setPronombre($nuevoPronombre)
    {
        $this->pronombre = $nuevoPronombre;
    }

    public function getProdetalle()
    {
        return $this->prodetalle;
    }
    public function setProdetalle($nuevoProdetalle)
    {
        $this->prodetalle = $nuevoProdetalle;
    }

    public function getProcantstock()
    {
        return $this->procantstock;
    }
    public function setProcantstock($nuevoProcantstock)
    {
        $this->procantstock = $nuevoProcantstock;
    }

    public function getProPrecio()
    {
        return $this->proprecio;
    }
    public function setProPrecio($nuevoProPrecio)
    {
        $this->proprecio = $nuevoProPrecio;
    }

    public function getProdeshabilitado()
    {
        return $this->prodeshabilitado;
    }
    public function setProdeshabilitado($nuevoProdeshabilitado)
    {
        $this->prodeshabilitado = $nuevoProdeshabilitado;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($nuevomensajeoperacion)
    {
        $this->mensajeoperacion = $nuevomensajeoperacion;
    }

    /**
     * Carga los datos de un producto desde la base de datos.
     * @return boolean
     */
    public function cargar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getIdproducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row["idproducto"], $row["pronombre"], $row["prodetalle"], $row["procantstock"], $row["proprecio"], $row["prodeshabilitado"]);
                    $respuesta = true;
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: " . $base->getError());
        }
        return $respuesta;
    }

    /**
     * Inserta un nuevo producto en la base de datos.
     * @return boolean
     */
    public function insertar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        if ($this->getProdeshabilitado() == null) {
            $proDeshabilitado = ", NULL)";
        } else {
            $proDeshabilitado = ", '" . $this->getProdeshabilitado() . "')";
        }
        $sql = "INSERT INTO producto (pronombre, prodetalle, procantstock, proprecio, prodeshabilitado) 
            VALUES ('" . $this->getPronombre() .
            "','" . $this->getProdetalle() .
            "'," . $this->getProcantstock() .
            ", " . $this->getProPrecio() .
            $proDeshabilitado;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdproducto($elid);
                $respuesta = true;
            } else {
                $this->setmensajeoperacion("Producto->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->insertar: " . $base->getError());
        }
        return $respuesta;
    }

    /**
     * Modifica un producto existente en la base de datos.
     * @return boolean
     */
    public function modificar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        if ($this->getProdeshabilitado() == null) {
            $proDeshabilitado = ", prodeshabilitado = NULL";
        } else {
            $proDeshabilitado = ", prodeshabilitado = '" . $this->getProdeshabilitado() . "'";
        }
        $sql = "UPDATE producto 
            SET pronombre = '" . $this->getPronombre() .
            "', prodetalle = '" . $this->getProdetalle() .
            "', procantstock = " . $this->getProcantstock() .
            ", proprecio = " . $this->getProPrecio() .
            $proDeshabilitado .
            " WHERE idproducto = " . $this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $respuesta = true;
            } else {
                $this->setmensajeoperacion("Producto->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar: " . $base->getError());
        }
        return $respuesta;
    }

    /**
     * Elimina un producto de la base de datos.
     * @return boolean
     */
    public function eliminar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto = " . $this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $respuesta = true;
            } else {
                $this->setmensajeoperacion("Producto->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->eliminar: " . $base->getError());
        }
        return $respuesta;
    }

    /**
     * Cambia el estado de habilitación de un producto.
     * @return boolean
     */
    public function cambiarEstado()
    {
        $respuesta = false;
        $this->cargar();
        //date_default_timezone_set('America/Argentina/Cordoba');
        if ($this->getProdeshabilitado() == null) {
            $fechaBaja = date('Y-m-d H:i:s');
            $this->setProdeshabilitado($fechaBaja);
        } else {
            $this->setProdeshabilitado(null);
        }
        if ($this->modificar()) {
            $respuesta = true;
        }
        return $respuesta;
    }

    /**
     * Lista los productos de la base de datos que cumplen con el parámetro dado.
     * @param string $parametro
     * @return array
     */
    public function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
        if ($parametro != "") {
            $sql .= "WHERE " . $parametro;
        }
        $respuesta = $base->Ejecutar($sql);
        if ($respuesta > -1) {
            if ($respuesta > 0) {
                while ($row = $base->Registro()) {
                    $obj = new Producto();
                    $obj->setear($row["idproducto"], $row["pronombre"], $row["prodetalle"], $row["procantstock"], $row["proprecio"], $row["prodeshabilitado"]);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
