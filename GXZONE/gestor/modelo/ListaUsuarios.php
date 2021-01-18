<?php

/**
 * Class ListaUsuarios clase para listar los usuarios
 */
class ListaUsuarios
{
    private $lista;
    private $tabla;

    /**
     * ListaUsuarios constructor. funcion que conecta con la tabla usuarios de la bd
     */
    public function __construct()
    {
        $this->lista = array();
        $this->tabla = "usuarios";
    }
    /**
     * Funcion que sirve para encontrar un elemento en el buscador
     * @param string $txt
     * recoge lo que escribamos en el buscador
     */
    public function obtenerElementos($txt = ""){
        $sqlBusca = "";
        if(strlen($txt)>0){
            $sqlBusca = " WHERE nombre LIKE '%".$txt."%'";
        }
        $sql = "SELECT * FROM ".$this->tabla." ".$sqlBusca.";";

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        while( list($mail, $permiso, $pass,  $nombre, $id) = mysqli_fetch_array($res) ){

            $fila = new Usuario($mail, $permiso, $pass,  $nombre, $id);
            array_push($this->lista,$fila);

        }

    }


    /**
     * Funcion que sirve para mostrar los usuarios en back
     * @return string
     */
    public function imprimirUsuariosEnBack(){
        $html = "<div class='tablaUsuarios'>";
        $html .= "<table>";
        $html .= "<tr>
                    <th>Nombre</th> 
                    <th>Mail</th>
                    <th>Permiso</th>
                    <th colspan='3'>Opciones</th>
                </tr>";
        for($i=0;$i<sizeof($this->lista);$i++){
            $html .= $this->lista[$i]->imprimeteEnTr();
        }

        $html .= "</table>";
        $html .= "<div>";
        return $html;

    }



}