<?php

class Sql {

    private $conect;

    public function __construct(){

        $this->conect = new PDO("mysql:dbname=php7;host=localhost", "root", "");

    }

    
    private function setParams($statment , $parameters = array())
    {
        
        foreach($parameters as $key => $value){
            
            $this->setParam($key , $value);
    
        }
    
    }

    private function setParam($statment , $key , $value)
    {

        $statment->bind($key , $value);

    }

    public function query($rawQuery , $params = array())
    {
        
        $stmt = $this->conect->prepare($rawQuery); 
        
        $this->setParams( $stmt , $params);

        $stmt->execute();

        return $stmt;
    }
    
    public function select($rowQuery , $params = array() ):array
    {

        $stmt = $this->query($rowQuery , $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}


$obj = new Sql;

?>