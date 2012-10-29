<?php
require_once '../template/header.php'; //chama o header
require_once '../config.php';     //chama as configurações de página!
require_once '../classes/CFisica.php';
require_once "../classes/CConexao.php";

$conexao = new CConexao();
$conexao1 = $conexao->novaConexao();

$fisica_processo = new CFisica();

//GET para ID da pessoa
if (isset($_GET['id'])) {
    $id_pessoa = $_GET['id'];
    $_SESSION['id'] = $id_pessoa;
} else {
    $id_pessoa = $_SESSION['id'];
}

//Coleta dados de pessoa do banco para mostrar na tela
$query = "SELECT * FROM pessoa WHERE id_pessoa = $id_pessoa";
$pesq_pessoa = pg_query($conexao1, $query);
$pessoa = pg_fetch_object($pesq_pessoa);

//Estado
$query = "SELECT uf.nome as nome_estado FROM uf,pessoa WHERE id_pessoa = $id_pessoa and pessoa.id_uf = uf.id_uf";
$pesq_uf = pg_query($conexao1, $query);
$estado = pg_fetch_object($pesq_uf);


$query = "SELECT * FROM fisica WHERE fisica.id_pessoa = $id_pessoa";
$pesq_fisica = pg_query($conexao1, $query);
$fisica = pg_fetch_object($pesq_fisica);

/* Pega os 3 processos com */
$pesq_proc_advocacia = $fisica_processo->getProcessosFisicaComAdvocacia($id_pessoa);
$processos_advocacia = pg_fetch_object($pesq_proc_advocacia);

/* Pega os 3 processos contra */
$pesq_proc_c_advocacia = $fisica_processo->getProcessosFisicaContraAdvocacia($id_pessoa);
$processos_c_advocacia = pg_fetch_object($pesq_proc_c_advocacia);

/* Saber se a pessoa é user */
$pesq_user = pg_exec($conexao1, "select count (id_pessoa) from usuario where usuario.id_pessoa = $id_pessoa");
$user = pg_fetch_object($pesq_user);
?>

