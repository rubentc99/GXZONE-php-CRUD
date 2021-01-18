<?php
require "modelo/Bd.php";
require "modelo/funciones.php";
require "modelo/Usuario.php";
$usuario= new Usuario();

if (isset($_POST) && !empty($_POST)){

    $nombre = addslashes($_POST['nombre']);
    $mail = addslashes($_POST['mail']);
    $pass = addslashes($_POST['pass']);
    $permiso = addslashes($_POST['permiso']);
    $usuario = new Usuario();
    if($usuario->registro($id, $nombre, $mail, $pass, $permiso)){
        header("location:index.php");
    }else{
        lanzarError("Usuario no existe");
    }




}
if(isset($_GET['id']) && !empty($_GET['id'])){

    $id=intval($_GET['id']);
    $usuario->obtenerPorId($id);

}



if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])) {
        //Actualizar
        $id = intval($_POST['id']);
        $usuario->update($id,$_POST, $_FILES['foto']);
    }
    //esta parte debo comentarla para ver los echos sql
    header('location:listarUsuarios.php');

}
?>
<!doctype html>
<html lang="en">
<head>
    <?php
    include "includes/head.php";
    ?>
    <title>Registrate a GXZONE</title>
    <!--Validamos el formulario de los registros -->
    <script>

        function validar() {
            var ok= true;
            var nombre = document.getElementById("nombre");
            var email = document.getElementById("mail");
            var password = document.getElementById("pass");
            var formato = /\w+@\w+\.+[a-z]/;


            if (nombre.value == "" ) {
                nombre.style.border="3px solid red";
                ok = false;
            }else {
                nombre.style.border="2px solid black";

            }
            if (email.value == "" || !formato.test(email.value)) {
                email.style.border="3px solid red";
                ok = false;
            }else {
                email.style.border="2px solid black";

            }
            if (password.value == "") {
                password.style.border="3px solid red";
                ok = false;
            }else {
                password.style.border="2px solid black";

            }

            if(ok){
                document.getElementById('formRegistro').submit();

            }

        }
    </script>

</head>
<body>
<div class="contenedorFormLogin">
    <img id="letras" src="imgEstructuraBack/GXzone_letras.png">
    <form name="registro" id="formRegistro" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
        <ul>
            <li><label>Nombre: </label><input type="text" name="nombre" id="nombre" value="<?php echo $usuario->getNombre() ?>"></li>
            <li><label>E-mail: </label><input type="email" name="mail" id="mail" value="<?php echo $usuario->getMail() ?>"></li>
            <li><label>Contraseña: </label><input type="password" name="pass" id="pass" value="<?php echo $usuario->getPass() ?>"></li>
            <div class="botonesFormRegistro">
                <li><input type="button" onclick="validar()" value="Entrar" id="botonEntrar"></li>
                <li><a href="inicio.php"><input type="button" value="Iniciar sesión" id="botonLogin"></a></li>
            </div>
        </ul>
    </form>
    <img id="mandoRegistro" src="imgEstructuraBack/GXzone_mandoPs4.png">
</div>
</body>
</html>

