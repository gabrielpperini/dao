<?php

require_once('config.php');

//insere login e senha com metodo __construct e devolve id criado com dados respectivos
$usuario = new Usuario("excluido" , "marli123");
$usuario->insert();

if($usuario){
   echo $usuario; 
} else{
    throw new Exception("TA COMENTADO PAE", 1);
    
}







?>