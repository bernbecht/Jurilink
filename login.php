
<?php

require_once ( 'paginas/config.php');


session_start();

if (isset($_POST['usuario'])) {
    $senha = $_POST['senha'];
    $usuario = $_POST['usuario'];

    $query = "SELECT nome 
    FROM pessoa, usuario 
    WHERE pessoa.email = '$usuario' 
    AND  usuario.senha = '$senha'";
    
    $result = pg_exec($conexao1, $query);
    if (!$result)
        echo "ERRO\n";

    $row = pg_num_rows($result);

    if ($row) {
        $_SESSION['usuario'] = $usuario;
        echo "usuario " . $_SESSION['usuario'] . " esta logado <br />";
    } else {
        //header("location:main.php");
    }


    $query = "SELECT id_pessoa, tipo FROM pessoa WHERE email = '$usuario'";
    $result = pg_exec($conexao1, $query);
    while ($row = pg_fetch_row($result)) {
        $_SESSION['id_usuario'] = $row[0];
        $_SESSION['tipo_usuario'] = $row[1];
    }
    header("location:jurilink_main.php");
}
?>
