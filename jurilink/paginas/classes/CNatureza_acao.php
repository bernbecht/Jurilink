<?php

include 'CConexao.php';

class CNatureza_acao {

    protected $nome;
    protected $id_natureza;
            
    function CNatureza_acao() {
        
    }

    public function editarNatureza($nome, $id_natureza) {
        $this->id_natureza = $id_natureza;
        $this->nome = $nome;

        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();

        pg_query($conexao, "UPDATE natureza_acao SET nome = '" . $this->nome . "' WHERE id_natureza_acao = '" . $this->id_natureza . "'");

        $conexao1->closeConexao();
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

    public function getRelacaoNatureza() {
        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        $query = "SELECT * FROM natureza_acao order by nome";
        $resultado = pg_query($conexao, $query);
        return $resultado;
    }

}

?>
