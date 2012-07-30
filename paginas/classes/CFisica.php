<?php

include_once 'CConexao.php';

class CFisica {

    protected $id_pessoa;
    protected $cpf;
    protected $rg;
    protected $orgao_expedidor;

    public function incluirFisica($conexao, $id_pessoa, $c, $r, $oe) {

        $this->id_pessoa = $id_pessoa;
        $this->cpf = $c;
        $this->rg = $r;
        $this->orgao_expedidor = $oe;
        $incluir = null;

        // $conexao1 = new CConexao();
        //  $conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao, "insert into fisica(id_pessoa,cpf, orgao_expedidor,rg)
                         values('"
                . $this->id_pessoa . "', '"
                . $this->cpf . "','"
                . $this->orgao_expedidor . "','"
                . $this->rg . "')");

        // $conexao1->closeConexao();

        return $incluir;
    }

    //retorna FISICA passando CPF ou RG
    public function getFisicaCpfRG($n, $t) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

     
        $sql = pg_exec($conexao, "select *  
            from fisica 
            INNER JOIN pessoa 
            ON fisica.id_pessoa = pessoa.id_pessoa 
            and (CAST ( fisica.rg AS TEXT) like '{$n}_%' 
            or CAST ( fisica.cpf AS TEXT) like '{$n}_%') 
            and pessoa.tipo = {$t}
          ");

        $conexao1->closeConexao();

        return $sql;
    }

}

?>
