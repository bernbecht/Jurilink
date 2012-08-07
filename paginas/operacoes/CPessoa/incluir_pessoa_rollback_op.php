<?php

//ini_set('display_errors', 0);

include '../../classes/CPessoa.php';

include '../../classes/CJuridica.php';

include '../../classes/CFisica.php';

include '../../classes/CUsuario.php';

include '../../classes/CAdvogado.php';

include_once '../../classes/CConexao.php';

$n = $_POST['nome'];
$e = $_POST['endereco'];
$t = $_POST['telefone'];
$em = $_POST['email'];
$c = $_POST['cidade'];
$uf = $_POST['estado'];
$tipo_pessoa = $_POST['tipo']; //0 fisica, 1 juridica, 2 advogado
$user = $_POST['userCheckbox'];
$senha = $_POST['senha'];
$b = $_POST['bairro'];
$comarca = $_POST['comarca'];

//echo $tipo_pessoa;

$erro = "";



if (strlen($n) < 2) {
    $erro.= "nome menos que 2";
}

if (strlen($e) < 2) {
    $erro.= "endereço menos que 2";
}

if (strlen($t) < 8) {
    $erro.= "telefone menos que 8";
}

if (strlen($t) > 10) {
    $erro.= "telefone mais que 10";
}

if (!is_numeric($t)) {
    $erro.= "telefone nao eh numero";
}

/*if (strlen($em) < 2) {
    $erro.= "email menos que 2";
}*/

if (strlen($b) < 2) {
    $erro.= "Escreva um bairros";
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

    if (strlen($rg) < 2) {
        $erro.= "rg menos que 2";
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

    if (strlen($cnpj) < 2) {
        $erro.= "cnpj menos que 2";
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

//Se for user, confere o tamanho da senha
if ($user == 1) {
    if (strlen($senha) < 7) {
        $erro.= "senha menor que 8";
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
    } else if ($tipo_pessoa == 1) {
        $juridica = new CJuridica();
        $incluir = $juridica->incluirJuridica($conexao, $id_pessoa, $cnpj);
    } else if ($tipo_pessoa == 2) {

        if ($user == 1)
            $flag = "true";

        else
            $flag = "false";


        $fisica = new CFisica();
        $incluir = $fisica->incluirFisica($conexao, $id_pessoa, $cpf, $rg, $comarca);
        $advogado = new CAdvogado();
        $incluir = $advogado->incluirAdvogado($conexao, $id_pessoa, $oab, $flag);
    }

    if ($user == 1) {
        $user = new CUsuario();
        $incluir = $user->incluirUser($conexao, $id_pessoa, $senha, $em);
    }


    if ($incluir) {
        pg_query($conexao, "commit");
        echo "1"; 
   } else {
        pg_query($conexao, "rollback");
        pg_close($conexao);
        echo "0";
    }
}
?>
