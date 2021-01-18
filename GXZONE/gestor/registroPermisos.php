<?php
require "includes/protect.php";
require "modelo/Usuario.php";
require "modelo/Bd.php";
require "modelo/funciones.php";

if($_SESSION['permiso']<2){
    header('location:index.php');
}


$usuario= new Usuario();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id=intval($_GET['id']);
    $usuario->obtenerPorId($id);

}


if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])) {
        //Actualizar
        $id = intval($_POST['id']);
        $usuario->update($id,$_POST, $_FILES['foto']);
    }else{
        //Insertar
        $usuario->insertar($_POST, $_FILES['foto']);
    }
    //esta parte debo comentarla para ver los echos sql
    header('location:listarUsuarios.php');

}



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permiso usuario</title>
    <!--Validamos el registro de permisos-->
    <script>
        function validar() {
            permiso = document.getElementById("botonGuardarPermiso").value;




            if (permiso === "") {
                alert("Rellena todos los campos");
                return false;
            }

            document.getElementById('Fpermiso').submit();

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
        <div class="formularioPermisos">
            <h1 style="text-align: center">Permisos</h1>
            <div class="editarPermisos">
                <form name="permisos" id="Fpermiso" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    <ul>
                        <input type="hidden" name="id" value="<?php echo $usuario->getId() ?>">
                        <li><label>Permiso: </label><input id="inputPermiso" type="number" name="permiso" id="permiso" value="<?php echo $usuario->getPermiso() ?>"> </li>
                        <li><input id="botonGuardarPermiso" type="button" onclick="validar()" value="Guardar"></li>
                    </ul>
                </form>
            </div>
        </div>
    </section>
    <?php

    include "includes/footer.php";

    ?>

</div>
</body>
</html>

