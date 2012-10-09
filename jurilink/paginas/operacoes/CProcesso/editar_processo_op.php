<?php

ini_set('display_errors', 0);
include '../../classes/CPessoa.php';
include '../../classes/CProcesso.php';
include '../../classes/CProcesso_Pessoa.php';
include '../../config.php';
require_once "../../classes/CConexao.php";

$conexao = new CConexao();
$conexao1 = $conexao->novaConexao();


function mandarBD($conexao1, $editar, $db_error) {
    if ($editar) {
        pg_query($conexao1, "commit");
        echo "1";
    } else {
        pg_query($conexao1, "rollback");
        pg_close($conexao1);
        echo $db_error;
    }    
    exit();
}
$id_processo = $_POST['id_processo'];
$tej = $_POST['transito_em_julgado']; //pode ser nulo
$dd = $_POST['data_distribuicao'];
$dj = $_POST['deposito_judicial']; //pode ser nulo
$nu = $_POST['numero_unificado'];
$ap = $_POST['auto_penhora']; //pode ser nulo
$vc = $_POST['valor_causa'];
$id_n = $_POST['id_natureza'];
$id_j = $_POST['id_juizo'];
$autor = $_POST['autor'];
$autor_ad = $_POST['autor_advogado'];
$reu = $_POST['reu'];
$reu_ad = $_POST['reu_advogado'];
$autor_rep = $_POST['autor_rep'];
$reu_rep = $_POST['reu_rep'];
$erro = "";

$processo = new CProcesso();
$pessoa = new CPessoa();
$processo_pessoa = new CProcesso_Pessoa();


// Verificação do tamanho do número unificado. CAMPO OBRIGATÓRIO
if (strlen($nu) != 21) {
    $erro.= " número unificado invalido";
} else if (!is_numeric($nu)) {
    $erro.= " numero unificado contem soh numeros";
}

//Validação da data de distribuição. CAMPO OBRIGATÓRIO
if (!$processo->ValidaData($dd)) {

    $erro.= " data de ditribuicao errada";
}

//Valida valor da causa e transforma em um float apropriado de 2 casas decimais. CAMPO OBRIGATÓRIO
if (!$processo->validaFloat($vc)) {
    $erro.= " valor causa errado";
} else {
    $vc = $processo->str2num($vc);
    //echo $vc;
}


//Verifica se natureza não é nula. CAMPO OBRIGATÓRIO
if ($id_n == -1) {
    $erro.= " Escolher uma natureza";
}

//Verifica se juízo não é nulo. CAMPO OBRIGATÓRIO
if ($id_j == -1) {
    $erro.= " Escolher um juizo";
}

//verifica, se informado, se o transito em julgado é data
if ($tej != "") {
    if (!$processo->ValidaData($tej)) {

        $erro.= " transito em julgado errado";
    }
}

//se auto da penhora for informado, vê se ele está certo e transforma a , e .
if ($ap != "") {
    if (!$processo->validaFloat($ap)) {
        $erro.= " auto da penhora errado";
    } else {
        $ap = $processo->str2num($ap);
    }
}

//se depósito for informado, vê se ele está certo e transforma a , e .
if ($dj != "") {
    if (!$processo->validaFloat($dj)) {
        $erro.= " deposito errado";
    } else {
        $dj = $processo->str2num($dj);
    }
}

if (strlen($autor) <= 1) {
    $erro.=" informe um autor válido";
}
if (strlen($reu) <= 1) {
    $erro.=" informe um réu válido";
}

if (strlen($autor_ad) <= 1) {
    $erro.=" informe um advogado do autor válido";
}

if (strlen($reu_ad) <= 1) {
    $erro.=" informe um advogado para reu válido";
}

if (strlen($autor_rep) > 0) {
    //echo $autor_rep;
    if (is_numeric($autor_rep))
        $erro.=" Representante do autor nao pode ser soh numeros";
}

if (strlen($reu_rep) > 0) {
    //echo $reu_rep;
    if (is_numeric($reu_rep))
        $erro.=" Representante do reu nao pode ser soh numeros";
}

