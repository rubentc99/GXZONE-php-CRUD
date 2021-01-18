<?php
require "includes/protect.php";
require "modelo/ListaVideos.php";
require "modelo/Video.php";
require "modelo/Bd.php";
require "modelo/funciones.php";

$lista = new ListaVideos();
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
    <title>Mis videos</title>

    <?php
    include "includes/head.php";
    ?>

    <script src="js/scriptsVideos.js" type="text/javascript"></script>
</head>
<body>
<div class="contenedor">
    <?php
        include "includes/header.php";
        //include "includes/nav.php";
    ?>
    <section>
        <h1>Videos subidos</h1>
        <form id="formBuscador" name="buscador" action="<?php echo $_SERVER['PHP_SELF']?>" method="get">
            <input id="cajaBuscar" name="buscar" type="text" placeholder="Buscador">
            <input id="botonBuscador" type="submit" value="Buscar">
        </form>
        <div class="lista" id="lista">
           <?php
                echo  $lista->imprimirVideosEnBack();
           ?>
        </div>
    </section>
    <?php
        include "includes/footer.php";
    ?>
</div>
</body>
</html>
