<?php
include_once '../classes/CConexao.php';
include_once '../classes/CPessoa.php';


 function getPessoas($conexao,$tipo,$limite, $offset){
   $relacao_pessoa = new CPessoa();
   
   $pesquisa = $relacao_pessoa -> getPessoas($conexao,$tipo,$limite,$offset);
   
   return $pesquisa;
}


function eUser($conexao, $id_pessoa) {
    //$user = new CPessoa();
   $user = new CPessoa();
    
    $pesquisa = $user->eUser($conexao,$id_pessoa);
    
    return $pesquisa;
    
    
}

function getEmail($conexao,$id_pessoa) {
    $email = new CPessoa();
    
    $pesquisa = $email->getEmail($conexao,$id_pessoa);
    
    return $pesquisa;
    
}

?>
