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

        pg_query($conexao, "UPDATE fisica SET rg = '000000000' WHERE fisica.id_pessoa = " . $this->id_pessoa . " ");

        $query = "UPDATE fisica SET cpf = '" . $this->cpf . "', rg = '" . $this->rg . "',
            orgao_expedidor = '" . $this->orgao_expedidor . "' WHERE fisica.id_pessoa = " . $this->id_pessoa . " ";

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

    //retorna FISICA passando CPF ou RG
    //$n é o CPF/RG e o $t é o tipo da pessoa (física ou advogado)
    //Usado no filtro de PESSOAS (tipo2 pq tô com medo de ferrar com outra função)
    public function getFisicaCpfRGTipo2($n, $t) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        switch ($t) {
            case 0:

                $sql = pg_exec($conexao, "select *, uf.nome as estado, pessoa.nome as nome  
            from ((fisica 
            INNER JOIN pessoa 
            ON fisica.id_pessoa = pessoa.id_pessoa 
            and (CAST ( fisica.rg AS TEXT) like '{$n}%' 
            or CAST ( fisica.cpf AS TEXT) like '{$n}%') 
            and pessoa.tipo = 0)
            INNER JOIN uf
            ON pessoa.id_uf = uf.id_uf)
          ");
                break;

            case 2:
                
                $sql = pg_exec($conexao, "select *, uf.nome as estado, pessoa.nome as nome  
            from (((fisica 
            INNER JOIN pessoa 
            ON fisica.id_pessoa = pessoa.id_pessoa 
            and (CAST ( fisica.rg AS TEXT) like '{$n}%' 
            or CAST ( fisica.cpf AS TEXT) like '{$n}%') 
            and pessoa.tipo = 2)
            INNER JOIN uf
            ON pessoa.id_uf = uf.id_uf)
            INNER JOIN advogado
            ON fisica.id_pessoa = advogado.id_pessoa)
          ");
                break;
        }


        $conexao1->closeConexao();

        return $sql;
    }

    //retorna FISICA passando nome
    public function getFisicaPorNome($n) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();


        $sql = pg_exec($conexao, "select *, uf.nome as estado, pessoa.nome as nome  
            from ((fisica 
            INNER JOIN pessoa 
            ON fisica.id_pessoa = pessoa.id_pessoa 
            and pessoa.nome ~* '{$n}'             
            and pessoa.tipo = 0)
            INNER JOIN uf
            ON pessoa.id_uf = uf.id_uf)
          ");

        $conexao1->closeConexao();

        return $sql;
    }

    /* Retorna os processos com a advocacia passando o id */

    public function getProcessosFisicaComAdvocacia($id_pessoa) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        /* Query para pegar processos com a advocacia */
        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from ((((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = $id_pessoa and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = TRUE)
            UNION
            SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join reu on processo.id_processo = reu.id_processo and reu.id_pessoa = $id_pessoa and reu.flag_papel = 0)
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
            inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = TRUE
            order by data_distribuicao desc limit 3";

        $pesq_proc_advocacia = pg_query($conexao, $query);

        return $pesq_proc_advocacia;
    }

    /* Retorna os processos com a advocacia passando o id */

    public function getProcessosFisicaContraAdvocacia($id_pessoa) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        /* Query para pegar processos contra a advocacia */
        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = $id_pessoa and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = FALSE
            UNION
            SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from(((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join reu on processo.id_processo = reu.id_processo and reu.id_pessoa = $id_pessoa and reu.flag_papel = 0)
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
            inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = FALSE
            order by data_distribuicao desc limit 3";

        $pesq_proc_advocacia = pg_query($conexao, $query);

        return $pesq_proc_advocacia;
    }

    public function getProcessosFisicaComAdvocaciaTotal($id_pessoa) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        /* Query para pegar processos com a advocacia */
        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from ((((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = $id_pessoa and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = TRUE)
            UNION
            SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join reu on processo.id_processo = reu.id_processo and reu.id_pessoa = $id_pessoa and reu.flag_papel = 0)
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
            inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = TRUE
            order by data_distribuicao desc";

        $pesq_proc_advocacia = pg_query($conexao, $query);

        return $pesq_proc_advocacia;
    }

    /* Retorna os processos com a advocacia passando o id */

    public function getProcessosFisicaContraTotal($id_pessoa) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        /* Query para pegar processos contra a advocacia */
        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = $id_pessoa and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = FALSE
            UNION
            SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from(((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join reu on processo.id_processo = reu.id_processo and reu.id_pessoa = $id_pessoa and reu.flag_papel = 0)
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
            inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = FALSE
            order by data_distribuicao desc";

        $pesq_proc_advocacia = pg_query($conexao, $query);

        return $pesq_proc_advocacia;
    }

}

?>