if ($erro != '') {
    echo $erro;
} else {

    //variável que vai nos dizer se foi incluído ou não
    $incluir = null;

    //procedimento para ROLLBACK
    pg_query($conexao1, "begin");

    $incluir = $processo->editarProcesso($conexao1, $id_processo,$tej, $dd, $dj, $nu, $ap, $vc, $id_n, $id_j);
    if (!$incluir) {
        $db_error = pg_last_error($conexao1);
    } else {
        
        //Pegando IDs dos autores
        $id = $pessoa->getIDPessoaNome($conexao1, $autor);
        if ($id == -1) {
            $db_error = "ERRADO AUTOR";
            $incluir = false;
            mandarBD($conexao1, $incluir, $db_error);
        }

        //Inclui o autor
        if ($id != -1) {
            $i = 0;
            $n = count($id);
            $processo_pessoa->excluirParte($conexao1,$id_processo,0,0);
            while ($i < $n) {
                $incluir = $processo_pessoa->incluirAutor($conexao1, $id_processo, $id[$i], 0);
                $i++;
                if (!$incluir) {
                    //$db_error.=" ".pg_last_error($conexao1);
                }
            }
        } else {
            $incluir = null;
        }


        //Pegando IDs dos réus
        $id = $pessoa->getIDPessoaNome($conexao1, $reu);
        if ($id == -1) {
            $db_error = "ERRADO REU";
            $incluir = false;
            mandarBD($conexao1, $incluir, $db_error);
        }

        //Inclui os réus
        if ($id != -1) {
            $i = 0;
            $n = count($id);
            $processo_pessoa->excluirParte($conexao1,$id_processo,0,1);
            while ($i < $n) {
                $incluir = $processo_pessoa->incluirReu($conexao1, $id_processo, $id[$i], 0);
                $i++;
            }
        } else {
            $incluir = null;
        }

        //Pegando IDs dos advogados autores
        $id = $pessoa->getIDPessoaNome($conexao1, $autor_ad);
        if ($id == -1) {
            $db_error = "ERRADO ADVOGADO AUTOR";
            $incluir = false;
            mandarBD($conexao1, $incluir, $db_error);
        }

        //Inclui o advogado do autor
        if ($id != -1) {
            $i = 0;
            $n = count($id);
            $processo_pessoa->excluirParte($conexao1,$id_processo,1,0);
            while ($i < $n) {
                $incluir = $processo_pessoa->incluirAutor($conexao1, $id_processo, $id[$i], 1);
                $i++;
            }
        } else {
            $incluir = null;
        }

        //Pegando IDs dos advogados réu
        $id = $pessoa->getIDPessoaNome($conexao1, $reu_ad);
        if ($id == -1) {
            $db_error = "ERRADO ADVOGADO REU";
            $incluir = false;
            mandarBD($conexao1, $incluir, $db_error);
        }


        //Inclui o advogado réu 
        if ($id != -1) {
            $i = 0;
            $n = count($id);
            $processo_pessoa->excluirParte($conexao1,$id_processo,1,1);
            while ($i < $n) {
                $incluir = $processo_pessoa->incluirReu($conexao1, $id_processo, $id[$i], 1);
                $i++;
            }
        } else {
            $incluir = null;
        }

        if (strlen($autor_rep) > 0) {
            //Pegando IDs dos representantes autor
            $id = $pessoa->getIDPessoaNome($conexao1, $autor_rep);
            if ($id == -1) {
                $db_error = "ERRADO REPRESENTANTE AUTOR";
                $incluir = false;
                mandarBD($conexao1, $incluir, $db_error);
            }

            //Inclui os representantes do autor
            if ($id != -1) {
                $i = 0;
                $n = count($id);
                $processo_pessoa->excluirParte($conexao1,$id_processo,2,0);
                while ($i < $n) {
                    $incluir = $processo_pessoa->incluirAutor($conexao1, $id_processo, $id[$i], 2);
                    $i++;
                }
            } else {
                $incluir = null;
            }
        }

        if (strlen($reu_rep) > 0) {
            //Pegando IDs dos representantes autor
            $id = $pessoa->getIDPessoaNome($conexao1, $reu_rep);
            if ($id == -1) {
                $db_error = "ERRADO REPRESENTANTE REU";
                $incluir = false;
                mandarBD($conexao1, $incluir, $db_error);
            }

            //Inclui os representantes do réu
            if ($id != -1) {
                $i = 0;
                $n = count($id);
                $processo_pessoa->excluirParte($conexao1,$id_processo,2,1);
                while ($i < $n) {
                    $incluir = $processo_pessoa->incluirReu($conexao1, $id_processo, $id[$i], 2);
                    $i++;
                }
            } else {
                $incluir = null;
            }
        }
    }
    
    if ($incluir) {
        pg_query($conexao1, "commit");
        echo "1";
    } else {
        pg_query($conexao1, "rollback");
        pg_close($conexao1);
        echo $db_error;
    }
}
?>