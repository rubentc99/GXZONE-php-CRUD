<?php
require "includes/protect.php";
require "modelo/Contacto.php";
require "modelo/Bd.php";
require "modelo/funciones.php";

if($_SESSION['permiso']>1){
    header('location:index.php');
}


$contacto= new Contacto();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id=intval($_GET['id']);
    $contacto->obtenerPorId($id);

}

if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])) {
        //Actualizar
        $id = intval($_POST['id']);
        $contacto->update($id,$_POST, $_FILES['foto']);
    }else{
        //Insertar
        $contacto->insertar($_POST, $_FILES['foto']);
    }
    header('location:index.php');

}



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario Contactos</title>
    <!--Validamos el formulario de los contactos-->
    <script>

        function validar() {
            var ok= true;
            var nombre = document.getElementById("nombre");
            var mail = document.getElementById("mail");
            var mensaje = document.getElementById("mensaje");
            var formato = /\w+@\w+\.+[a-z]/;


            if (nombre.value == "") {//si no hay nada escrito
                nombre.style.border="3px solid black";
                ok = false;
            }else {//cuando lo rellenamos
                nombre.style.border="1px solid rgba(194, 21, 21, 0.50)";

            }
            if (mail.value == "" || !formato.test(mail.value)) {//si no hay nada escrito y el formato no es el de un correo electronico
                mail.style.border="3px solid black";
                ok = false;
            }else {//cuando lo rellenamos
                mail.style.border="1px solid rgba(194, 21, 21, 0.50)";
            }
            if (mensaje.value == "") {//si no hay nada escrito
                mensaje.style.border="3px solid black";
                ok = false;
            }else {//cuando lo rellenamos
                mensaje.style.border="1px solid rgba(194, 21, 21, 0.50)";
            }
            if(ok){
                document.getElementById('Fcontacto').submit();
            }


        }
    </script>
    <?php
    include "includes/head.php";
    ?>

</head>
<body>
<div class="contenedor">
    <?php
    include "includes/header.php";

    ?>
    <section>
        <!--formulario de los contactos-->
        <div class="formularioContactos">
            <h3>Nuestro equipo estará encantado de responder cualquier duda, pregunta o sugerencia. Rellena el
                siguiente formulario y nos pondremos en contacto contigo lo antes posible.</h3>
            <form name="contactos" id="Fcontacto" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <ul>
                    <input type="hidden" name="id" value="<?php echo $contacto->getId() ?>">
                    <li><label>Nombre: </label><input type="text" name="nombre" id="nombre" value="<?php echo $contacto->getNombre() ?>"> </li>
                    <li><label>E-mail: </label><input type="email" name="mail" id="mail" value="<?php echo $contacto->getMail() ?>"></li>
                    <li><label>Mensaje: </label><textarea name="mensaje" id="mensaje"><?php echo $contacto->getMensaje() ?></textarea> </li>
                    <li><input id="botonGuardarMensaje" type="button" onclick="validar()" value="Enviar"></li>
                </ul>

            </form>

        </div>
    </section>
    <?php

    include "includes/footer.php";

    ?>

</div>
</body>
</html>
