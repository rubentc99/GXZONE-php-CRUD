<?php

require "../modelo/ListaUsuarios.php";
require "../modelo/Usuario.php";
require "../modelo/Bd.php";

$id = intval($_GET['id']);

//borro el elemento de la BD y su foto
$usuario = new Usuario();
$usuario->borrarUsuario($id);

//Pido de nuevo la lista de elementos y la envio a AJAX

$lista = new ListaUsuarios();
$lista->obtenerElementos();


echo $lista->imprimirUsuariosEnBack();

