<?php
include_once '../classes/CConexao.php';
include '../classes/CPessoa.php';


 function getPessoas($conexao,$tipo,$limite, $offset){
   $relacao_pessoa = new CPessoa();
   
   $pesquisa = $relacao_pessoa -> getPessoas($conexao,$tipo,$limite,$offset);
   
   return $pesquisa;
}

?>
