<header>
    <div class="barra"> <!--barra blanca superior-->
        <a href="index.php"><img id="logoHeader" src="./imgEstructuraBack/LogoGXnew.PNG"></a>
        <img id="letrasNav" src="./imgEstructuraBack/GXzone_letras.png">
        <div class="nav">
            <ul>
                <li class="liNav">
                    <a href="listarNoticias.php" class="dropbtn">Noticias</a>
                    <!-- Permisos-->
                    <?php
                    //si el usuario tiene más de permiso 1, podrá añadir noticias
                        if($_SESSION['permiso']>1){
                            echo '<div class="liNav-content">
                                <a href="formularioNoticias.php">Añadir noticias</a>
                            </div>';
                        }
                    ?>
                </li>
                <li class="liNav">
                    <a href="listarVideos.php" class="dropbtn">Videos</a>
                    <?php
                        //si el usuario tiene más de permiso 1, podrá añadir videos
                        if($_SESSION['permiso']>1){
                            echo '<div class="liNav-content">
                                <a href="formularioVideos.php">Añadir video</a>
                            </div>';
                        }
                    ?>
                </li>
                <li class="liNav">
                    <?php
                    //si el usuario tiene más de permiso 1, podrá ver los mensajes
                    if($_SESSION['permiso']>1){
                        echo '<a href="listarContactos.php">Contacto gestión</a>';
                    }else{
                    //si el usuario tiene menos de permiso 1, le saldrá el formulario de contacto
                        echo '<a href="formularioContactos.php">Contacto</a>';
                    }
                    ?>

                </li>
                <li class="liNav">
                    <?php
                    //si el usuario tiene más de permiso 1, podrá ver los mensajes
                    if($_SESSION['permiso']>1){
                        echo '<a href="listarUsuarios.php">Usuarios</a>';
                    }
                    ?>

                </li>
                <!--Con esto, hago que en el nav mediante php muestre quien es el usuario logeado y que pueda cerrar sesión-->
                <li class="liNav">
                    <a id="usuario"><img id="logoUsuario" src="./imgEstructuraBack/usuario.png"><?php if(isset($_SESSION['id_usuario'])) echo "Hola, ".$_SESSION['nombre'] ?></a>
                    <div class="liNav-content">
                        <a href="logout.php">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
