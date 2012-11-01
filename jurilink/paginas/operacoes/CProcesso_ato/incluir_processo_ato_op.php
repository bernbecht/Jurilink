
<?php

require_once '../../classes/CProcesso_ato.php';

require_once '../../classes/CAto.php';

require_once '../../classes/CEmail.php';

require_once '../../classes/CConexao.php';

require_once '../../classes/CProcesso.php';




$id_p = $_POST['id_processo'];
$id_a = $_POST['id_ato'];


$erro = "";

if ($id_a == -1) {
    $erro = 'É necessario selecionar um <b>ato</b>.';
}
if ($erro != "") {
    echo $erro;
} else {
    $processo_ato = new CProcesso_ato();

    $sql_ato = $processo_ato->incluirProcesso_ato($id_p, $id_a);

    if (!$sql_ato) {
        echo 0; //erro do ato
    } else {
        $ato = new CAto();

        $ato = $ato->getAtoID($id_a);


        if ($ato->flag_cliente == 't') {
            
            
            $conexao1 = new CConexao();
            $conexao = $conexao1->novaConexao();

            $query = "select email from (((pessoa
                inner join autor p_autor on p_autor.id_processo = $id_p and p_autor.flag_papel = 0 and pessoa.id_pessoa = p_autor.id_pessoa)
                inner join autor ad_autor on ad_autor.id_processo = $id_p and ad_autor.flag_papel = 1)
                inner join advogado on advogado.id_pessoa = ad_autor.id_pessoa and advogado.flag_func = TRUE)
                union 
                select email from (((pessoa
                inner join reu p_reu on p_reu.id_processo = $id_p and p_reu.flag_papel = 0 and pessoa.id_pessoa = p_reu.id_pessoa)
                inner join reu ad_reu on ad_reu.id_processo = $id_p and ad_reu.flag_papel = 1)
                inner join advogado on advogado.id_pessoa = ad_reu.id_pessoa and advogado.flag_func = TRUE)";

            $sql = pg_query($conexao, $query);

            $fetch = pg_fetch_object($sql);
            
            //variavel que verifica se todos os clientes tem um email e podem receber
            $mandou_todos = true;
            
                         
                 do {
                    if ($fetch->email != '') {
                        $processo = new CProcesso();
                        $processo = $processo->getProcesso($id_p);
                        $email = new CEmail();
                        $email = $email->enviarAto($fetch->email, $ato->nome, $ato->descricao, $processo->numero_unificado);
                        
                    } else {
                        $mandou_todos = false;
                    }
                } while ($fetch = pg_fetch_object($sql)); 
                
                if($mandou_todos == true){
                    echo 1;
                }
                else{
                   echo "Não foi possível mandar um e-mail avisando todos os clientes, mas a atualização do ato será cadastrada. Certifique-se que todos os clientes possuem e-mail válido."; 
                }
            
        }
        else
            echo 1;
    }
}
?>

