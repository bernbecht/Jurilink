<?php

require_once 'CConexao.php';

class CAudiencia {

    protected $data;
    protected $local;
    protected $tipo;
    protected $id_processo;

    function CAudiencia() {
        
    }

    public function incluirAudiencia($data_audiencia, $local, $tipo, $id_processo) {
        $this->data = $data_audiencia;
        $this->local = $local;
        $this->tipo = $tipo;
        $this->id_processo = $id_processo;

        $query = "insert into audiencia(data,local,tipo,id_processo)
                         values('"
                . $this->data . "','"
                . $this->local . "','"
                . $this->tipo . "',"
                . $this->id_processo . ")";

        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();
        $sql = pg_query($conexao, $query);
        $conexao1->closeConexao();
        return $sql; 
       
    }

    function getAudiencia($id_processo,$limite) {
        
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();

        $query = "SELECT data, local, tipo, id_audiencia, id_processo from audiencia where audiencia.id_processo = $id_processo order by data desc limit $limite";
        $pesq_audiencias = pg_query($conexao1, $query);
        return $pesq_audiencias;        
        
    }
    
    //lista todas as audiencias da advocacia ordenada por data ascendente
    function getTodasAudiencias($limite) {
        
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();

        $query = "SELECT data, local, tipo, audiencia.id_processo, numero_unificado 
        from audiencia
        inner join processo
        on audiencia.id_processo = processo.id_processo
        order by data desc limit $limite";
        $pesq_audiencias = pg_query($conexao1, $query);
        return $pesq_audiencias;        
        
    }
    
    //lista todas próximas audiencias da advocacia ordenada por data ascendente
    function getProximasAudiencias($limite, $hoje) {
        
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();

        $query = "SELECT data, local, tipo, audiencia.id_processo, numero_unificado 
        from audiencia
        inner join processo
        on audiencia.id_processo = processo.id_processo
        and data >= '$hoje'
        order by data asc limit $limite";
        $pesq_audiencias = pg_query($conexao1, $query);
        return $pesq_audiencias;        
        
    }
    
    
     public function excluirAudiencia($id_audiencia) {
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "delete 
                          from audiencia
                          where id_audiencia=". $id_audiencia);

        $conexao1->closeConexao();
    }

}

?>
