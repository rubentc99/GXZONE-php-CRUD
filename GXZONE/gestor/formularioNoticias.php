<?php
require "includes/protect.php";
require "modelo/Noticia.php";
require "modelo/Bd.php";
require "modelo/funciones.php";

if($_SESSION['permiso']<2){
    header('location:index.php');
}


$noticia= new Noticia();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id=intval($_GET['id']);
    $noticia->obtenerPorId($id);

}


if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])) {
        //Actualizar
        $id = intval($_POST['id']);
        $noticia->update($id,$_POST, $_FILES['foto']);
    }else{
        //Insertar
        $noticia->insertar($_POST, $_FILES['foto']);
    }
    //esta parte debo comentarla para ver los echos sql
    header('location:listarNoticias.php');

}



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario Noticias</title>
    <!--Validamos el formulario de las noticias -->
    <script>

        function validar() {
            var ok= true;
            var titular = document.getElementById("titular");
            var descripcion = document.getElementById("descripcion");
            var foto = document.getElementById("foto");


            if (titular.value == "") {
                titular.style.border="3px solid black";
                ok = false;
            }else {
                titular.style.border="1px solid rgba(194, 21, 21, 0.50)";

            }
            if (descripcion.value == "") {
                descripcion.style.border="3px solid black";
                ok = false;
            }else {
                descripcion.style.border="1px solid rgba(194, 21, 21, 0.50)";
            }
            if (foto.value == "") {
                foto.style.border="3px solid black";
                ok = false;
            }else {
                foto.style.border="1px solid rgba(194, 21, 21, 0.50)";
            }
            if(ok){
                document.getElementById('formNoticias').submit();

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
            <div class="formularioNoticias">
                <img id="fondoNoticias" src="imgEstructuraBack/fondoIngresarNoticia.jpg">
                <h1 id="insertarNoticia">Insertar Noticia</h1>
                <form name="noticias" id="formNoticias" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data"
                    <ul >
                        <input type="hidden" name="id" value="<?php echo $noticia->getId() ?>">
                        <li><label>Titular: </label><input type="text" name="titular" id="titular" value="<?php echo $noticia->getTitular() ?>"> </li>
                        <li><label>Descripcion: </label><textarea name="descripcion" id="descripcion"><?php echo $noticia->getDescripcion() ?></textarea> </li>
                        <li><label>Foto: </label><input type="file" name="foto" id="foto"> </li>
                        <?php
                            //if(strlen($noticia->getFoto())>0) echo "<li style='margin-top: -20px'><img src='".$noticia->getCarpetaFotos().$noticia->getFoto()."' width='80px'></li>";
                        ?>
                        <li><input id="botonGuardarNoticia" type="button" onclick="validar()" value="Guardar"></li>
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
