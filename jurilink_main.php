<?php
require_once ( 'paginas/config.php');
session_start();
if (!isset($_SESSION['usuario']))
    header("location:main.php");
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

    <head>
        <title>JuriLink ~ Basic</title>       
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="bootstrap/css/jurilink.css" />   
    </head>

    <body>
        <div class="navbar ">
            <div class="navbar-inner">
                <div class="container">                    
                    <a  class="brand" href="#">JuriLink</a>  
                    <ul class="nav  pull-right">
                        <li><a href="#">Ajuda</a></li>
                        <li class="dropdown">
                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['usuario']; ?>
                                <b class="caret"></b></a>
                            <ul id="menu2" class=" nav-list dropdown-menu">
                                <li>
                                    <a href="info.php">
                                        <i class="icon-user"></i>
                                        Conta
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="logout.php">
                                        <i class="icon-off"> </i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="subnav">            
            <ul class="nav nav-pills">
                <ul class="nav nav-pills">
                    <li class="active"><a class="aba" href="jurilink_main.php">Inicio</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pessoas
                            <b class="caret"></b></a>
                        <ul id="pessoas_menu_dropdown" class="dropdown-menu">
                            <li><a class="aba drop" href="paginas/pessoa/relacao_pfisica.php">F&iacute;sica</a></li>
                            <li><a class="aba drop" href="paginas/pessoa/relacao_pjuridica.php">Jur&iacute;dica</a></li>
                            <li><a class="aba drop" href="paginas/pessoa/relacao_advogados.php">Advogados</a></li>
                        </ul>
                    </li>

                    <li><a class="aba" href="paginas/processo/cadastrar_processo.php">Processos</a></li>



                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gerenciar Dados
                            <b class="caret"></b></a>
                        <ul id="dados_menu_dropdown" class="dropdown-menu">
                            <li><a class="aba drop" href="paginas/comarca/cadastrar_comarca.php">Comarca</a></li>
                            <li><a class="aba drop" href="paginas/juizo/cadastrar_juizo.php">Juizo</a></li>
                            <li><a class="aba drop" href="paginas/natureza_acao/cadastrar_natureza_acao.php">Natureza</a></li>
                            <li><a class="aba drop" href="paginas/ato/cadastrar_ato.php">Ato</a></li>                        
                        </ul>
                    </li>                          
                </ul>       
            </ul>           
        </div>


        <div class="container"  >
            <div class="row show-grid">
                <div class="span6 drop">
                    <div class="drag">
                        <div class="barra-titulo">
                            <div class="esquerda">
                                <h3>
                                    Ultimos Lancamentos de Processo
                                </h3>
                            </div>
                            <div class="direita">
                                <a class="btn btn-small btn-success" href="#">
                                    <i class="icon-plus icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="tabela"> 
                            <table class="table table-striped table-condensed" >                        
                                <thead>
                                    <tr >
                                        <th >NProcesso</th>
                                        <th>Categoria</th>
                                        <th>Cliente</th>
                                        <th>Advogado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry the Bird</td>
                                        <td>Ber</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 

                <div class="span6 drop">
                    <div class="drag">
                        <div class="barra-titulo">
                            <div class="esquerda">
                                <h3>
                                    Ultimos Lancamentos de Processo
                                </h3>
                            </div>
                            <div class="direita">
                                <a class="btn btn-small btn-success" href="#">
                                    <i class="icon-plus icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="tabela"> 
                            <table class="table table-striped table-condensed" >                        
                                <thead>
                                    <tr >
                                        <th >NProcesso</th>
                                        <th>Categoria</th>
                                        <th>Cliente</th>
                                        <th>Advogado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry the Bird</td>
                                        <td>Ber</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div> <!-- Div de linha --->

            <div class="row show-grid">
                <div class="span12 drop">
                </div>
            </div>
        </div>





        <!------ Scripts -->

        <script type="text/javascript" src="drag/src/prototype.js"></script>
        <script type="text/javascript"  src="drag/src/scriptaculous.js" ></script> 
        <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>    
        <script type="text/javascript" src="jurilink_js.js"></script>    

        <script type="text/javascript">                                                        
                              
        </script>

    </body>
</html>
