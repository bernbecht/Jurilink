<?php

ini_set('display_errors', 0);

require_once '../../classes/CPessoa.php';

require_once '../../classes/CJuridica.php';

require_once '../../classes/CFisica.php';

require_once '../../classes/CUsuario.php';

require_once '../../classes/CAdvogado.php';

require_once '../../classes/CConexao.php';

require_once '../../classes/CEmail.php';

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {

    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';
    $caracteres .= $lmin;

    if ($maiusculas)
        $caracteres .= $lmai;

    if ($numeros)
        $caracteres .= $num;

    if ($simbolos)
        $caracteres .= $simb;

    $len = strlen($caracteres);

    for ($n = 1; $n <= $tamanho; $n++) {

        $rand = mt_rand(1, $len);

        $retorno .= $caracteres[$rand - 1];
    }

    return $retorno;
}

$n = $_POST['nome'];
$e = $_POST['endereco'];
$t = $_POST['telefone'];
$em = $_POST['email'];
$c = $_POST['cidade'];
$uf = $_POST['estado'];
$tipo_pessoa = $_POST['tipo']; //0 fisica, 1 juridica, 2 advogado
$user = $_POST['userCheckbox'];
$senha = geraSenha(8, false, true);
$b = $_POST['bairro'];
$comarca = $_POST['comarca'];

//echo $tipo_pessoa;

$erro = "";

if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}

if (strlen($t) == 0) {
    $t = "NULL";
} else {
    if (strlen($t) != 8 && strlen($t) != 10 && strlen($t) != 11) {
        $erro.= "telefone menos que 8";
    }    
}

//se for passado um email ele deve ser pelo menos 7

if (strlen($em) > 0) {
    if (strlen($em) < 7)
        $erro.= "email menos que 7";
}

if (strlen($c) < 2) {
    $erro.= "cidade menos que 2";
}

if ($uf == -1) {
    $erro.= "Selecione um UF";
}

if (strlen($tipo_pessoa) < 1) {
    $erro.= "Tipo de pessoa nao encontrado";
}

//Se for uma pessoa física ou advogado confere o rg cpf
if ($tipo_pessoa == 0 || $tipo_pessoa == 2) {
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];

    if (strlen($cpf) < 11) {
        $erro.= "cpf menos que 11";
    }

    if (strlen($cpf) > 11) {
        $erro.= "cpf  mais que 11";
    }

    if (!is_numeric($cpf)) {
        $erro.= "cpf nao eh numero";
    }

    if (strlen($rg) < 7) {
        $erro.= "rg menos que 7";
    }

    if (strlen($comarca) < 2) {
        $erro.= "comarca menor que 2";
    }


    if (!is_numeric($rg)) {
        $erro.= "rg nao eh numero";
    }
}

//se for uma pessoa jurídica, confere só cnpj
if ($tipo_pessoa == 1) {
    $cnpj = $_POST['cnpj'];

    if (strlen($cnpj) != 14) {
        $erro.= "cnpj menos que 14";
    }

    if (!is_numeric($cnpj)) {
        $erro.= "cnpj nao eh numero";
    }
}

//se for um advogado
if ($tipo_pessoa == 2) {
    $oab = $_POST['oab'];

    if (strlen($oab) < 3) {
        $erro.= "oab menos que 3";
    }

    if (!is_numeric($oab)) {
        $erro.= "oab nao eh numero";
    }
}

//Se for user, confere o tamanho da senha e se foi digitado o email
if ($user == 1) {
    if (strlen($senha) < 7) {
        $erro.= "senha menor que 8";
    }

    if (strlen($em) < 7) {
        $erro.= "email menos que 7";
    }
}

//se os dados estiverem de acordo, prossegue para incluir
if ($erro != "") {
    echo $erro;
} else {

    $conexao1 = new CConexao();

    $conexao = $conexao1->novaConexao();



    //variável que vai nos dizer se foi incluído ou não
    $incluir = null;

    //procedimento para ROLLBACK
    pg_query($conexao, "begin");

    $pessoa = new CPessoa();


    //A funçaõ incluirPessoa retorna o id da pessoa que acaba de ser registrada
    $incluir = $pessoa->incluirPessoa($conexao, $n, $e, $em, $t, $c, $uf, $b, $tipo_pessoa);

    //$id_pessoa = $pessoa->getId($conexao, $em); //pega o id da pessoa com passando o email
    $id_pessoa = $incluir;

    if ($tipo_pessoa == 0) {
        $fisica = new CFisica();
        $incluir = $fisica->incluirFisica($conexao, $id_pessoa, $cpf, $rg, $comarca);
        if (!$incluir) {
            $db_error = pg_last_error($conexao);
        }
    } else if ($tipo_pessoa == 1) {
        $juridica = new CJuridica();
        $incluir = $juridica->incluirJuridica($conexao, $id_pessoa, $cnpj);
        if (!$incluir) {
            $db_error.=" " . pg_last_error($conexao);
        }
    } else if ($tipo_pessoa == 2) {

        if ($user == 1)
            $flag = "true";

        else
            $flag = "false";

        $fisica = new CFisica();
        $incluir = $fisica->incluirFisica($conexao, $id_pessoa, $cpf, $rg, $comarca);
        if (!$incluir) {
            $db_error = pg_last_error($conexao);
        }
        $advogado = new CAdvogado();
        $incluir = $advogado->incluirAdvogado($conexao, $id_pessoa, $oab, $flag);
        if (!$incluir) {
            $db_error.=" " . pg_last_error($conexao);
        }
    }

    if ($user == 1) {
        $user = new CUsuario();
        $incluir = $user->incluirUser($conexao, $id_pessoa, $senha, $em);
        if (!$incluir) {
            $db_error.= " " . pg_last_error($conexao);
        } else {
            $email = new CEmail();
            $mandar = $email->enviarSenha($em, $em, $senha);

            if ($mandar == 0) {
                $incluir = null;
                $db_error = 'email_incluir';
            }
        }
    }


    if ($incluir) {
        pg_query($conexao, "commit");
        echo "1";
    } else {
        pg_query($conexao, "rollback");
        pg_close($conexao);
        echo $db_error;
    }
}
?>
