<?php

include 'CConexao.php';

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
        pg_query($conexao, $query);
        $conexao1->closeConexao();
    }

    function getAudiencia($id_processo,$limite) {
        
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();

        $query = "SELECT to_char(data,'dd/mm/yyyy') as data, local, tipo, id_audiencia from audiencia where audiencia.id_processo = $id_processo order by id_audiencia desc limit $limite";
        $pesq_audiencias = pg_query($conexao1, $query);
        return $pesq_audiencias;
        
        
    }

}

?>
