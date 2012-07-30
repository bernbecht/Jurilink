<?php

include '../classes/CJuridica.php';

 $id_pessoa = 6 ;
   $cnpj = 5013577500014;
   
   $juridica = new CJuridica();
   
   $juridica->incluirJuridica($id_pessoa, $cnpj);

?>
