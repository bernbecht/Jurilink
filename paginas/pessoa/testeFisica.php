<?php

include '../classes/CFisica.php';


   $id_pessoa = 4;
   $cpf = "00436440903";
   $rg = "1234567";
   $orgao_expedidor = "comarca";
   
  $fisica = new CFisica();
  
  $fisica->incluirFisica($id_pessoa, $cpf, $rg, $orgao_expedidor);


?>
