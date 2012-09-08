<?php
include 'CConexao.php';

class CAudiencia{
    protected $data;
    protected $local;
    protected $tipo;
    protected $id_processo;
    
    function CAudiencia(){}
    
    public function incluirAudiencia($data_audiencia, $local, $tipo, $id_processo){
        $this->data = $data_audiencia;
        $this->local = $local;
        $this->tipo = $tipo;
        $this->id_processo = $id_processo;
        
          $query = "insert into audiencia(data,local,tipo,id_processo)
                         values('"
                .$this->data."','"
                .$this->local."','"
                .$this->tipo."',"
                .$this->id_processo.")";
        
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();
        pg_query($conexao, $query);
        $conexao1->closeConexao();
    }
    
    
    
    
    
    
}
?>
