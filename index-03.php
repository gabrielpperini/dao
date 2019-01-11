<?php

require_once('config.php');

//carrega o usuario
// $usuario = new Usuario();
// $usuario->loadById(3);
// echo $usuario;

//carrega uma lista
// $lista = Usuario::getList(); 
// echo json_encode($lista);

//carrega uma lista de usuarios buscando pelo login
// $search = Usuario::search("a");
// echo json_encode($search);

//carrega usuario pela senha e senha
$usuario = new Usuario();
$usuario->login("gabriel" , "123456");
echo $usuario;

?>