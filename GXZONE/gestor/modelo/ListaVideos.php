<?php

/**
 * Class ListaVdeos clase para listar las videos
 */
class ListaVideos
{
    private $lista;
    private $tabla;
    /**
     * ListaVideos constructor. funcion que conecta con la tabla video de la bd
     */
    public function __construct()
    {
        $this->lista = array();
        $this->tabla = "video";
    }
    /**
     * Funcion que sirve para encontrar un elemento en el buscador
     * @param string $txt
     * recoge lo que escribamos en el buscador
     */
    public function obtenerElementos($txt = ""){
        $sqlBusca = "";
        if(strlen($txt)>0){
            $sqlBusca = " WHERE juego LIKE '%".$txt."%'";
        }
        $sql = "SELECT * FROM ".$this->tabla." ".$sqlBusca.";";

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        while( list( $juego,$descripcion,$foto, $id) = mysqli_fetch_array($res) ){

            $fila = new Video($juego,$descripcion,$foto, $id);
            array_push($this->lista,$fila);

        }

    }

    /**
     * Funcion que sirve para mostrar los videos en back
     * @return string
     */

    public function imprimirVideosEnBack(){
        $html = "<div class='tablaListarVideos'>";
        $html.= "<table>";
        $html .= "<tr><th>Juego</th>
                        <th>Descripcion</th>
                        <th>Video</th>
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