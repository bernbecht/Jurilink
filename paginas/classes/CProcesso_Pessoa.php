CPROCESSO_PESSOA
<?php

class CProcesso_Pessoa {
    
    protected $id_processo;
    protected $id_pessoa;
    protected $flag_papel;

   
    
    public function incluirAutor($conexao1,$processo,$pessoa,$flag){
        
        $this->id_pessoa= $pessoa;
        $this->id_processo=$processo;
        $this->flag_papel=$flag;
        $incluir = null;
        
        //$conexao1 = new CConexao();

        //$conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao1, "insert into autor(id_pessoa,id_processo,flag_papel)
                         values(                
                    {$this->id_pessoa},
                    {$this->id_processo},
                    {$this->flag_papel})");

        //$conexao1->closeConexao();
        
        return $incluir;
    }
    
    
    public function incluirReu($conexao1,$processo,$pessoa,$flag){
        
        $this->id_pessoa= $pessoa;
        $this->id_processo=$processo;
        $this->flag_papel=$flag;
        $incluir = null;
        
        //$conexao1 = new CConexao();

        //$conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao1, "insert into reu(id_pessoa,id_processo,flag_papel)
                         values(
                    {$this->id_pessoa},
                    {$this->id_processo},
                    {$this->flag_papel})");

        //$conexao1->closeConexao();
        
        return $incluir;
    }
    
    
}

?>
