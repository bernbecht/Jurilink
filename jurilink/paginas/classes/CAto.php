<?php

require_once 'CConexao.php';

class CAto {
    
    protected $nome;
    protected $previsao;
    protected $flag_cliente;
    protected $descricao;
    
    function CAto(){}
    
    public function incluirAto($n, $p, $f, $d){
        $this->nome= $n;
        $this->previsao= $p;
        $this->flag_cliente=$f;
        $this->descricao= $d;
        
        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        if ($this->flag_cliente == 1){
            pg_exec($conexao, "insert into ato(previsao,flag_cliente,nome,descricao)
                         values('"
                .$this->previsao."','"
                .$this->flag_cliente."','"
                .$this->nome."','"
                .$this->descricao."')");
        
        }
        else {
            pg_exec($conexao, "insert into ato(previsao,flag_cliente,nome,descricao)
                         values('"
                .$this->previsao."',
                 '0','"     //Manda flag FALSE para user
                .$this->nome."','"
                .$this->descricao."')");
                 
            
        }
        
        
        $conexao1->closeConexao();
    }
    
    
    public function excluirAto($id_ato){
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
         pg_exec($conexao, "delete 
                                from ato
                                     where id_ato=".$id_ato);

        $conexao1->closeConexao();
        
    }
    
    public function getAtoID($id_ato){
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();
        
        $query = 'Select * from ato where id_ato ='.$id_ato;
        
        $sql = pg_exec($conexao, $query);
        
        $fetch = pg_fetch_object($sql);
        
        return $fetch;
    }
            
 
    
    
}

?>
