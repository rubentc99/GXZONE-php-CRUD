<?php

require "../modelo/ListaVideos.php";
require "../modelo/Video.php";
require "../modelo/Bd.php";

$id = intval($_GET['id']);

//borro el elemento de la BD y su foto
$video = new Video();
$video->borrarVideo($id);

//Pido de nuevo la lista de elementos y la envio a AJAX

$lista = new ListaVideos();
$lista->obtenerElementos();


echo $lista->imprimirVideosEnBack();
