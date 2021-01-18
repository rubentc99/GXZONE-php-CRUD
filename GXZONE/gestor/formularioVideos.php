<?php
require "includes/protect.php";
require "modelo/Video.php";
require "modelo/Bd.php";
require "modelo/funciones.php";

if($_SESSION['permiso']<2){
    header('location:index.php');
}
$video= new Video();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id=intval($_GET['id']);
    $video->obtenerPorId($id);

}


if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])) {
        //Actualizar
        $id = intval($_POST['id']);
        $video->update($id,$_POST, $_FILES['foto']);
    }else{
        //Insertar
        $video->insertar($_POST, $_FILES['foto']);
    }
    header('location:listarVideos.php');

}



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario Videos</title>
    <!--Validamos el formulario de los videos-->
    <script>
        function validar() {
            var ok = true;
            var juego = document.getElementById("juego");
            var descripcion = document.getElementById("descripcion");
            var video = document.getElementById("video");

            if (juego.value == "") {//si no hay nada escrito
                juego.style.border="3px solid black";
                ok = false;
            }else {//cuando hayamos lo hayamos rellenado
                juego.style.border="1px solid rgba(194, 21, 21, 0.50)";

            }
            if (descripcion.value == "") {//si no hay nada escrito
                descripcion.style.border="3px solid black";
                ok = false;
            }else {//cuando hayamos lo hayamos rellenado
                descripcion.style.border="1px solid rgba(194, 21, 21, 0.50)";
            }
            if (video.value == "") {//si no hay nada escrito
                video.style.border="3px solid black";
                ok = false;
            }else {//cuando hayamos lo hayamos rellenado
                video.style.border="1px solid rgba(194, 21, 21, 0.50)";
            }
            if(ok){
                document.getElementById('formVideos').submit();
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
            <!--formulario de los videos-->
            <div class="formularioVideos">
                <img id="fondoVideos" src="imgEstructuraBack/fondoIngresarVideo.jpg">
                <h1 id="insertarVideos">Insertar Video</h1>
                <form name="videos" id="formVideos" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    <ul>
                        <input type="hidden" name="id" value="<?php echo $video->getId() ?>">
                        <li><label>Juego: </label><input type="text" name="juego" id="juego" value="<?php echo $video->getJuego() ?>"> </li>
                        <li><label>Descripcion: </label><textarea name="descripcion" id="descripcion"><?php echo $video->getDescripcion() ?></textarea> </li>
                        <li><label>Video: </label><input type="file" name="foto" accept="video/*" id="video"> </li>
                        <?php
                            if(strlen($video->getFoto())>0){
                                //echo "<li><video width='200px' height='112px' controls><source src='".$video->getCarpetaFotos().$video->getFoto()."'></video></li>";
                            }
                        ?>
                        <div class="boton">
                            <li><input id="botonGuardarVideo" type="button" onclick="validar()" value="Guardar"></li>
                        </div>
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

