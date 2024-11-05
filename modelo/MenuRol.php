<?php

class MenuRol
{
    private $objMenu;
    private $objRol;
    private $mensajeoperacion;

    /**
     * Constructor de la clase MenuRol.
     * Inicializa los atributos de la clase.
     */
    public function __construct()
    {
        $this->objMenu = new Menu();
        $this->objRol = new Rol();
        $this->mensajeoperacion = "";
    }

    /**
     * Setea los atributos de la clase MenuRol.
     * @param Menu $objMenuS
     * @param Rol $objRolS
     */
    public function setear($objMenuS, $objRolS)
    {
        $this->setObjMenu($objMenuS);
        $this->setObjRol($objRolS);
    }

    public function getObjMenu()
    {
        return $this->objMenu;
    }
    public function setObjMenu($nuevoObjMenu)
    {
        $this->objMenu = $nuevoObjMenu;
    }

    public function getObjRol()
    {
        return $this->objRol;
    }
    public function setObjRol($nuevoObjRol)
    {
        $this->objRol = $nuevoObjRol;
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
     * Carga los datos de un menú-rol desde la base de datos.
     * @return boolean
     */
    public function cargar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM menurol WHERE idmenu = " . $this->getObjMenu()->getIdmenu() . " AND idrol = " . $this->getObjRol()->getIdrol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $objMenuS = new Menu();
                    $objMenuS->setIdmenu($row["idmenu"]);
                    $objMenuS->cargar();
                    $objRolS = new Rol();
                    $objRolS->setIdrol($row["idrol"]);
                    $objRolS->cargar();
                    $this->setear($objMenuS, $objRolS);
                    $respuesta = true;
                }
            }
        } else {
            $this->setmensajeoperacion("MenuRol->listar: " . $base->getError());
        }
        return $respuesta;
    }

    /**
     * Inserta un nuevo menú-rol en la base de datos.
     * @return boolean
     */
    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO menurol (idmenu, idrol)
                VALUES (" . $this->getObjMenu()->getIdmenu() .
            "," . $this->getObjRol()->getIdrol() . ")";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("MenuRol->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuRol->insertar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * Elimina un menú-rol de la base de datos.
     * @return boolean
     */
    public function eliminar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menurol WHERE idmenu = " . $this->getObjMenu()->getIdmenu() . " AND idrol = " . $this->getObjRol()->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $respuesta = true;
            } else {
                $this->setmensajeoperacion("MenuRol->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuRol->eliminar: " . $base->getError());
        }
        return $respuesta;
    }

    /**
     * Lista los menú-rol de la base de datos que cumplen con el parámetro dado.
     * @param string $parametro
     * @return array
     */
    public function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menurol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new MenuRol();
                    $objMenuS = new Menu();
                    $objMenuS->setIdmenu($row["idmenu"]);
                    $objMenuS->cargar();
                    $objRolS = new Rol();
                    $objRolS->setIdrol($row["idrol"]);
                    $objRolS->cargar();
                    $obj->setear($objMenuS, $objRolS);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("MenuRol->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
