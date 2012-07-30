<?php

include '../classes/CPessoa.php';

$nome = "Bernardo";
$endereco = "Brigadeiro Rocha Loures";
$email = "berzuca@msn.com";
$telefone = 99374127;
$cidade = "Ponta Grossa";
$uf = 1;
$bairro = "JD. Carvalho";
$tipo = 1;

$pessoa = new CPessoa;

$pessoa->incluirPessoa($nome, $endereco, $email, $telefone, $cidade, $uf, $bairro, $tipo);

$nome = "B1";
$endereco = "Brigadeiro Rocha Loures";
$email = "berzuca1@msn.com";
$telefone = 99374127;
$cidade = "Ponta Grossa";
$uf = 1;
$bairro = "JD. Carvalho";
$tipo = 2;

$pessoa->incluirPessoa($nome, $endereco, $email, $telefone, $cidade, $uf, $bairro, $tipo);

$nome = "B3";
$endereco = "Brigadeiro Rocha Loures";
$email = "berzuca3@msn.com";
$telefone = 99374127;
$cidade = "Ponta Grossa";
$uf = 1;
$bairro = "JD. Carvalho";
$tipo = 2;

$pessoa->incluirPessoa($nome, $endereco, $email, $telefone, $cidade, $uf, $bairro, $tipo);


?>