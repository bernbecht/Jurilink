<?php

include_once 'CConexao.php';

class CJuridica {

    protected $id_pessoa;
    protected $cnpj;

    public function incluirJuridica($conexao,$cod_pessoa, $c) {

        $this->id_pessoa = $cod_pessoa;
        $this->cnpj = $c;
        $incluir = null;

        //$conexao1 = new CConexao();

       // $conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao, "insert into juridica(id_pessoa,cnpj)
                         values('"
                . $this->id_pessoa . "','"
                . $this->cnpj . "')");

       // $conexao1->closeConexao();
        
        return $incluir;
    }

    //retorna pesquisa em JURIDICA usando CNPJ
    //Usado no AUTOCOMPLETE da página de processo
    public function getJuridicaCNPJ($n) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $sql = pg_exec($conexao, "select * 
          from juridica 
          where CAST ( cnpj AS TEXT) like '{$n}%'          
          ");

        $conexao1->closeConexao();

        return $sql;
    }

}

?>
