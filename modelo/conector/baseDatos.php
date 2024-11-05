<?php
class BaseDatos extends PDO
{
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    private $debug;
    private $conec;
    private $indice;
    private $resultado;
    private $error;
    private $sql;

    /**
     * Constructor de la clase BaseDatos.
     * Inicializa los parámetros de conexión y establece la conexión con la base de datos.
     */
    public function __construct()
    {
        $this->engine = "mysql";
        $this->host = "localhost";
        $this->database = "bdcarritocompras";
        $this->user = "root";
        $this->pass = "";
        $this->debug = true;
        $this->error = "";
        $this->sql = "";
        $this->indice = 0;

        $dns = $this->engine . ":dbname=" . $this->database . ";host=" . $this->host;
        try {
            parent::__construct($dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->conec = true;
        } catch (PDOException $e) {
            $this->sql = $e->getMessage();
            $this->conec = false;
        }
    }

    /**
     * Inicia la conexión con el Servidor y la Base Datos Mysql.
     * Retorna true si la conexión con el servidor se pudo establecer y false en caso contrario.
     * @return boolean
     */
    public function Iniciar()
    {
        return $this->getConec();
    }

    public function getConec()
    {
        return $this->conec;
    }

    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * Función que setea la variable instancia error.
     * @param string $e Descripción del error.
     */
    public function setError($e)
    {
        $this->error = $e;
    }

    /**
     * Función que retorna una cadena con descripción del último error seteado.
     * @return string
     */
    public function getError()
    {
        return "\n" . $this->error;
    }

    /**
     * Función que setea la variable instancia sql.
     * @param string $e Consulta SQL.
     */
    public function setSQL($e)
    {
        return "\n" . $this->sql = $e;
    }

    /**
     * Función que retorna una cadena con el último SQL seteado.
     * @return string
     */
    public function getSQL()
    {
        return "\n" . $this->sql;
    }

    /**
     * Ejecuta una consulta SQL.
     * @param string $sql Consulta SQL a ejecutar.
     * @return mixed
     */
    public function Ejecutar($sql)
    {
        $this->setError("");
        $this->setSQL($sql);
        if (stristr($sql, "INSERT")) {
            // Se desea INSERT.
            $resp = $this->EjecutarInsert($sql);
        }
        // Se desea UPDATE o DELETE.
        if (stristr($sql, "UPDATE") or stristr($sql, "DELETE")) {
            $resp = $this->EjecutarDeleteUpdate($sql);
        }
        // Se desea ejecutar un SELECT.
        if (stristr($sql, "SELECT")) {
            $resp = $this->EjecutarSelect($sql);
        }
        return $resp;
    }

    /**
     * Si se inserta en una tabla que tiene una columna autoincrement, se retorna el id con el que se insertó el registro.
     * Caso contrario, se retorna -1.
     * @param string $sql Consulta SQL de inserción.
     * @return int
     */
    private function EjecutarInsert($sql)
    {
        $resultado = parent::query($sql);
        if (!$resultado) {
            $this->analizarDebug();
            $id = 0;
        } else {
            $id = $this->lastInsertId();
            if ($id == 0) {
                $id = -1;
            }
        }
        return $id;
    }

    /**
     * Devuelve la cantidad de filas afectadas por la ejecución SQL. Si el valor es <0 no se pudo realizar la operación.
     * @param string $sql Consulta SQL de actualización o eliminación.
     * @return int
     */
    private function EjecutarDeleteUpdate($sql)
    {
        $cantFilas = -1;
        $resultado = parent::query($sql);
        if (!$resultado) {
            $this->analizarDebug();
        } else {
            $cantFilas = $resultado->rowCount();
        }
        return $cantFilas;
    }

    /**
     * Retorna cada uno de los registros de una consulta select.
     * @param string $sql Consulta SQL de selección.
     * @return int
     */
    private function EjecutarSelect($sql)
    {
        $cant = -1;
        $resultado = parent::query($sql);
        if (!$resultado) {
            $this->analizarDebug();
        } else {
            $arregloResult = $resultado->fetchAll();
            $cant = count($arregloResult);
            $this->setIndice(0);
            $this->setResultado($arregloResult);
        }
        return $cant;
    }

    /**
     * Devuelve un registro retornado por la ejecución de una consulta.
     * El puntero se desplaza al siguiente registro de la consulta.
     * @return array|false
     */
    public function Registro()
    {
        $filaActual = false;
        $indiceActual = $this->getIndice();
        if ($indiceActual >= 0) {
            $filas = $this->getResultado();
            if ($indiceActual < count($filas)) {
                $filaActual = $filas[$indiceActual];
                $indiceActual++;
                $this->setIndice($indiceActual);
            } else {
                $this->setIndice(-1);
            }
        }
        return $filaActual;
    }

    /**
     * Esta función, si está seteada la variable instancia $this->debug, visualiza el debug.
     */
    private function analizarDebug()
    {
        $e = $this->errorInfo();
        $this->setError($e);
        if ($this->getDebug()) {
            echo "<pre>";
            print_r($e);
            echo "</pre>";
        }
    }

    private function setIndice($valor)
    {
        $this->indice = $valor;
    }

    private function getIndice()
    {
        return $this->indice;
    }

    private function setResultado($valor)
    {
        $this->resultado = $valor;
    }

    private function getResultado()
    {
        return $this->resultado;
    }
}
