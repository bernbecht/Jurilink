<?php

include_once 'CConexao.php';

class CAdvogado {
    protected $id_pessoa;
    protected $oab;
    protected $flag;


    public function incluirAdvogado($conexao, $id, $o,$f){
        $this->id_pessoa= $id;
        $this->oab=$o;
        $this->flag=$f;        
        $incluir = null;
               
        
        //$conexao1 = new CConexao();

        //$conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao, "insert into advogado(id_pessoa,oab,flag_func)
                         values('"                
                .$this->id_pessoa."','"
                .$this->oab."',"
                .$this->flag.")");      
        
        //$conexao1->closeConexao();
        
        return $incluir;
    }
    
    public function getIDOab($oab){
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $sql = pg_exec($conexao, "select *  
            from advogado
            INNER JOIN pessoa 
            ON advogado.id_pessoa = pessoa.id_pessoa 
            and CAST (advogado.oab AS TEXT) like '{$oab}_%'            
            ");

        $conexao1->closeConexao();

        return $sql;
    }
    
}

?>
