<?php

include 'CConexao.php';

class CProcesso_ato {

    protected $id_processo;
    protected $id_ato;
    protected $data_atualizacao;

    function CProcesso_ato() {
        
    }

    public function incluirProcesso_ato($id_p, $id_a) {
        $this->id_processo = $id_p;
        $this->id_ato = $id_a;

        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        $query = "SELECT CURRENT_DATE";
        $pesq_data = pg_query($conexao, $query);
        $da = pg_fetch_object($pesq_data);
        $this->data_atualizacao = $da->date;

        pg_exec($conexao, "insert into processo_ato(id_processo,id_ato,data_atualizacao)
                         values("
                . $this->id_processo . ","
                . $this->id_ato . ",'"
                . $this->data_atualizacao . "')");

        $conexao1->closeConexao();
    }

    public function excluirProcesso_ato($id_processo_ato) {
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "delete 
                                from processo_ato
                                     where id_processo_ato=" . $id_processo_ato);

        $conexao1->closeConexao();
    }

    function getProcesso_Ato($id_processo,$limite) {
            
        $conexao = new CConexao();


        $conexao1 = $conexao->novaConexao();

        $query = "SELECT to_char(data_atualizacao,'dd/mm/yyyy') as data_atualizacao, nome, previsao, descricao,flag_cliente from processo_ato inner join ato on
        processo_ato.id_processo = $id_processo and processo_ato.id_ato = ato.id_ato order by data_atualizacao desc limit $limite";
        
        $pesq_ato_proc = pg_query($conexao1, $query);
        
        return($pesq_ato_proc);
        
    }

}

?>
