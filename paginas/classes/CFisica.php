<?php

include_once 'CConexao.php';

class CFisica {

    protected $id_pessoa;
    protected $cpf;
    protected $rg;
    protected $orgao_expedidor;

    
    public function editarFisica($conexao, $id_pessoa, $c, $r, $oe) {
        $this->id_pessoa = $id_pessoa;
        $this->cpf = $c;
        $this->rg = $r;
        $this->orgao_expedidor = $oe;
        
        pg_query($conexao,"UPDATE fisica SET rg = '000000000' WHERE fisica.id_pessoa = ".$this->id_pessoa." ");
        
        $query = "UPDATE fisica SET cpf = '".$this->cpf."', rg = '".$this->rg."',
            orgao_expedidor = '".$this->orgao_expedidor."' WHERE fisica.id_pessoa = ".$this->id_pessoa." ";

        $editar = pg_query($conexao, $query);
        
        return $editar;
        
    }
     
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
    //Usado no AUTOCOMPLETE DA PÁGINA DE PROCESSO
    public function getFisicaCpfRG($n) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();


        $sql = pg_exec($conexao, "select *  
            from fisica 
            INNER JOIN pessoa 
            ON fisica.id_pessoa = pessoa.id_pessoa 
            and (CAST ( fisica.rg AS TEXT) like '{$n}%' 
            or CAST ( fisica.cpf AS TEXT) like '{$n}%') 
            ");

        $conexao1->closeConexao();

        return $sql;
    }

    //retorna FISICA passando CPF ou RG
    //$n é o CPF/RG e o $t é o tipo da pessoa (física ou advogado)
    //Usado no AUTOCOMPLETE DA PÁGINA DE PROCESSO
    public function getFisicaCpfRGTipo($n, $t) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();


        $sql = pg_exec($conexao, "select *  
            from fisica 
            INNER JOIN pessoa 
            ON fisica.id_pessoa = pessoa.id_pessoa 
            and (CAST ( fisica.rg AS TEXT) like '{$n}%' 
            or CAST ( fisica.cpf AS TEXT) like '{$n}%') 
            and pessoa.tipo = {$t}
          ");

        $conexao1->closeConexao();

        return $sql;
    }

}

?>
