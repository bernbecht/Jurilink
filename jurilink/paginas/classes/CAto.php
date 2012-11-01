<?php

require_once 'CConexao.php';

class CAto {

    protected $nome;
    protected $previsao;
    protected $flag_cliente;
    protected $descricao;
    protected $id_ato;

    function CAto() {
        
    }

    public function editarAto($nome, $id_ato, $desc, $previsao, $flag_cliente) {
        $this->id_ato = $id_ato;
        $this->nome = $nome;
        $this->previsao = $previsao;
        $this->descricao = $desc;
        $this->flag_cliente = $flag_cliente;

        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();

        pg_query($conexao, "UPDATE ato SET 
            nome = '" . $this->nome . "', 
            descricao = '" . $this->descricao . "', 
                flag_cliente = '" . $this->flag_cliente . "', 
                    previsao = '" . $this->previsao . "'
                        WHERE id_ato = '" . $this->id_ato . "'");

        $conexao1->closeConexao();
    }

    public function incluirAto($n, $p, $f, $d) {
        $this->nome = $n;
        $this->previsao = $p;
        $this->flag_cliente = $f;
        $this->descricao = $d;

        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        if ($this->flag_cliente == 1) {
            pg_exec($conexao, "insert into ato(previsao,flag_cliente,nome,descricao)
                         values(
                 '" . $this->previsao . "','"
                    . $this->flag_cliente . "','"
                    . $this->nome . "','"
                    . $this->descricao . "')");
        } else {
            pg_exec($conexao, "insert into ato(previsao,flag_cliente,nome,descricao)
                         values('"
                    . $this->previsao . "',
                 '0','"     //Manda flag FALSE para user
                    . $this->nome . "','"
                    . $this->descricao . "')");
        }


        $conexao1->closeConexao();
    }

    public function excluirAto($id_ato) {
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "delete 
                                from ato
                                     where id_ato=" . $id_ato);

        $conexao1->closeConexao();
    }

    public function getAtoID($id_ato) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $query = 'Select * from ato where id_ato =' . $id_ato;

        $sql = pg_exec($conexao, $query);

        $fetch = pg_fetch_object($sql);

        return $fetch;
    }

    public function getRelacaoAto() {
        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        $query = "SELECT * FROM ato order by nome";
        $resultado = pg_query($conexao, $query);
        return $resultado;
    }

}

?>
