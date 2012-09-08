<?php

include 'CConexao.php';

class CProcesso_ato {
    
    protected $id_processo;
    protected $id_ato;
    protected $data_atualizacao;
    
    function CProcesso_ato(){}
    
    public function incluirProcesso_ato($id_p, $id_a){
        $this->id_processo= $id_p;
        $this->id_ato = $id_a;
        
        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        $query = "SELECT CURRENT_DATE";
        $pesq_data = pg_query($conexao,$query);
        $da = pg_fetch_object($pesq_data);
        $this->data_atualizacao = $da->date;
        
        pg_exec($conexao, "insert into processo_ato(id_processo,id_ato,data_atualizacao)
                         values("
                .$this->id_processo.","
                .$this->id_ato.",'"
                .$this->data_atualizacao."')");      
        
        $conexao1->closeConexao();
    }
    
    
    public function excluirProcesso_ato($id_processo_ato){
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
         pg_exec($conexao, "delete 
                                from processo_ato
                                     where id_processo_ato=".$id_processo_ato);

        $conexao1->closeConexao();
        
    }
            
 
    
    
}

?>
