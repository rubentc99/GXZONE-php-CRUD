<?php

require "includes/protect.php";
require "modelo/ListaContactos.php";
require "modelo/Contacto.php";
require "modelo/Bd.php";
require "modelo/funciones.php";

if($_SESSION['permiso']<2){
    header('location:index.php');
}


$lista = new ListaContactos();
if(isset($_GET['buscar']) && !empty($_GET['buscar'])){
    $lista->obtenerElementos(addslashes($_GET['buscar']));
}else{
    $lista->obtenerElementos();
}




?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensajes de usuarios</title>

    <?php
    include "includes/head.php";
    ?>
    <script src="js/scriptsContactos.js" type="text/javascript"></script>
</head>
<body>
<div class="contenedor">
    <?php
    include "includes/header.php";

    ?>
    <section>
        <h1 style="text-align: center">Lista Mensajes</h1>
        <div class="buscadorContactos">
            <form id="formBuscador" name="buscador" action="<?php echo $_SERVER['PHP_SELF']?>" method="get">
                <input id="cajaBuscar" name="buscar" type="text" placeholder="Buscador">
                <input id="botonBuscador" type="submit" value="Buscar">
            </form>
        </div>

        <div class="lista" id="lista">
            <?php
                echo  $lista->imprimirContactosEnBack();
            ?>
        </div>
    </section>
    <?php

    include "includes/footer.php";

    ?>

</div>
</body>
</html>


