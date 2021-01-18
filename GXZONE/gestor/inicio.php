<?php
require "modelo/Bd.php";
require "modelo/funciones.php";
require "modelo/Usuario.php";
if (isset($_POST) && !empty($_POST)){

    $mail = addslashes($_POST['mail']);
    $pass = addslashes($_POST['pass']);

    $usuario = new Usuario();
    if($usuario->login($mail,$pass)){
        header("location:index.php");
    }else{
        lanzarError("Usuario no existe");
    }




}

?>
<!doctype html>
<html lang="en">
<head>
    <?php
    include "includes/head.php";
    ?>
    <title>Bienvenido a GXZONE</title>
    <!--Validamos el formulario de incio -->
    <script>
        function validar() {
            var ok= true;
            var email = document.getElementById("mail");
            var password = document.getElementById("pass");
            var formato = /\w+@\w+\.+[a-z]/;



            if (email.value == "" || !formato.test(email.value)) {
                email.style.border="3px solid red";
                ok = false;
            }else {
                email.style.border="2px solid black";

            }
            if (password.value == "" ) {
                password.style.border="3px solid red";
                ok = false;
            }else {
                password.style.border="2px solid black";

            }
            if(ok){
                document.getElementById('formLogin').submit();

            }

        }
    </script>

</head>
<body>
    <div class="contenedorFormLogin">
        <img id="letras" src="imgEstructuraBack/GXzone_letras.png">
        <form name="login" id="formLogin" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
            <ul>
                <li><label>E-mail: </label><input type="email" name="mail" id="mail"></li>
                <li><label>Contraseña: </label><input type="password" name="pass" id="pass"></li>
                <div class="botones">
                    <li><input type="button" onclick="validar()" value="Entrar" id="botonEntrarLogin"></li>
                    <li><a href="formularioRegistros.php"> <input type="button" value="Registrarse" id="botonRegistrarse"></a></li>
                </div>
            </ul>
        </form>
        <img id="mando" src="imgEstructuraBack/GXzone_mandoPs4.png">
    </div>
</body>
</html>
