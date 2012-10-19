<?php

include_once 'CConexao.php';

class CProcesso {

    protected $transito_em_julgado;
    protected $data_distribuicao;
    protected $deposito_judicial;
    protected $numero_unificado;
    protected $auto_penhora;
    protected $valor_causa;
    protected $id_natureza;
    protected $id_juizo;
    protected $descrição;
    protected $id_processo;

    function CProcesso() {
        
    }

    public function editarProcesso($conexao, $id_processo, $tej, $dd, $dj, $nu, $ap, $vc, $id_n, $id_j) {
        $this->id_processo = $id_processo;
        $this->transito_em_julgado = $tej;
        $this->data_distribuicao = $dd;
        $this->deposito_judicial = $dj;
        $this->numero_unificado = $nu;
        $this->auto_penhora = $ap;
        $this->valor_causa = $vc;
        $this->id_natureza = $id_n;
        $this->id_juizo = $id_j;
        $editar->null;

        //tratamento de DATA NULA
        if ($this->transito_em_julgado == "")
            $this->transito_em_julgado = "NULL";
        else {
            $this->transito_em_julgado = "'" . $this->transito_em_julgado . "'";
        }

        //tratamento de auto da penhora
        if ($this->auto_penhora == "")
            $this->auto_penhora = "NULL";

        //tratamento judicial
        if ($this->deposito_judicial == "")
            $this->deposito_judicial = "NULL";

        //pg_query($conexao,"UPDATE processo SET numero_unificado = '000000000000000000000' WHERE processo.id_processo = $this->id_processo");

        $query = "UPDATE processo SET numero_unificado = '" . $this->numero_unificado . "', transito_em_julgado = " . $this->transito_em_julgado . ",
            data_distribuicao = '" . $this->data_distribuicao . "', deposito_judicial = " . $this->deposito_judicial . ",auto_penhora =" . $this->auto_penhora . ",
            valor_causa = " . $this->valor_causa . ",id_natureza_acao = '" . $this->id_natureza . "',id_juizo = '" . $this->id_juizo . "' WHERE processo.id_processo = $this->id_processo";

        $editar = pg_query($conexao, $query);
        return $editar;
    }

    public function incluirProcesso($conexao1, $tej, $dd, $dj, $nu, $ap, $vc, $id_n, $id_j) {
        $this->transito_em_julgado = $tej;
        $this->data_distribuicao = $dd;
        $this->deposito_judicial = $dj;
        $this->numero_unificado = $nu;
        $this->auto_penhora = $ap;
        $this->valor_causa = $vc;
        $this->id_natureza = $id_n;
        $this->id_juizo = $id_j;
        $incluir = null;


        //tratamento de DATA NULA
        if ($this->transito_em_julgado == "")
            $this->transito_em_julgado = "NULL";
        else {
            $this->transito_em_julgado = "'" . $this->transito_em_julgado . "'";
        }

        //tratamento de auto da penhora
        if ($this->auto_penhora == "")
            $this->auto_penhora = "NULL";

        //tratamento judicial
        if ($this->deposito_judicial == "")
            $this->deposito_judicial = "NULL";

        //$conexao1 = new CConexao();
        //$conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao1, "insert into processo(transito_em_julgado,data_distribuicao,deposito_judicial,numero_unificado,auto_penhora,valor_causa,id_natureza_acao,id_juizo)
                  values("
                . $this->transito_em_julgado . ",'" /* Não colocamos as aspas pq o campo pode ser nulo, mesmo sendo date */
                . $this->data_distribuicao . "',"
                . $this->deposito_judicial . ",'"
                . $this->numero_unificado . "',"
                . $this->auto_penhora . ","
                . $this->valor_causa . ",'"
                . $this->id_natureza . "','"
                . $this->id_juizo . "') RETURNING id_processo");

        $resultado = pg_fetch_object($incluir);

        //$conexao1->closeConexao();

        return $resultado->id_processo;
    }

    public function excluirProcesso($id_processo) {
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "delete 
                                from processo
                                     where id_processo=" . $id_processo);

        $conexao1->closeConexao();
    }

    /* Passa o número e pega o ID do processo */

    public function getIDProcessoNum($conexao1, $num) {
        // $conexao1 = new CConexao();
        // $conexao = $conexao1->novaConexao();

        $sql = pg_exec($conexao1, "select id_processo from processo where numero_unificado = " . $num . " ");
        $resultado = pg_fetch_object($sql);

        //$conexao1->closeConexao();

        return $resultado->id_processo;
    }

    public function getProcesso($id) {
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();

        $sql = pg_exec($conexao1, "select * from processo where id_processo = " . $id . " ");
        $resultado = pg_fetch_object($sql);

        //$conexao1->closeConexao();

        return $resultado;
    }

    //Valida um inteiro
    function ValidaNum($num) {
        if ($num == "") {
            return false;
        } else if (!is_numeric($num)) {
            return false;
        } else {
            return true;
        }
    }

