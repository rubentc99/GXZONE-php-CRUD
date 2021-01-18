<?php
/**
 * Class Permiso clase permiso, que va a contener todos los atributos del permiso
 */

class Permiso
{
    private $id;
    private $permiso;


    private $tabla;


    /**
     * Permiso constructor.
     * @param $id ;
     * recoge el id del permiso
     * @param $permiso;
     * recoge el tipo de permiso

     */
    public function __construct($id = "", $permiso = "")
    {
        $this->id = $id;
        $this->permiso = $permiso;

        $this->tabla = "permiso";

    }

    /**
     * Funcion que sirve para rellenar todos los datos
     * @param $id
     * id permiso
     * @param $permiso
     * tipo de permiso
     */
    private function llenar($id, $permiso)
    {
        $this->id = $id;
        $this->permiso = $permiso;


    }

    /**
     * Metodo para obtener el id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Metodo para asignar el id
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Metodo para obtener el permiso
     * @return string
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Metodo para asignar el permiso
     * @param string $permiso
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;
    }

    /**
     * metodo que sirve para insertar el permiso
     * @param $datos
     * recoge los datos del permiso
     * @param $foto
     * recoge la foto del permiso
     */
    public function insertar($datos,$foto){
        $conexion = new Bd();
        $conexion->insertarElemento($this->tabla,$datos,$this->carpetaFotos,$foto);

    }
    /**
     * metodo que sirve para actualizar el permiso
     * @param $id
     * recoge el id del permiso
     * @param $datos
     * recoge los datos del permiso
     * @param $foto
     * recoge la foto del permiso
     */
    public function update($id, $datos, $foto){

        $conexion = new Bd();
        $conexion->uppdateBD($id, $this->tabla, $datos, $foto, $this->carpetaFotos);


    }


    /**
     * Metodo que sirve para obtener los datos del permiso por el id
     * Version larga
     * @param $id
     * recoge el id del permiso
     */
    public function obtenerPorId($id){

        $sql = "SELECT * FROM ".$this->tabla." WHERE id=".$id;

        $conexion= new Bd();
        $res = $conexion->consulta($sql);

        list($permiso, $id) = mysqli_fetch_array($res);

        $this->llenar($permiso, $id);

    }

    /**
     * Esta funcion sirve para mostrar todos los atributos del permiso cuando el usuario pulse la opcion de ver
     * @return string
     */



    public function imprimirEnFicha(){
        $html= "<table border='2'>";
        $html .= "<tr><td style='border: 2px solid red'>Referencia</td>
                        <td>Permiso</td>
                        
                        </tr>";

        $html .= "  <tr><td>".$this->getId()."</td>
                        <td>".$this->getPermiso()."</td>
                        
                        </tr>";

        $html .= "</table>";
        return $html;



    }



}