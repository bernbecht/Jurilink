<?php

include_once 'CConexao.php';

class CUsuario {

    protected $id_pessoa;
    protected $email;
    protected $senha;

    public function editarUser($conexao, $id_pessoa, $s, $em) {
        $this->id_pessoa = $id_pessoa;
        $this->senha = $s;
        $editar = null;
        
        $query = "UPDATE usuario SET senha = '".$this->senha."' 
            WHERE id_pessoa = ".$this->id_pessoa."";
        
        $editar = pg_query($conexao,$query);
        return $editar;
        
    }
    
    public function excluirUser($conexao,$id_pessoa){
        $this->id_pessoa = $id_pessoa;
        $excluir = null;
        
        //echo "OPS";
        $query = "DELETE from usuario WHERE id_pessoa =".$this->id_pessoa."";
        $excluir = pg_query($conexao,$query);
        return $excluir;
        
    }
    
    public function incluirUser($conexao, $id_pessoa, $s, $em) {

        $this->id_pessoa = $id_pessoa;
        $this->senha = $s;
        $this->email = $em;
        $incluir = null;

        $incluir = pg_exec($conexao, "insert into usuario(id_pessoa,senha,email)
                         values(
                {$this->id_pessoa},'"
                . $this->senha . "',
                 '" .$this->email. "')");


        return $incluir;
    }
    
    public function ehUser($id_pessoa){
        
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();
        
        $query = "select * from usuario where usuario.id_pessoa = $id_pessoa";
        
        $pesq_user = pg_exec($conexao, $query);
        
        $user = pg_fetch_object($pesq_user);
        
        return $user;
    }

}

?>
