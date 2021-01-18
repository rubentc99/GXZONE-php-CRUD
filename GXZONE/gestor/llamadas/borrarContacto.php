<?php

require "../modelo/ListaContactos.php";
require "../modelo/Contacto.php";
require "../modelo/Bd.php";

$id = intval($_GET['id']);

//borro el elemento de la BD y su foto
$contacto = new Contacto();
$contacto->borrarContacto($id);

//Pido de nuevo la lista de elementos y la envio a AJAX

$lista = new ListaContactos();
$lista->obtenerElementos();


echo $lista->imprimirContactosEnBack();
