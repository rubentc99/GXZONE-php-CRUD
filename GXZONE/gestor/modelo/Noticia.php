<?php
/**
 * Class Noticia clase noticia
 */

class Noticia
{
    private $id;
    private $titular;
    private $descripcion;
    private $foto;

    private $tabla;
    private $carpetaFotos;

    /**
     * Noticia constructor.
     * @param $id ;
     * recoge el id
     * @param $titular ;
     * recoge el titular
     * @param $descripcion ;
     * recoge la descripcion
     * @param $foto ;
     * recoge la foto
     * @param $tabla ;
     * recoge la tabla
     * @param $carpetaFotos ;
     * recoge la carpeta de las fotos
     */
    public function __construct($id = "", $titular = "", $descripcion = "", $foto = "")
    {
        $this->id = $id;
        $this->titular = $titular;
        $this->descripcion = $descripcion;
        $this->foto = $foto;
        $this->tabla = "noticia";
        $this->carpetaFotos = "fotos/";
    }

    /**
     * Funcion que sirve para rellenar todos los datos
     * @param $id
     * id de la noticia
     * @param $titular
     * id del titular
     * @param $descripcion
     * id de la descripcion
     * @param $foto
     * id de la foto
     */
    private function llenar($id, $titular, $descripcion, $foto)
    {
        $this->id = $id;
        $this->titular = $titular;
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
     * Metodo para obtener el titular
     * @return string
     */
    public function getTitular()
    {
        return $this->titular;
    }

    /**
     * Metodo para asignar el titular
     * @param string $titular
     */
    public function setTitular($titular)
    {
        $this->titular = $titular;
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
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * Metodo para obtner la carpeta fotos
     * @return string
     */
    public function getCarpetaFotos()
    {
        return $this->carpetaFotos;
    }

    /**
     * Metodo para asignar el id
     * @param string $carpetaFotos
     */
    public function setCarpetaFotos($carpetaFotos)
    {
        $this->carpetaFotos = $carpetaFotos;
    }


    /**
     * metodo que sirve para insertar una noticia
     * @param $datos
     * recoge los datos de la noticia
     * @param $foto
     * recoge la foto de la noticia
     */
    public function insertar($datos,$foto){
        $conexion = new Bd();
        $conexion->insertarElemento($this->tabla,$datos,$this->carpetaFotos,$foto);

    }
    /**
     * metodo que sirve para actualizar la noticia
     * @param $id
     * recoge el id de la noticia
     * @param $datos
     * recoge los datos de la noticia
     * @param $foto
     * recoge la foto de la noticia
     */
    public function update($id, $datos, $foto){

        $conexion = new Bd();
        $conexion->uppdateBD($id, $this->tabla, $datos, $foto, $this->carpetaFotos);


    }
    /**
     * Método que sirve para borrar la noticia
     * @param $id
     * recoge el id de la noticia
     */
    public function borrarNoticia($id){

        $conexion = new Bd();
        $conexion->borrarFoto($id, $this->tabla,"titular, descripcion, foto, id","../".$this->carpetaFotos);
        $sql = "DELETE FROM ".$this->tabla." WHERE id =".$id;
        //echo $sql;
        $conexion->consulta($sql);


    }



    /**
     * Metodo que sirve para obtener los datos la noticia por el id
     * Version larga
     * @param $id
     * recoge el id de la noticia
     */
    public function obtenerPorId($id){

        $sql = "SELECT * FROM ".$this->tabla." WHERE id=".$id;

        $conexion= new Bd();
        $res = $conexion->consulta($sql);

        list($titular, $descripcion, $foto, $id) = mysqli_fetch_array($res);

        $this->llenar($titular, $descripcion, $foto, $id);

    }

    /**
     * Método que retorna una fila para la insercion en una tabla de la clase lista.
     * @return string
     */
    public function imprimeteEnTr(){
        $html = "<tr><td>".$this->getTitular()."</td>
                    <td>".$this->getDescripcion()."</td>
                    <td style='padding: 20px; border-right: 2px solid #000000'><img src='".$this->carpetaFotos.$this->getFoto()."' width='355px' height='200x'>
                    <td><a id='V_E_B' href='verNoticia.php?id=".$this->getId()."'>Ver</a> </td>";
                    if(isset($_SESSION['permiso']) && ! empty ($_SESSION['permiso']>1)){
                        $html.="<td><a id='V_E_B' href='formularioNoticias.php?id=".$this->getId()."'>Editar</a> </td>
                        <td><a id='V_E_B' href='javascript:borrarNoticia(".$this->id.")'>Borrar</a> </td>";
                    }
                    $html.="</tr>";
        return $html;
    }
    /**
     * Esta funcion sirve para mostrar todos los atributos de la noticia cuando el usuario pulse la opcion de ver
     * @return string
     */
    public function imprimirEnFicha(){
        $html = "<div class='tablaVerNoticias'>";
        $html .= "<table>";
        $html .= "<tr><th>Referencia</th>
                        <th>Titular</th>
                        <th>Descripcion</th>
                        <th>Imagen</th>
                        </tr>";
        $html .= "  <tr><td  style='text-align: center'>".$this->getId()."</td>
                        <td>".$this->getTitular()."</td>
                        <td>".$this->getDescripcion()."</td>
                        <td><img src='".$this->carpetaFotos.$this->getFoto()."' width='355px' height='200x'></td>
                        </tr>";
        $html .= "</table>";
        $html .= "</div>";
        return $html;
    }
}