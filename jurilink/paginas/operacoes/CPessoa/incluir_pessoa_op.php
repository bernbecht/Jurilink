<?php

include '../../classes/CPessoa.php';

include '../../classes/CJuridica.php';

include '../../classes/CFisica.php';

include '../../classes/CUsuario.php';

include '../../classes/CAdvogado.php';

$n = $_POST['nome'];
$e = $_POST['endereco'];
$t = $_POST['telefone'];
$em = $_POST['email'];
$c = $_POST['cidade'];
$uf = $_POST['estado'];
$tipo_pessoa = $_POST['tipo']; //1 fisica, 2 juridica, 3 advogado
$user = $_POST['userCheckbox'];
$senha = $_POST['senha'];
$b = $_POST['bairro'];
$comarca = $_POST['comarca'];

echo $user;

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

if (strlen($em) < 2) {
    $erro.= "email menos que 2";
}

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
if ($tipo_pessoa == 1 || $tipo_pessoa == 3) {
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

//se for uma pessoa jurídica, comfere só cnpj
if ($tipo_pessoa == 2) {
    $cnpj = $_POST['cnpj'];

    if (strlen($cnpj) < 2) {
        $erro.= "cnpj menos que 2";
    }

    if (!is_numeric($cnpj)) {
        $erro.= "cnpj nao eh numero";
    }
}

//se for um advogado
if ($tipo_pessoa == 3) {
    $oab = $_POST['oab'];

    if (strlen($oab) < 3) {
        $erro.= "oab menos que 3";
    }

    if (!is_numeric($oab)) {
        $erro.= "oab nao eh numero";
    }
}

if ($erro != "") {
    echo $erro;
} else {

    $pessoa = new CPessoa();
    $pessoa->incluirPessoa($n, $e, $em, $t, $c, $uf, $b, $tipo_pessoa);
    $id_pessoa = $pessoa->getId($em); //pega o id da pessoa com passando o email

    if ($tipo_pessoa == 1) {
        $fisica = new CFisica();
        $fisica->incluirFisica($id_pessoa, $cpf, $rg, $comarca);
    } else if ($tipo_pessoa == 2) {
        $juridica = new CJuridica();
        $juridica->incluirJuridica($id_pessoa, $cnpj);
    } else if ($tipo_pessoa == 3) {
        if ($user == 1)
            $flag = true;
        else
            $flag = false;
        $fisica = new CFisica();
        $fisica->incluirFisica($id_pessoa, $cpf, $rg);
        $advogado = new CAdvogado();
        $advogado->incluirAdvogado($id_pessoa, $oab, $flag);
    }

    if ($user == 1) {
        if (strlen($senha) > 7) {
            $user = new CUsuario();
            $user->incluirUser($id_pessoa, $em, $senha);
        }
        
        else{
            echo "Senha menor que 8";
        }
    }


    echo "Pessoa cadastrada!";
}
?>
