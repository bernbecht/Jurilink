<?php

require_once 'CConexao.php';

class CAdvogado {

    protected $id_pessoa;
    protected $oab;
    protected $flag;

    public function editarAdvogado($conexao, $id_pessoa, $oab, $flag) {
        $this->id_pessoa = $id_pessoa;
        $this->oab = $oab;
        $this->flag = $flag;

        $query = "UPDATE advogado SET oab = '" . $this->oab . "', 
            flag_func = {$this->flag}
            WHERE id_pessoa = {$this->id_pessoa}";

        $editar = pg_query($conexao, $query);

        return $editar;
    }

    public function incluirAdvogado($conexao, $id, $o, $f) {
        $this->id_pessoa = $id;
        $this->oab = $o;
        $this->flag = $f;
        $incluir = null;


        //$conexao1 = new CConexao();
        //$conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao, "insert into advogado(id_pessoa,oab,flag_func)
                         values('"
                . $this->id_pessoa . "','"
                . $this->oab . "',"
                . $this->flag . ")");

        //$conexao1->closeConexao();

        return $incluir;
    }

    public function getIDOab($oab) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $sql = pg_exec($conexao, "select *  
            from advogado
            INNER JOIN pessoa 
            ON advogado.id_pessoa = pessoa.id_pessoa 
            and CAST (advogado.oab AS TEXT) like '{$oab}%'            
            ");

        $conexao1->closeConexao();

        return $sql;
    }

    public function getProcessosAdvogado($id_pessoa) {


        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.id_pessoa = $id_pessoa
            UNION
            SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from(((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel = 0)
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
            inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa  and advogado.id_pessoa = $id_pessoa
            order by data_distribuicao desc limit 4";

        $pesq_proc_advocacia = pg_query($conexao, $query);

        return $pesq_proc_advocacia;
    }

    public function getProcessosAdvogadoTotal($id_pessoa) {


        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.id_pessoa = $id_pessoa
            UNION
            SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from(((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel = 0)
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
            inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa  and advogado.id_pessoa = $id_pessoa
            order by data_distribuicao desc ";

        $pesq_proc_advocacia = pg_query($conexao, $query);

        return $pesq_proc_advocacia;
    }

    public function getProcessosAdvogadoLimite($id_pessoa) {


        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $query = "SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from (((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor autor1 on processo.id_processo = autor1.id_processo and autor1.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor1.id_pessoa)
            inner join autor advautor on advautor.flag_papel = 1 and advautor.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advautor.id_pessoa)
            inner join reu on reu.id_processo = processo.id_processo and reu.flag_papel = 0) 
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa and advogado.id_pessoa = $id_pessoa
            UNION
            SELECT processo.id_processo, processo.numero_unificado, pautor.nome as nome_autor, preu.nome as nome_reu, padv.nome as nome_adv, 
            natureza_acao.nome as nome_natureza, to_char(data_distribuicao, 'DD/MM/YYYY') as data_distribuicao, 
            to_char(processo.valor_causa, 'R$999G999G999D99') as valor_causa, padv.id_pessoa as id_advogado
            from(((((((processo
            inner join natureza_acao on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel = 0)
            inner join pessoa preu on preu.id_pessoa = reu.id_pessoa)
            inner join reu advreu on advreu.flag_papel = 1 and advreu.id_processo = processo.id_processo)
            inner join pessoa padv on padv.id_pessoa = advreu.id_pessoa)
            inner join autor on autor.id_processo = processo.id_processo and autor.flag_papel = 0)
            inner join pessoa pautor on pautor.id_pessoa = autor.id_pessoa)
            inner join advogado on padv.id_pessoa = advogado.id_pessoa  and advogado.id_pessoa = $id_pessoa
            order by data_distribuicao desc limit 5 ";

        $pesq_proc_advocacia = pg_exec($conexao, $query);


        return $pesq_proc_advocacia;
    }

    public function oi() {
        return "oi";
    }

    //usado para filtro de advogados em Relação Advogados
    //passa o começo oab e retorna o advogado
    public function getAdvogadoOabFiltro($n) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();


        $sql = pg_exec($conexao, "select *, uf.nome as estado, pessoa.nome as nome  
            from (((fisica 
            INNER JOIN pessoa 
            ON fisica.id_pessoa = pessoa.id_pessoa             
            and pessoa.tipo = 2)
            INNER JOIN uf
            ON pessoa.id_uf = uf.id_uf)
            INNER JOIN advogado
            ON CAST ( advogado.oab AS TEXT) like '{$n}%'
            and  pessoa.id_pessoa = advogado.id_pessoa )
          ");

        $conexao1->closeConexao();

        return $sql;
    }

    //passa o começo do nome e pega o advogado
    public function getAdvogadoPassaNome($n) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();


        $sql = pg_exec($conexao, "select *, uf.nome as estado, pessoa.nome as nome 
from (((fisica 
INNER JOIN pessoa 
ON fisica.id_pessoa = pessoa.id_pessoa 
and pessoa.nome ~* '{$n}' 
and pessoa.tipo = 2)
INNER JOIN uf
ON pessoa.id_uf = uf.id_uf)
INNER JOIN advogado
ON fisica.id_pessoa = advogado.id_pessoa) ");

        $conexao1->closeConexao();

        return $sql;
    }

}

?>
