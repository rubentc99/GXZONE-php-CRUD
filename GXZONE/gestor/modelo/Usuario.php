<?php

/**
 * Class Usuario clase usuario
 */
class Usuario
{
    private $id;
    private $mail;
    private $permiso;
    private $pass;
    private $nombre;

    private $carpetaFotos;
    private $tabla;

    /**
     * Usuario constructor.
     * @param $id;
     * recoge el id
     * @param $nombre;
     * recoge el nombre
     * @param $mail;
     * recoge el mail
     * @param $pass;
     * recoge la contraseña
     * @param $permiso;
     * recoge el permiso
     * @param $carpetaFotos;
     * recoge la carpeta fotos
     */
    public function __construct($id="", $mail="", $permiso="", $pass="", $nombre="")
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->permiso = $permiso;
        $this->pass = $pass;
        $this->nombre = $nombre;
        $this->tabla = "usuarios";
        $this->carpetaFotos = "fotos/";
    }

    /**
     * Funcion que sirve para rellenar todos los datos
     * @param string $id
     * id del usuario
     * @param string $mail
     * id del mail
     * @param string $pass
     * id de la contraseña
     * @param string $permiso
     * id del permiso
     * @param string $nombre
     * id del nombre
     */
    private function llenar($id="", $mail="",$pass="", $permiso="",  $nombre="")
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->pass = $pass;
        $this->permiso = $permiso;
        $this->nombre = $nombre;


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
     * Metodo para obtener el mail
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Metodo para asignar el mail
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
    /**
     * Metodo para obtener el permsio
     * @return string
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Metodo para asignar el permsio
     * @param string $permiso
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;
    }
    /**
     * Metodo para obtener la contraseña
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Metodo para asignar la contraseña
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }


    /**
     * Metodo pra obtener el nombre
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Metodo para asignar el nombre
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    /**
     * metodo que sirve para insertar un ususario
     * @param $datos
     * recoge los datos de la ususario
     * @param $foto
     * recoge la foto de la ususario
     */
    public function insertar($datos,$foto){
        $conexion = new Bd();
        $conexion->insertarElemento($this->tabla,$datos,$this->carpetaFotos,$foto);

    }

    /**
     * metodo que sirve para actualizar un usuario
     * @param $id
     * recoge el id de un usuario
     * @param $datos
     * recoge los datos de un usuario
     * @param $foto
     * recoge la foto de un usuario
     */
    public function update($id, $datos, $foto){

        $conexion = new Bd();
        $conexion->uppdateBD($id, $this->tabla, $datos, $foto, $this->carpetaFotos);


    }
    /**
     * Método que sirve para borrar un usuario
     * @param $id
     * recoge el id de el usuario
     */
    public function borrarUsuario($id){

        $conexion= new Bd();

        $sql = "DELETE FROM ".$this->tabla ." WHERE id=".$id;
        //echo $sql;
        $conexion->consulta($sql);


    }



    /**
     * Metodo que sirve para obtener los datos del usuario por el id
     * Version larga
     * @param $id
     * recoge el id del usuario
     */
    public function obtenerPorId($id){

        $sql = "SELECT * FROM ".$this->tabla." WHERE id=".$id;

        $conexion= new Bd();
        $res = $conexion->consulta($sql);

        list($mail, $permiso, $pass,  $nombre, $id) = mysqli_fetch_array($res);

        $this->llenar($mail, $permiso, $pass,  $nombre, $id);

    }
    /**
     * funcion para entran en la aplicacion
     * @param $mail
     * recoge el mail
     * @param $pass
     * recoge la contraseña
     * @return bool
     */
    public function login($mail, $pass){

        $conexion = new Bd();
        $sql = "SELECT id, nombre, permiso FROM ".$this->tabla.
            " WHERE mail='".$mail."' AND pass='".md5($pass)."';";
        $res = $conexion->consulta($sql);
        $conexion->numeroElementos();
        if($conexion->numeroElementos()>0){
            list($id, $nombre, $permiso) = mysqli_fetch_array($res);
            session_start();
            $_SESSION['id_usuario'] = $id;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['permiso'] = $permiso;
            $_SESSION['mail'] = $mail;
            $respuesta = true;
        }else{
            $respuesta = false;
        }

        return $respuesta;
    }

    /**
     * Funcion para registrarse en la aplicacion
     * @param $id
     * recoge el id
     * @param $nombre
     * recoge el nombre
     * @param $mail
     * recoge el mail
     * @param $pass
     * recoge la contraseña
     * @param $permiso
     * recoge el permiso
     * @return bool
     */
    public function registro($id, $nombre, $mail, $pass, $permiso){

        $conexion = new Bd();
        $pass=md5($pass);
        $permiso=1;
        $sql = "INSERT INTO usuarios (id, nombre, mail, pass, permiso) VALUES ('$id', '$nombre', '$mail', '$pass', '$permiso')";
        $res = $conexion->consulta($sql);
        $conexion->numeroElementos();
        if($conexion->numeroElementos()>0){
            list($id, $nombre, $permiso) = mysqli_fetch_array($res);
            session_start();
            $_SESSION['id_usuario'] = $id;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['permiso'] = $permiso;
            $_SESSION['mail'] = $mail;
            $respuesta = true;
        }else{
            $respuesta = false;
        }

        return $respuesta;
    }
    /**
     * Método que retorna una fila para la insercion en una tabla de la clase lista.
     * @return string
     */
    public function imprimeteEnTr(){
        $html = "<tr><td>".$this->getNombre()."</td>
                    <td>".$this->getMail()."</td>
                    <td style='border-right:2px solid #000000'>".$this->getPass()."</td>
                    <td style='border: none'><a id='V_E_B' href='verUsuarios.php?id=".$this->getId()."'>Ver</a> </td>";
        if(isset($_SESSION['permiso']) && ! empty ($_SESSION['permiso']>1)){
            $html.="<td style='border: none'><a id='V_E_B' href='registroPermisos.php?id=".$this->getId()."'>Editar</a> </td>
                        <td style='border: none'><a id='V_E_B' href='javascript:borrarUsuario(".$this->id.")'>Borrar</a> </td>";
        }
        $html.="</tr>";
        return $html;
    }

    /**
     * Esta funcion sirve para mostrar todos los atributos del usuario cuando el usuario pulse la opcion de ver
     * @return string
     */
    public function imprimirEnFicha(){
        $html = "<div class='tablaVerUsuarios'>";
        $html .= "<table>";
        $html .= "<tr><th>Referencia</th>
                        <th>Nombre</th>
                        <th>Mail</th> 
                        <th>Contraseña</th>
                        <th>Permiso</th>
                        </tr>";
        $html .= "  <tr><td>".$this->getId()."</td>
                        <td>".$this->getNombre()."</td>
                        <td>".$this->getMail()."</td>
                        <td>".$this->getPass()."</td>
                        <td>".$this->getPermiso()."</td>
                        </tr>";
        $html .= "</table>";
        $html .= "</div>";
        return $html;



    }




}


