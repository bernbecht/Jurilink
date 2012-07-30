<?php

require_once '../template/header.php'; //chama o header
require_once ( '../config.php');     //chama as configurações de página!

$pessoa_fisica = "select pessoa.nome as nome_pessoa, fisica.cpf, fisica.rg, pessoa.email, 
pessoa.tel, pessoa.cidade, uf.nome as nome_estado from pessoa, fisica, uf where
pessoa.id_pessoa = fisica.id_pessoa and pessoa.id_uf = uf.id_uf order by nome_pessoa";

$pesq_fisica = pg_query($conexao1,$pessoa_fisica);
$resultado = pg_fetch_object($pesq_fisica);


        echo "<table = 'fisica' class=table table-striped table-condensed >";
        echo "<thead>";
        echo "<tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>A&ccedil;&otilde;es</th>
                </tr></thead>";
        echo "<tbody>";
        do {
            echo "<tr>	
                <td>" . $resultado->email . "</td>
                <td>" . $resultado->nome_estado . "</td>
                <td>" . $resultado->nome_pessoa . "</td>
                <td>" . $resultado->nome_pessoa . "</td>
                <td>" . $resultado->nome_pessoa . "</td>
                <td>" . $resultado->nome_pessoa . "</td>
                <td>" . $resultado->nome_pessoa . "</td>
                <td>" . $resultado->nome_pessoa . "</td>
                </tr>";
            //echo "<option value=$resultado->id_uf>$resultado->nome</option>";
        } while ($resultado = pg_fetch_object($pesq_fisica));     
        
        
        /*
        while ($row = pg_fetch_row($pesq_fisica)) {
            echo "<tr>	
                <td>" . $resultado->nome_pessoa . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[5] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td> ACOES</td>
            </tr>";
        }*/
        echo "</tbody>";
        echo "</table>";


?>

