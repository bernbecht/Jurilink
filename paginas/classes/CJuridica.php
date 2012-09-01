<?php

include_once 'CConexao.php';

class CJuridica {

    protected $id_pessoa;
    protected $cnpj;

    public function incluirJuridica($conexao, $cod_pessoa, $c) {

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

    public function getProcessosJuridicaComAdvocacia($id_pessoa) {

        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = $id_pessoa and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = TRUE
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
    
     public function getProcessosJuridicaContraAdvocacia($id_pessoa) {

        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

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
    
     public function getProcessosJuridicaComAdvocaciaTotal($id_pessoa) {

        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.id_pessoa = $id_pessoa and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.flag_func = TRUE
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
    
    public function getProcessosJuridicaContraAdvocaciaTotal($id_pessoa) {

        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

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
