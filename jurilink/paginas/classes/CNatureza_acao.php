<?php

include 'CConexao.php';

class CNatureza_acao {

    protected $nome;

    function CNatureza_acao() {
        
    }

    public function incluirNatureza_acao($n) {
        $this->nome = $n;

        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "insert into natureza_acao(nome)
                         values('"
                . $this->nome . "')");

        $conexao1->closeConexao();
    }

    public function excluirNatureza_acao($id_natureza_acao) {
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "delete 
                                from natureza_acao
                                     where id_natureza_acao=" . $id_natureza_acao);

        $conexao1->closeConexao();
    }

}

?>
