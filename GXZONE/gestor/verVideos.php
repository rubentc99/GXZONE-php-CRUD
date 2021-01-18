<?php
require "includes/protect.php";
require "modelo/Video.php";
require "modelo/Bd.php";
require "modelo/funciones.php";

$id=intval($_GET['id']);

$video = new Video();
$video->obtenerPorId($id);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información de los videos</title>

    <?php
    include "includes/head.php";
    ?>

</head>
<body>
    <?php
        include "includes/header.php";
    ?>
<section>
    <h1 style="text-align: center">Información del video</h1>
    <?php
        echo $video->imprimirEnFicha();
    ?>
</section>
    <?php
        include "includes/footer.php";
    ?>
</body>
</html>

