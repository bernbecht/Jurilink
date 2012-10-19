<?php

require_once '../../classes/CEmail.php';

require_once '../../classes/CUsuario.php';


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

$mandar = new CEmail();

$user = new CUsuario();

$email = $_POST['email'];

$senha =  $senha = geraSenha(8, false, true); 

$edit = $user->editarSenha(md5($senha), $email);

$mandar->enviarSenha($email, $email, $senha);

echo 1;
?>