<div class="container content">      
    <div class="row">        
        <div class="esquerda">
            <div class="header-pagina">            
                <h1><?php echo $pessoa->nome ?></h1>
            </div>
        </div>
        <div class="direita">

            <a href='relacao_pfisica.php' class='btn btn-small' >

                VOLTAR    
            </a>
            <a>
                <?php
                echo "<a href='editar_pfisica.php?id={$id_pessoa}' class='btn btn-small btn-warning' >";
                ?>
                <i class="icon-pencil icon-white"></i>
                EDITAR     
            </a>
        </div>

    </div>

    <div class="divisor_horizontal_view"></div>


    <div class="row show-grid">

        <div class="ficaFloat">
            <div class="span2 offset1">
                <div class="view_pessoa">
                    <div class="view_pessoa_legenda">
                        <p><strong>Nome</strong></p>
                        <p><strong>CPF</strong></p>
                        <p><strong>RG</strong></p>
                        <p><strong>E-mail</strong></p>
                        <p><strong>User</strong></p>
                    </div>
                </div>

            </div>
        </div>

        <div class="ficaFloat">
            <div class="span3">
                <div class="view_pessoa">
                    <div class="view_pessoa_dados">
                        <p><?php echo $pessoa->nome ?></p>
                        <?php
                        echo"<p>";                           
                                $cpf = $fisica->cpf;                                
                                for ($i = 0; $i < 12; $i++) {
                                    if ($i == 3 || $i == 6 )
                                        echo ".";
                                    echo $cpf[$i];
                                    if ($i == 8)
                                        echo "-";
                                }                            
                            echo"</p>";
                        ?>    
                        <p><?php echo $fisica->rg ?></p>
                        <?php
                        if ($pessoa->email == '') {
                            echo '<p>Não Cadastrado</p>';
                        } else {
                            echo '<p>' . $pessoa->email . '</p>';
                        }
                        if ($user->count)
                            echo "<p>Sim</p>";
                        else
                            echo "<p>Nao</p>";
                        ?>                    
                    </div>
                </div>
            </div>
        </div>

        <div class="ficaFloat">
            <div class="span2">
                <div class="view_pessoa">
                    <div class="view_pessoa_legenda">
                        <p><strong>Telefone</strong></p>
                        <p><strong>Endereco</strong></p>
                        <p><strong>Bairro</strong></p>                    
                        <p><strong>Cidade</strong></p>
                        <p><strong>Estado</strong></p>                                       
                    </div>
                </div>
            </div>
        </div>


        <div class="ficaFloat">
            <div class="span3">
                <div class="view_pessoa">
                    <div class="view_pessoa_dados">
                        <?php
                        if ($pessoa->tel == '')
                            echo '<p>Não Cadastrado</p>';
                        else {
                            echo"<p>";
                            if (strlen($pessoa->tel) == 11) {
                                $tele = $pessoa->tel;
                                echo "(";
                                for ($i = 0; $i < 11; $i++) {
                                    if ($i == 2)
                                        echo ") ";
                                    echo $tele[$i];
                                    if ($i == 6)
                                        echo "-";
                                }
                            }
                            
                            else if (strlen($pessoa->tel) == 10) {
                                $tele = $pessoa->tel;
                                echo "(";
                                for ($i = 0; $i < 10; $i++) {
                                    if ($i == 2)
                                        echo ") ";
                                    echo $tele[$i];
                                    if ($i == 5)
                                        echo "-";
                                }
                            }
                            
                            else if (strlen($pessoa->tel) == 8) {
                                $tele = $pessoa->tel;                                
                                for ($i = 0; $i < 8; $i++) {                                    
                                    echo $tele[$i];
                                    if ($i == 3)
                                        echo "-";
                                }
                            }
                            echo "</p>";
                        }

                        if ($pessoa->endereco == '')
                            echo '<p>Não Cadastrado</p>';
                        else
                            echo "<p>$pessoa->endereco</p>";

                        if ($pessoa->bairro == '')
                            echo '<p>Não Cadastrado</p>';
                        else
                            echo "<p>$pessoa->bairro</p>";
                        ?>

                        <p><?php echo $pessoa->cidade ?></p>
                        <p><?php echo $estado->nome_estado ?></p>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- ROW -->



    <div class="row row_view">
        <div class="esquerda">
            <h2>Processos com a Advocacia</h2>
        </div>
        <div class="direita">

            <button type="button" class="btn maximizar" data-toggle="collapse" data-target="#container_tabela_processo_cliente">
                <i class="icon-minus"></i>
            </button>
        </div>        
    </div>

    <div class="divisor_horizontal_view"></div>

    <div  class="row">
        <div id="container_tabela_processo_cliente" class="collapse in">
            <div id="tabela_processo_cliente" >
                <?php
                if (pg_num_rows($pesq_proc_advocacia) > 0) {
                    echo "<table = 'processos' class='table table-striped table-condensed' >";
                    echo "<thead>";
                    echo "<tr>
                    <th>Data Distribui&ccedil;&atilde;o</th>
                    <th>N&uacute;mero</th>
                    <th>Natureza</th>
                    <th>Autor(es)</th>
                    <th>R&eacute;u(s)</th>
                    <th>Advogado</th>
                    <th>Valor da Causa</th>
                    </tr>
                    </thead>";
                    echo "<tbody>";

                    do {
                        echo "<tr>	
                    <td>" . $processos_advocacia->data_distribuicao . "</td>
                    <td><a href=../processo/view_processo.php?id=$processos_advocacia->id_processo>" . $processos_advocacia->numero_unificado . "</a></td>
                    <td>" . $processos_advocacia->nome_natureza . "</td>
                    <td>" . $processos_advocacia->nome_autor . "</td>
                    <td>" . $processos_advocacia->nome_reu . "</td>
                    <td>" . $processos_advocacia->nome_adv . "</td>
                    <td><div class = 'direita'>" . $processos_advocacia->valor_causa . "</div></td> 
                    </tr>";
                    } while ($processos_advocacia = pg_fetch_object($pesq_proc_advocacia));

                    echo "</tbody>";
                    echo "</table>";
                    echo "<p class='centro'><button id='todos_processos_com' class='btn btn-primary'>Ver todos os Processos</button></p>";
                } else {
                    echo'<div class="alert"><h4>Esta pessoa nao tem processos com a advocacia no momento.</h4></div>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="row row_view">
        <div class="esquerda">
            <h2>Processos contra a Advocacia</h2>
        </div>
        <div class="direita">

            <button type="button" class="btn maximizar" data-toggle="collapse" data-target="#container_tabela_processo_contra">
                <i class="icon-minus"></i>
            </button>
        </div>        
    </div>

    <div class="divisor_horizontal_view"></div>

    <div class="row">
        <div id="container_tabela_processo_contra" class="collapse in">
            <div id="tabela_processo_contra" > 
                <?php
                if (pg_num_rows($pesq_proc_c_advocacia) > 0) {

                    echo "<table class='table table-striped table-condensed ' >";
                    echo "<thead>";
                    echo "<tr>
                <th>Data Distribui&ccedil;&atilde;o</th>
                <th>N&uacute;mero</th>
                <th>Natureza</th>
                <th>Autor(es)</th>
                <th>R&eacute;u(s)</th>
                <th>Advogado</th>
                <th>Valor da Causa</th>
                </tr>
                </thead>";
                    echo "<tbody>";

                    do {
                        echo "<tr>	
                    <td>" . $processos_c_advocacia->data_distribuicao . "</a></td>
                    <td><a href=../processo/view_processo.php?id=$processos_c_advocacia->id_processo>" . $processos_c_advocacia->numero_unificado . "</a></td>
                    <td>" . $processos_c_advocacia->nome_natureza . "</td>
                    <td>" . $processos_c_advocacia->nome_autor . "</td>
                    <td>" . $processos_c_advocacia->nome_reu . "</td>
                    <td>" . $processos_c_advocacia->nome_adv . "</td>
                    <td><div class = 'direita'>" . $processos_c_advocacia->valor_causa . "</div></td> 
                    </tr>";
                    } while ($processos_c_advocacia = pg_fetch_object($pesq_proc_c_advocacia));

                    echo "</tbody>";
                    echo "</table>";
                    echo "<p class='centro'><button id='todos_processos_contra' class='btn btn-primary'>Ver todos os Processos</button></p>";
                } else {
                    echo'<div class="alert"><h4>Esta pessoa nao tem processos contra a advocacia no momento.</h4></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<input id="id" type="hidden" value="<?php echo $id_pessoa ?>"/>
<input id="tipo_pessoa" type="hidden" value="<?php echo $_SESSION['tipo_usuario'] ?>"/>


</body>
<?php
require_once '../template/scripts.php'; //chama scripts comuns as paginas
require_once 'scripts_view_pessoa.php';
?>
</html>
