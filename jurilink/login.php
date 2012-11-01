
<?php

include_once "paginas/classes/CConexao.php";
$conexao = new CConexao();
$conexao1 = $conexao->novaConexao(); // $conexao é uma variavel que é declarada em config.php

//não mostrar erros de banco
ini_set('display_errors', 0);

session_start();


if (isset($_POST['usuario'])) {
    $senha = $_POST['senha'];
    $senha = md5($senha);
    $usuario = $_POST['usuario'];

    $query = "SELECT * 
    FROM pessoa, usuario 
    WHERE pessoa.email = '$usuario' 
    AND  usuario.senha = '$senha'";
    
    

    $result = pg_exec($conexao1, $query);
    
    $resultado = pg_fetch_object($result);
	
	
    
    if($resultado->nome == ''){
   
        echo 0;
    }

    else {
        $row = pg_num_rows($result);

        if ($row) {
            $_SESSION['usuario'] = $usuario;
           // echo "usuario " . $_SESSION['usuario'] . " esta logado <br />";
        } else {
            //header("location:logout.php");
        }


        $query = "SELECT id_pessoa, tipo FROM pessoa WHERE email = '$usuario'";
        $pesq = pg_query($conexao1, $query);
        $resultado = pg_fetch_object($pesq);

        $_SESSION['id_usuario'] = $resultado->id_pessoa;
        $_SESSION['tipo_usuario'] = $resultado->tipo;

   

        if ($_SESSION['tipo_usuario'] == 2)
        
            echo 1;
        
        else if ($_SESSION['tipo_usuario'] == 0 or $_SESSION['tipo_usuario'] == 1)
            
            echo 2;
    }
}
?>
