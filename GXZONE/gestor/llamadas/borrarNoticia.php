<?php

require "../modelo/ListaNoticias.php";
require "../modelo/Noticia.php";
require "../modelo/Bd.php";

$id = intval($_GET['id']);

//borro el elemento de la BD y su foto
$noticia = new Noticia();
$noticia->borrarNoticia($id);

//Pido de nuevo la lista de elementos y la envio a AJAX

$lista = new ListaNoticias();
$lista->obtenerElementos();


echo $lista->imprimirNoticiasEnBack();