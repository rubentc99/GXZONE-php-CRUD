<?php

/**
 * Class Bd clase base de datos en la que van a pasar todas las funciones con las consultas a la base de datos
 */
class Bd
{
    private $server = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $basedatos = "gxzone";

    private $conexion;
    private $resultado;

    /**
     * Recoge el servidor, usuario, contraseña y el nombre de la base de datos
     * Bd constructor.
     */

    public function __construct(){

        $this->conexion = new mysqli($this->server, $this->usuario, $this->pass , $this->basedatos);
        $this->conexion->select_db($this->basedatos);
        $this->conexion->query("SET NAMES 'utf8'");


    }

    /**
     * Esta funcion sirve para insetar un elemento
     * @param $tabla
     * recoge la tabla en la que vamos a insertar el elemento
     * @param $datos
     * recoge los datos
     * @param $carpeta
     * recoge la carpeta
     * @param $foto
     * recoge la foto que vamos a introducir
     * @return bool|mysqli_result
     */
    public function insertarElemento($tabla, $datos, $carpeta, $foto){


        $claves = array();
        $valores = array();

        foreach ($datos as $clave => $valor){
            $claves[] = $clave;
            $valores[] = "'".$valor."'";
        }

        if($foto['name'] != ""){
            $ruta = subirFoto($foto, $carpeta);
            $claves[] = "foto";
            $valores[] = "'".$ruta."'";
        }

        $sql = "INSERT INTO ".$tabla." (".implode(',',$claves).") VALUES (".implode(',',$valores).")";
        //implode -> array [a],[b],[c],[d] -> implode("-", array) -> string -> a-b-c-d
        //echo $sql;
        $this->resultado = $this->conexion->query($sql);
        $res = $this->resultado;
        return $res;
    }

    /**
     * Esta funcion sirve para actualizar un elemento en el programa y en la bd
     * @param $id
     * recoge el id del elemento que estamos editando
     * @param $tabla
     * recoge la tabla en la que estamos haciendo la edicion
     * @param $datos
     * recoge los datos
     * @param string $foto
     * recoge la foto que estemos editando
     * @param string $directorio
     * recoge el directorio
     */
    public function uppdateBD($id, $tabla, $datos, $foto="", $directorio=""){

        $sentencias = array();

        foreach ($datos as $campo => $valor){
            if($campo != "id" && $campo != "x" && $campo != "y"){
                $sentencias[] = $campo . "='".addslashes($valor)."'";
            }
        }


        if(strlen($foto['name'])>0){
            $this->borrarFoto($id, $tabla, 'foto', 'fotos');
            $ruta= subirFoto($foto, $directorio);
            $sentencias[] = "foto='".$ruta."'";
        }

        $campos = implode(",", $sentencias);
        //implode -> array [a],[b],[c],[d] -> implode("-", array) -> string -> a-b-c-d
        $sql = "UPDATE " . $tabla . " SET " . $campos . " WHERE id=" . $id;
        //echo $sql;
        $conexion = new Bd();
        $conexion->consulta($sql);
    }
    /**
     * Esta funcion sirve para eliminar un elemento
     * @param $id
     * recoge el id del elemento que queramos borrar
     * @param $tabla
     * recoge la tabla en la que este elemento que vayamos a borrar
     * @param $campo
     * recoge todos los atributos del elemento
     * @param $carpeta
     * recoge la carpeta
     */
    public function borrarFoto($id, $tabla, $campo, $carpeta){

        $sql = "SELECT " . $campo . " FROM " . $tabla . " WHERE id = '" . $id . "'";
        $this->resultado = $this->conexion->query($sql);
        //echo $sql;
        if($this->numeroElementos()>0) {
            $res = mysqli_fetch_assoc($this->resultado);

            $rutaAborrar = $carpeta."/".$res['foto'];
            if(!unlink($rutaAborrar)){
                lanzarError("Error de escritura en el servidor, contacte con su administrador en el mail ......");
            }
        }
    }

    // implode -> array [a][b][c][d] -> implode(",",array) -> String -> a,b,c,d...

    /**
     * Esta funcion sirve para ver todos los datos del elemento
     * @param $consulta
     * @return bool|mysqli_result
     */
    public function consulta($consulta){
        //echo $consulta;
        $this->resultado =   $this->conexion->query($consulta);
        $res = $this->resultado ;
        return $res;
    }
    /**
     * Esta funcion controla que el numero de los parametros que se envian sean los mismos en la bd
     * @param $sql
     * @return mixed
     */
    public function numeroElementosConSql($sql){

        $this->resultado = $this->conexion->query($sql);
        $num = $this->numeroElementos();
        return $num;
    }
    /**
     * Esta funcion controla que el numero de los parametros que se envian sean los mismos
     * @return mixed
     */
    public function numeroElementos(){

        $num = $this->resultado->num_rows;

        return $num;
    }



}