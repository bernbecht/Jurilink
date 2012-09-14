
<?php

require_once 'paginas/config.php';



if (isset($_POST['usuario'])) {
    $senha = $_POST['senha'];
    //$senha = md5($senha);
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
        header("location:logout.php");
    }


    $query = "SELECT id_pessoa, tipo FROM pessoa WHERE email = '$usuario'";
    $pesq = pg_query($conexao1, $query);
    $resultado = pg_fetch_object($pesq);
    
    $_SESSION['id_usuario'] = $resultado->id_pessoa;
    $_SESSION['tipo_usuario'] = $resultado->tipo;
    
    echo $_SESSION['tipo_usuario'];
     echo $_SESSION['id_usuario'];
    
   if ($_SESSION['tipo_usuario'] == 2)
        header("location:jurilink_main.php");
    else if ($_SESSION['tipo_usuario'] == 0 or $_SESSION['tipo_usuario'] == 1)
        header("location:paginas/pessoa/view_user.php");

}
?>
