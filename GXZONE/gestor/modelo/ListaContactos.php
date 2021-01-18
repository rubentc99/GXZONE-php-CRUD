<?php
/**
 * Class ListaContactos clase para listar los contactos
 */

class ListaContactos
{

    private $lista;
    private $tabla;
    /**
     * ListaContactos constructor. funcion que conecta con la tabla contacto de la bd
     */
    public function __construct()
    {
        $this->lista = array();
        $this->tabla = "contacto";
    }
    /**
     * Funcion que sirve para encontrar un elemento en el buscador
     * @param string $txt
     * recoge lo que escribamos en el buscador
     */
    public function obtenerElementos($txt = "")
    {
        $sqlBusca = "";
        if (strlen($txt) > 0) {
            $sqlBusca = " WHERE mensaje LIKE '%" . $txt . "%'";
        }
        $sql = "SELECT * FROM " . $this->tabla . " " . $sqlBusca . ";";

        $conexion = new Bd();
        $res = $conexion->consulta($sql);
        while (list($nombre, $mail, $mensaje, $id) = mysqli_fetch_array($res)) {

            $fila = new Contacto($nombre, $mail, $mensaje, $id);
            array_push($this->lista, $fila);

        }

    }
    /**
     * Funcion que sirve para mostrar los contactos en back
     * @return string
     */
    public function imprimirContactosEnBack()
    {
        $html = "<div class='tablaContacto'>";
        $html .= "<table>";
        $html .= "<tr><th>Nombre</th>
                        <th>Mail</th>
                        <th>Mensaje</th>
                        <th>Admin</th></tr>";
        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $html .= $this->lista[$i]->imprimeteEnTr();
        }
        $html .= "</table>";
        $html .= "</div>";
        return $html;
    }
}
