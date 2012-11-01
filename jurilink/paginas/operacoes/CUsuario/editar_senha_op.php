<?php
ini_set('display_errors', 0);

require_once '../../classes/CUsuario.php';
require_once '../../classes/CConexao.php';

$id_pessoa = $_POST['id_pessoa'];
$nova_senha = $_POST['nova_senha'];
$senha = md5($nova_senha);
$editar = NULL;


$conexao1 = new CConexao();

$conexao = $conexao1->novaConexao();

pg_query($conexao,"begin");

$user = new CUsuario();

$editar = $user->alterarSenha($conexao,$id_pessoa,$senha);


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
