<?php
require "includes/protect.php";

?>
<!doctype html>
<html lang="en">
<head>
    <!--include del head, con sus hojas de estilos enlazadas y demás-->
    <?php
    include "includes/head.php";
    ?>
</head>
<body>
    <div class="contenedor"> <!--contenedor general-->

        <?php
        include "includes/header.php"; //include del header, la barra superior de arriba
        ?>

        <section>
            <img id='frase1' src="imgEstructuraBack/frase1Pasion.png">
            <img id='frase2' src="imgEstructuraBack/frase2Pasion.png">
            <div class="fotoEsports">
                <img src="imgEstructuraBack/eSportsEstadio.jpg">
            </div>
        </section>

        <?php
        include "includes/footer.php";
        ?>
    </div>
</body>
</html>
