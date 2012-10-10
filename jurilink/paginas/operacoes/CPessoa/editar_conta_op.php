<?php
ini_set('display_errors', 0);

require_once '../../classes/CPessoa.php';
require_once '../../classes/CUsuario.php';
require_once '../../classes/CConexao.php';

$id_pessoa = $_POST['id_pessoa'];
$email = $_POST['email'];
$telefone = $_POST['tel'];
$estado = $_POST['estado'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$erro = "";

$conexao1 = new CConexao();

$conexao = $conexao1->novaConexao();

pg_query($conexao,"begin");

$pessoa = new CPessoa();

$editar = $pessoa->editarConta($conexao,$email,$telefone,$estado,$endereco,$cidade,$bairro,$id_pessoa);

$user = new CUsuario();

$editar = $user->editarUser($conexao,$id_pessoa,0,$email);


if(!editar){
    $db_error.=" " . pg_last_error($conexao);
}

if ($editar) {
    pg_query($conexao, "commit");
    echo "1";
} else {
    pg_query($conexao, "rollback");
    pg_close($conexao);
    echo $db_error;
}



?>
