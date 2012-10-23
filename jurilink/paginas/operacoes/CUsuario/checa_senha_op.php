<?php

session_start();
ini_set('display_errors', 0);

require_once '../../classes/CConexao.php';


$senha_digitada = md5($_POST['senha_digitada']);
$id_pessoa = $_SESSION['id_usuario'];

$conexao1 = new CConexao();

$conexao = $conexao1->novaConexao();

$pesq = pg_query($conexao, "select senha from usuario where id_pessoa = $id_pessoa");
$pesq_senha = pg_fetch_object($pesq);
$senha = $pesq_senha->senha;

//se a checagem da senha passar
if ($senha == $senha_digitada)
    echo "1";

//se as senhas não forem iguais
else
    echo "0";
 
 

?>
