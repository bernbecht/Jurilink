<?php

include 'CConexao.php';

class CJuizo {

    protected $nome;
    protected $id_comarca;

    function CJuizo() {
        
    }

    public function incluirJuizo($n, $id_c) {
        $this->nome = $n;
        $this->id_comarca = $id_c;


        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "insert into juizo(nome,id_comarca)
                         values('"
                . $this->nome . "','"
                . $this->id_comarca . "')");

        $conexao1->closeConexao();
    }

    public function excluirJuizo($id_juizo) {
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "delete 
                                from juizo
                                     where id_juizo=" . $id_juizo);

        $conexao1->closeConexao();
    }

    public function getRelacaoJuizo() {
        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();

        $query = "select juizo.nome as nome, comarca.nome as comarca from juizo inner join 
            comarca on comarca.id_comarca = juizo.id_comarca order by nome";
        $resultado = pg_query($conexao, $query);
        return $resultado;
    }

}

?>
