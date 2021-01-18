<?php


class Contacto
{

    private $id;
    private $nombre;
    private $mail;
    private $mensaje;
    private $carpetaFotos;
    private $tabla;


    /**
     * Contacto constructor.
     * @param $id;
     * @param $nombre;
     * @param $mail;
     * @param $mensaje;
     * @param $tabla;
     * @param $carpetaFotos;
     */
    public function __construct($id = "", $nombre = "", $mail = "", $mensaje = "")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->mensaje = $mensaje;
        $this->tabla = "contacto";
        $this->carpetaFotos = "fotos/";
    }

    private function llenar($id, $nombre, $mail, $mensaje)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->mensaje = $mensaje;

    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param string $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }



    public function insertar($datos,$foto){
        $conexion = new Bd();
        $conexion->insertarElemento($this->tabla,$datos,$this->carpetaFotos,$foto);

    }




    public function borrarContacto($id){

        $conexion= new Bd();

        $sql = "DELETE FROM ".$this->tabla ." WHERE id=".$id;
        //echo $sql;
        $conexion->consulta($sql);


    }



    /**
     * Version larga
     * @param $id
     */
    public function obtenerPorId($id){

        $sql = "SELECT * FROM ".$this->tabla." WHERE id=".$id;

        $conexion= new Bd();
        $res = $conexion->consulta($sql);

        list($nombre, $mail, $mensaje, $id) = mysqli_fetch_array($res);

        $this->llenar($nombre, $mail, $mensaje, $id);

    }


    /**
     * Método que retorna una fila para la insercion en una tabla de la clase lista.
     * @return string
     */
    public function imprimeteEnTr(){

        $html =        "<tr><td>".$this->getNombre()."</td>
                        <td>".$this->getMail()."</td>
                        <td>".$this->getMensaje()."</td>
                        <td><a href='javascript:borrarContacto(".$this->id.")'>Borrar</a></td>
                        </tr>";
        return $html;

    }



}