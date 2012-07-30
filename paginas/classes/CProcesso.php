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

    function CProcesso() {
        
    }

    public function incluirProcesso($conexao1,$tej, $dd, $dj, $nu, $ap, $vc, $id_n, $id_j) {
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
        $incluir=pg_exec($conexao1, "insert into processo(transito_em_julgado,data_distribuicao,deposito_judicial,numero_unificado,auto_penhora,valor_causa,id_natureza_acao,id_juizo)
                  values("
                . $this->transito_em_julgado . ",'" /* Não colocamos as aspas pq o campo pode ser nulo, mesmo sendo date */
                . $this->data_distribuicao . "',"
                . $this->deposito_judicial . ",'"
                . $this->numero_unificado . "',"
                . $this->auto_penhora . ","
                . $this->valor_causa . ",'"
                . $this->id_natureza . "','"
                . $this->id_juizo . "')");

        //$conexao1->closeConexao();
        
        return $incluir;
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

    public function getIDProcessoNum($conexao1,$num) {
       // $conexao1 = new CConexao();
       // $conexao = $conexao1->novaConexao();

        $sql = pg_exec($conexao1, "select id_processo from processo where numero_unificado = " . $num . " ");
        $resultado = pg_fetch_object($sql);

        //$conexao1->closeConexao();

        return $resultado->id_processo;
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
        $str = number_format($str, 2, '.', ' ');

        return (float) $str;
    }

    /* Valida a Data */
    function ValidaData($dat) {
        $padrao_data = "^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$^";
        
        return preg_match($padrao_data, $dat);
        
    }
    
    //Valida se é um float com duas casas decimais usando expressão regular
    function validaFloat($num){
        $float = "^([0-9]*\,[0-9]*)$^";
        return preg_match($float, $num);
    }

}

?>
