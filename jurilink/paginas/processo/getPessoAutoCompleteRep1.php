<?php

//Código de autocompletar o campo AUTOR do cadastrar_processo.php


include '../classes/CPessoa.php';
include '../classes/CFisica.php';
include '../classes/CJuridica.php';


    
$nome = $_POST['autor_rep'];




if ($nome != "" || $nome != "") {

    $Pessoa = new CPessoa();
    $resultado = NULL;
    $resultadoMinus = NULL;
    $qtd_id = 0;
     

    if (is_numeric($nome)) {

        $fisica = new CFisica();
        $sqlFisica = $fisica->getFisicaCpfRG($nome);
        $resultadoF = pg_fetch_object($sqlFisica);

        if ($resultadoF != NULL) {
            do {
                $a[] = $resultadoF->id_pessoa;
            } while ($resultadoF = pg_fetch_object($sqlFisica));
            $qtd_id = count($a);
        }

        $juridica = new CJuridica();
        $sqlJuridica = $juridica->getJuridicaCNPJ($nome);
        $resultadoJ = pg_fetch_object($sqlJuridica);

        if ($resultadoJ != NULL) {
            do {
                $a[] = $resultadoJ->id_pessoa;
            } while ($resultadoJ = pg_fetch_object($sqlJuridica));
            $qtd_id = count($a);
        }

        
    } else {

        $nome[0] = strtoupper($nome[0]);        

        $sql = $Pessoa->getPessoaNome($nome);
        $resultado = pg_fetch_object($sql);

        $nomeMinus = $nome;

        $nomeMinus[0] = strtolower($nomeMinus[0]);

        $sqlMinus = $Pessoa->getPessoaNome($nomeMinus);

        $resultadoMinus = pg_fetch_object($sqlMinus);
    }

    echo "<ul>";

    if ($resultado == NULL &&  $resultadoMinus == NULL && $qtd_id == 0) {
        echo "";
    }
    else {
        if (is_numeric($nome)) {
            for ($i = 0; $i < $qtd_id; $i++) {
                $nome_pessoa = $Pessoa->getPessoa($a[$i]);
                echo "<li>" . $nome_pessoa . "</li>";
            }
        } else if ($resultadoMinus != NULL) {
            do {
                echo "<li>" . $resultadoMinus->nome . "</li>";
            } while ($resultadoMinus = pg_fetch_object($sqlMinus));           
        } else {
            do {
                echo "<li>" . $resultado->nome . "</li>";
            } while ($resultado = pg_fetch_object($sql));
        }
    }
    echo "</ul>";
}//if ($nome != "" || $nome != "")
?>
