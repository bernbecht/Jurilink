<?php

include_once 'CConexao.php';

class CUsuario {
    protected $id_pessoa;
    protected $email;
    protected $senha;    
    
    
      public function incluirUser($conexao,$id_pessoa, $s, $em ){
        
        $this->id_pessoa=$id_pessoa;  
        $this->senha=$s;
        $this->email = $em;
        $incluir = null;

        $incluir = pg_exec($conexao, "insert into usuario(id_pessoa,senha,email)
                         values('"
                .$this->id_pessoa."','"              
                .$this->senha."','"              
                .$this->email."')");      
        
      
        return $incluir;
        
    }
}

?>
