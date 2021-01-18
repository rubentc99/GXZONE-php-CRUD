<?php
/**
 * Class ListaNoticias clase para listar las noticias
 */

class ListaNoticias
{
    private $lista;
    private $tabla;
    /**
     * ListaNoticias constructor. funcion que conecta con la tabla noticia de la bd
     */
    public function __construct()
    {
        $this->lista = array();
        $this->tabla = "noticia";
    }

    /**
     * Funcion que sirve para encontrar un elemento en el buscador
     * @param string $txt
     * recoge lo que escribamos en el buscador
     */
    public function obtenerElementos($txt = ""){
        $sqlBusca = "";
        if(strlen($txt)>0){
            $sqlBusca = " WHERE titular LIKE '%".$txt."%'";
        }
        $sql = "SELECT * FROM ".$this->tabla." ".$sqlBusca.";";

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        while( list( $titular,$descripcion,$foto, $id) = mysqli_fetch_array($res) ){

            $fila = new Noticia($titular,$descripcion,$foto, $id);
            array_push($this->lista,$fila);

        }

    }

    /**
     * Funcion que sirve para mostrar las noticias en back
     * @return string
     */

    public function imprimirNoticiasEnBack(){
        $html = "<div class='tablaListarNoticias'>";
        $html .= "<table>";
        $html .= "<tr>
                    <th>Titular</th> 
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th colspan='3'>Opciones</th>
                </tr>";
        for($i=0;$i<sizeof($this->lista);$i++){
            $html .= $this->lista[$i]->imprimeteEnTr();
        }
        $html .= "</table>";
        $html .= "</div>";
        return $html;

    }



}