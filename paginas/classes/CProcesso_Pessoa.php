<?php

class CProcesso_Pessoa {
    
    protected $id_processo;
    protected $id_pessoa;
    protected $flag_papel;

   
    public function editarReu($conexao,$id_processo,$pessoa,$flag){
        $this->id_processo = $id_processo;
        $this->id_pessoa = $pessoa;
        $this->flag_papel = $flag;
        $editar = null;
        
        $query = "SELECT COUNT (*) FROM reu WHERE reu.id_pessoa = $this->id_pessoa and reu.flag_papel = $this->flag_papel and reu.id_processo = $this->id_processo";
        $pesq_cont = pg_query($conexao,$query);
        $cont = pg_fetch_object($pesq_cont);
        
        if($cont->count == 1){
            $query = "UPDATE reu SET id_pessoa = '".$this->id_pessoa."' WHERE reu.id_processo = $this->id_processo and reu.flag_papel = $this->flag_papel";
        }
        else {
            $query = "insert into reu(id_pessoa,id_processo,flag_papel)
                         values(                
                    {$this->id_pessoa},
                    {$this->id_processo},
                    {$this->flag_papel})";
        }
        $editar = pg_query($conexao,$query);
        return $editar;
        
    }
    
    public function editarAutor($conexao,$id_processo,$pessoa,$flag){
        $this->id_processo = $id_processo;
        $this->id_pessoa = $pessoa;
        $this->flag_papel = $flag;
        $editar = null;
        
        $query = "SELECT COUNT (*) FROM autor WHERE autor.id_pessoa = $this->id_pessoa and autor.flag_papel = $this->flag_papel and autor.id_processo = $this->id_processo";
        $pesq_cont = pg_query($conexao,$query);
        $cont = pg_fetch_object($pesq_cont);
        
        if($cont->count){
            $query = "UPDATE autor SET id_pessoa = '".$this->id_pessoa."' WHERE autor.id_processo = $this->id_processo and autor.flag_papel = $this->flag_papel";
         }
        else {
            $query = "insert into autor(id_pessoa,id_processo,flag_papel)
                         values(                
                    {$this->id_pessoa},
                    {$this->id_processo},
                    {$this->flag_papel})";
        }
        $editar = pg_query($conexao,$query);
        return $editar;
        
    }
    
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
