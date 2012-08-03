<?php

include_once 'CConexao.php';

class CUsuario {
    protected $id_pessoa;
    //protected $email;
    protected $senha;    
    
    
      public function incluirUser($conexao,$id_pessoa, $s ){
        
        $this->id_pessoa=$id_pessoa;  
        $this->senha=$s;
        $incluir = null;

        $incluir = pg_exec($conexao, "insert into usuario(id_pessoa,senha)
                         values('"
                .$this->id_pessoa."','"              
                .$this->senha."')");      
        
      
        return $incluir;
        
    }
}

?>
