<?php

//Código de autocompletar o campo AUTOR do cadastrar_processo.php


include '../classes/CPessoa.php';
include '../classes/CFisica.php';
include '../classes/CJuridica.php';
include '../classes/CAdvogado.php';

$nome = $_POST['reu_advogado'];
//$nome ="B";


if ($nome != "" || $nome != " ") {

    $Pessoa = new CPessoa();
    $resultado = NULL;
    $resultadoF = NULL;
    $resultadoA = NULL;
    $qtd_id = 0;


    if (is_numeric($nome)) {

        $fisica = new CFisica();
        $sqlFisica = $fisica->getFisicaCpfRGTipo($nome, 2);
        $resultadoF = pg_fetch_object($sqlFisica);


        $ad = new CAdvogado();
        $sqlAd = $ad->getIDOab($nome);
        $resultadoA = pg_fetch_object($sqlAd);
    } else {

        $sql = $Pessoa->getPessoaNomeTipo($nome,2);
        $resultado = pg_fetch_object($sql);
    }

    echo "<ul>";

    if ($resultado == NULL && $resultadoF == NULL && $resultadoA == NULL) {
        echo "<li>Dado nao Encontrado</li>";
    } else {

        if (is_numeric($nome)) {
            if ($resultadoF != NULL) {
                do {
                    echo "<li>" . $resultadoF->nome . "</li>";
                } while ($resultadoF = pg_fetch_object($sqlFisica));
            }

            if ($resultadoA != NULL) {
                do {
                    echo "<li>" . $resultadoA->nome . "</li>";
                } while ($resultadoA = pg_fetch_object($sqlAd));
            }
        } else {
            if ($resultado != NULL) {
                do {
                    echo "<li>" . $resultado->nome . "</li>";
                } while ($resultado = pg_fetch_object($sql));
            }
        }
    }
    echo "</ul>";
}//if ($nome != "" || $nome != "")
?>
