<?php

include 'CConexao.php';

class CComarca {

    protected $id_comarca;
    protected $nome;

    function CComarca() {
        
    }

    public function editarComarca($nome,$id_comarca){
        $this->id_comarca = $id_comarca;
        $this->nome = $nome;
        
        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        
        pg_query($conexao, "UPDATE comarca SET nome = '".$this->nome."' WHERE id_comarca = '".$this->id_comarca."'");
                
        $conexao1->closeConexao();
        
        
    }
    public function incluirComarca($n) {
        $this->nome = $n;

        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "insert into comarca(nome)
                         values('"
                . $this->nome . "')");

        $conexao1->closeConexao();
    }

    public function excluirComarca($id_comarca) {
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "delete 
                                from comarca
                                     where id_comarca=" . $id_comarca);

        $conexao1->closeConexao();
    }
    
    public function getRelacaoComarca(){
        $conexao1 = new CConexao();
        
        $conexao = $conexao1->novaConexao();
        $query ="SELECT * FROM comarca order by nome";
        $resultado = pg_query($conexao,$query);
        return $resultado;
    }

}

?>
