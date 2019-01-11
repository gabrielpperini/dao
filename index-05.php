<?php

require_once('config.php');

//retorna dados de um certo id e ps atualiza

$usuario = new Usuario();
$usuario->loadById(8);
$usuario->update("geja" , "gravidez");
echo $usuario;






?>