    //Tranforma um ponto flutuante com , em .
    function str2num($str) {

        if (strpos($str, '.') < strpos($str, ',')) {
            $str = str_replace('.', '', $str);
            $str = strtr($str, ',', '.');
        } else {
            $str = str_replace(',', '', $str);
        }

        //Faz com que apenas duas casas decimais sejam consideradas
        $str = number_format($str, 2, '.', '');

        return $str;
    }

    /* Valida a Data */

    function ValidaData($dat) {
        $padrao_data = "^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$^";

        return preg_match($padrao_data, $dat);
    }

    //Valida se é um float com duas casas decimais com ',' usando expressão regular
    function validaFloat($num) {
        $float = "^([0-9]*\,[0-9]*)$^";
        return preg_match($float, $num);
    }

    function getProcessoRelacao($limite, $offset) {
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();



        $query = "select processo.id_processo, numero_unificado, data_distribuicao,
            transito_em_julgado, natureza_acao.nome as nome_natureza,
            pautor.nome as autor, preu.nome as reu
            from (((((processo 
            inner join natureza_acao
            on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
            inner join pessoa preu on reu.id_pessoa = preu.id_pessoa)
            inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa)
            order by data_distribuicao desc limit $limite offset $offset";

        $pesq_processo = pg_exec($conexao1, $query);
        //$resultado = pg_fetch_object($pesq_processo);


        $query = "select processo.id_processo, data_distribuicao as d_indice, numero_unificado,  data_distribuicao,
           transito_em_julgado, natureza_acao.nome as nome_natureza,
            pautor.nome as autor, preu.nome as reu
            from (((((processo 
            inner join natureza_acao
            on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
            inner join pessoa preu on reu.id_pessoa = preu.id_pessoa)
            inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa)
            order by autor";


        $pesq_total = pg_query($conexao1, $query);
        $total = pg_num_rows($pesq_total);

        return array($pesq_processo, $total);
    }
    
    //pega os processos, nomes das partes e detalhes passando o numero unificado
    function getProcessoRelacaoComNumUni($n) {
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();



        $query = "select processo.id_processo, data_distribuicao as d_indice, numero_unificado,  data_distribuicao,
           transito_em_julgado, natureza_acao.nome as nome_natureza,
            pautor.nome as autor, preu.nome as reu
            from (((((processo 
            inner join natureza_acao
            on processo.id_natureza_acao = natureza_acao.id_natureza_acao and CAST (numero_unificado AS TEXT) like '{$n}%' )
            inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
            inner join pessoa preu on reu.id_pessoa = preu.id_pessoa)
            inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa)
            order by data_distribuicao desc";

        $pesq_total = pg_query($conexao1, $query);  

        return $pesq_total;
    }
    
     //pega os processos, nomes das partes e detalhes passando o nome da pessoa
    function getProcessoPessoa($nome) {
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();

        $nome = pg_escape_string($nome);


        $query = "select processo.id_processo, data_distribuicao as d_indice, numero_unificado,  data_distribuicao,
           transito_em_julgado, natureza_acao.nome as nome_natureza,
            pautor.nome as autor, preu.nome as reu
            from (((((processo 
            inner join natureza_acao
            on processo.id_natureza_acao = natureza_acao.id_natureza_acao)
            inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
            inner join pessoa preu on reu.id_pessoa = preu.id_pessoa and preu.nome ~* '{$nome}')
            inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa)
            
            union 

            select processo.id_processo, data_distribuicao as d_indice, numero_unificado,  data_distribuicao,
           transito_em_julgado, natureza_acao.nome as nome_natureza,
            pautor.nome as autor, preu.nome as reu
            from (((((processo 
            inner join natureza_acao
            on processo.id_natureza_acao = natureza_acao.id_natureza_acao )
            inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
            inner join pessoa preu on reu.id_pessoa = preu.id_pessoa)
            inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa  and pautor.nome ~* '{$nome}')
           ";

        $pesq_total = pg_query($conexao1, $query);  

        return $pesq_total;
    }
    
    //pega os processos, nomes das partes e detalhes passando a data
    function getProcessoData($data) {
        $conexao = new CConexao();
        $conexao1 = $conexao->novaConexao();

        $query = "select processo.id_processo, data_distribuicao as d_indice, numero_unificado,  data_distribuicao,
           transito_em_julgado, natureza_acao.nome as nome_natureza,
            pautor.nome as autor, preu.nome as reu
            from (((((processo 
            inner join natureza_acao
            on processo.id_natureza_acao = natureza_acao.id_natureza_acao and processo.data_distribuicao = '{$data}')
            inner join autor on processo.id_processo = autor.id_processo and autor.flag_papel=0)
            inner join reu on processo.id_processo = reu.id_processo and reu.flag_papel=0)
            inner join pessoa preu on reu.id_pessoa = preu.id_pessoa)
            inner join pessoa pautor on autor.id_pessoa = pautor.id_pessoa)
            ";

        $pesq_total = pg_query($conexao1, $query);  

        return $pesq_total;
    }

}

?>
