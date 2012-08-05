<html>
<body>
<?php
require_once ( 'paginas/config.php');


session_start();

if(isset($_POST['usuario'])){
$senha=$_POST['senha'];
$usuario=$_POST['usuario'];

$query = "SELECT email FROM usuario WHERE usuario.email = '$usuario' AND
			usuario.senha = '$senha'";
$result = pg_exec($conexao1,$query);
if (!$result) echo "ERRO\n";

$row = pg_num_rows ($result);

if ($row){
    $_SESSION['usuario']=$usuario;
    echo "usuario " .$_SESSION['usuario']. " esta logado <br />";}
else{
    header("location:main.php");
}


$query = "SELECT id_pessoa, tipo FROM pessoa WHERE email = '$usuario'";
$pesq_usuario = pg_exec($conexao1, $query);
$result = pg_fetch_object($pesq_usuario);

$_SESSION['id_usuario'] = $result->id_pessoa;
$_SESSION['tipo_usuario'] = $result->tipo;

header("location:jurilink_main.php");
}
?>
</body>
</html>
