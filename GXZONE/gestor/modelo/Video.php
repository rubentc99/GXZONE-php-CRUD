<?php

/**
 * Class Video clase video, que va a contener todos los atributos del video
 */
class Video
{
    private $id;
    private $juego;
    private $descripcion;
    private $foto;

    private $tabla;
    private $carpetaFotos;

    /**
     * Video constructor.
     * @param $id ;
     * recoge el id del video
     * @param $juego ;
     * recoge el juego del video
     * @param $descripcion ;
     * recoge la descripcion del video
     * @param $foto ;
     * recoge la foto del video
     * @param $tabla ;
     * recoge la tabla
     * @param $carpetaFotos ;
     * recoge la carpeta fotos
     */
    public function __construct($id = "", $juego = "", $descripcion = "", $foto = "")
    {
        $this->id = $id;
        $this->juego = $juego;
        $this->descripcion = $descripcion;
        $this->foto = $foto;
        $this->tabla = "video";
        $this->carpetaFotos = "fotos/";
    }

    /**
     * Funcion que sirve para rellenar todos los datos
     * @param $id
     * id del video
     * @param $juego
     * juego del video
     * @param $descripcion
     * descripcion del video
     * @param $foto
     * caratula del video
     */
    private function llenar($id, $juego, $descripcion, $foto)
    {
        $this->id = $id;
        $this->juego = $juego;
        $this->descripcion = $descripcion;
        $this->foto = $foto;

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
     * Metodo para obtener el juego
     * @return string
     */
    public function getJuego()
    {
        return $this->juego;
    }

    /**
     * Metodo para asignar el juego
     * @param string $juego
     */
    public function setJuego($juego)
    {
        $this->juego = $juego;
    }

    /**
     * Metodo para obtener la descripcion
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Metodo para asignar la descripcion
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Metodo para obtener la foto
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Metodo para asignar la foto
     * @param string $foto
     */
    public function Foto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * Metodo para obtener la carpeta fotos
     * @return string
     */
    public function getCarpetaFotos()
    {
        return $this->carpetaFotos;
    }

    /**
     * Metodo para asignar la carpeta fotos
     * @param string $carpetaFotos
     */
    public function setCarpetaFotos($carpetaFotos)
    {
        $this->carpetaFotos = $carpetaFotos;
    }
    /**
     * metodo que sirve para insertar un video
     * @param $datos
     * recoge los datos del video
     * @param $foto
     * recoge la foto del video
     */
    public function insertar($datos,$foto){
        $conexion = new Bd();
        $conexion->insertarElemento($this->tabla,$datos,$this->carpetaFotos,$foto);

    }
    /**
     * metodo que sirve para actualizar el video
     * @param $id
     * recoge el id del video
     * @param $datos
     * recoge los datos del video
     * @param $foto
     * recoge la caratula del video
     */
    public function update($id, $datos, $foto){

        $conexion = new Bd();
        $conexion->uppdateBD($id, $this->tabla, $datos, $foto, $this->carpetaFotos);


    }

    /**
     * Método que sirve para borrar del video
     * @param $id
     * recoge el id del video
     */
    public function borrarVideo($id){

        $conexion = new Bd();
        $conexion->borrarFoto($id, $this->tabla,"juego, descripcion, foto, id","../".$this->carpetaFotos);
        $sql = "DELETE FROM ".$this->tabla." WHERE id =".$id;
        //echo $sql;
        $conexion->consulta($sql);


    }

    /**
     * Metodo que sirve para obtener los datos del video por el id
     * Version larga
     * @param $id
     * recoge el id del video
     */
    public function obtenerPorId($id){

        $sql = "SELECT * FROM ".$this->tabla." WHERE id=".$id;

        $conexion= new Bd();
        $res = $conexion->consulta($sql);

        list($juego, $descripcion, $foto, $id) = mysqli_fetch_array($res);

        $this->llenar($juego, $descripcion, $foto, $id);

    }

    /**
     * Método que retorna una fila para la insercion en una tabla de la clase lista.
     * @return string
     */
    public function imprimeteEnTr(){
        $html = "<div class='tablaListarVideos'>";
        $html .=     "<tr><td>".$this->getJuego()."</td>
                    <td>".$this->getDescripcion()."</td>
                    <td style='border-right: 2px solid #000000'><video controls width='355px' height='200x'><source src='".$this->carpetaFotos.$this->getFoto()."' type='video/mp4'></video>
                    <td><a id='V_E_B' href='verVideos.php?id=".$this->getId()."'>Ver</a> </td>";
                    if(isset($_SESSION['permiso']) && !empty ($_SESSION['permiso']>1)){
                        $html.="<td><a id='V_E_B' href='formularioVideos.php?id=".$this->getId()."'>Editar</a> </td>
                    <td><a id='V_E_B' href='javascript:borrarVideo(".$this->id.")'>Borrar</a> </td>";
                        }
                    $html.="</tr>";
        $html .="<div>";
        return $html;

    }
    /**
     * Esta funcion sirve para mostrar todos los atributos del video cuando el usuario pulse la opcion de ver
     * @return string
     */
    public function imprimirEnFicha(){
        $html = "<div class='tablaVerVideos'>";
        $html.= "<table>";
        $html.= "<tr><th>Referencia</th>
                        <th>Juego</th>
                        <th>Descripcion</th>
                        <th>Video</th>
                </tr>";
        $html.= "<tr><td>".$this->getId()."</td>
                        <td>".$this->getJuego()."</td>
                        <td>".$this->getDescripcion()."</td>
                        <td><video controls width='355px' height='200px'><source src='".$this->carpetaFotos.$this->getFoto()."' type='video/mp4'></video></td>
                        </tr>";

        $html.= "</table>";
        $html.= "</div>";
        return $html;



    }
}