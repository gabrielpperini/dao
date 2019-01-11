<?php

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


    /**
     * Get the value of idusuario
     */ 
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set the value of idusuario
     *
     * @return  self
     */ 
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get the value of deslogin
     */ 
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    /**
     * Set the value of deslogin
     *
     * @return  self
     */ 
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;

        return $this;
    }

    /**
     * Get the value of dessenha
     */ 
    public function getDessenha()
    {
        return $this->dessenha;
    }

    /**
     * Set the value of dessenha
     *
     * @return  self
     */ 
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;

        return $this;
    }

    /**
     * Get the value of dtcadastro
     */ 
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    /**
     * Set the value of dtcadastro
     *
     * @return  self
     */ 
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;

        return $this;
    }

    public function loadById($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID" , array( ":ID" => $id ));

        //print_r($result);
        
        if(isset($result))
        {
            $this->setData($result[0]);   
        }
    }

    public function getList()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario");
    }

    public static function search($login)
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin" , 
        array( ":SEARCH" => "%". $login ."%",));
    }

    public function login($login , $password)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD " , 
        array( 
            ":LOGIN" => $login, 
            ":PASSWORD" => $password,
        ));

        //print_r($result);
        
        if(count($result) > 0 )
        {
            $this->setData($result[0]);
        } else 
        {
            throw new Exception("DEU RUIM PAE");
        }
    }
    
    public function insert()
    {
        $sql = new Sql();
        $result = $sql->select("CALL sp_usuarios_insert(:LOGIN , :PASSWORD )" , 
        array( 
            ":LOGIN" => $this->getDeslogin(),
            ":PASSWORD" => $this->getDessenha(),
        ));
        
        //print_r($result);
        
        if(count($result) > 0)
        {
            $this->setData($result[0]);
        }
    }
    
    public function update($login , $senha)
    {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
        
        $sql = new Sql();
        
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN , dessenha = :PASSWORD WHERE idusuario = :ID ", 
        array( 
            ":LOGIN" => $this->getDeslogin(),
            ":PASSWORD" => $this->getDessenha(),
            ":ID" => $this->getIdusuario(),
        ));
    }

    public function delete()
    {
        $sql = new Sql();
        
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID" , array( 
            ":ID" => $this->getIdusuario(),
        ));

        $lista = $this->getList(); 
        echo json_encode($lista); 
    }
    
    public function setData($datas)
    {
        $this->setIdusuario($datas["idusuario"]);
        $this->setDeslogin($datas["deslogin"]);
        $this->setDessenha($datas["dessenha"]);
        $this->setDtcadastro(new DateTime($datas["dtcadastro"]));
    }

    public function __construct($login = "" , $senha = "")
    {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
    }
    
    public function __toString()
    {
        return json_encode(array(
            "idusuario" => $this->getIdusuario(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastro" => $this->getDtcadastro()->format('d/m/Y H:i:s'),
        ));
    }

}

?>