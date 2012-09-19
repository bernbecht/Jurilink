<?php

session_start();
if (!isset($_SESSION['usuario']))
    header("location:index.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                    <li class="active" id="inicio"><a class="aba" href="jurilink_main.php">Inicio</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle " data-toggle="dropdown">Pessoas
                            <b class="caret"></b></a>
                        <ul id="pessoas_menu_dropdown" class="dropdown-menu">
                            <li><a class="aba drop" href="paginas/pessoa/relacao_pfisica.php">F&iacute;sica</a></li>
                            <li><a class="aba drop" href="paginas/pessoa/relacao_pjuridica.php">Jur&iacute;dica</a></li>
                            <li><a class="aba drop" href="paginas/pessoa/relacao_padvogado.php">Advogados</a></li>
                        </ul>
                    </li>

                    <li><a class="aba" href="paginas/processo/relacao_processos.php">Processos</a></li>



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


        <div class="container" >

            <div class="row show-grid main ">
                <div class="span6 ">
                    <div class="barra-titulo" >
                        <div class="esquerda">
                            <h3>
                                Processos Recentes
                            </h3>
                        </div>
                        <div class="direita">                            
                                <button class="btn btn-small maxi_main" data-toggle="collapse" data-target="#ultimos_processos">
                                    <i class="icon-minus "></i>
                                </button>                           
                        </div>                        
                    </div>
                    <div id="ultimos_processos" class="collapse in">

                    </div>
                </div>

                <div class="span6 ">
                    <div class="barra-titulo">
                        <div class="esquerda">
                            <h3>
                                Próximas Audiências
                            </h3>
                        </div>
                        <div class="direita">
                           
                                <button class="btn btn-small maxi_main" data-toggle="collapse" data-target="#ultimas_audiencias">
                                    <i class="icon-minus "></i>
                                </button>
                           
                        </div>
                    </div>
                    <div id="ultimas_audiencias" class="collapse in">
                          
                    </div>
                </div>
            </div>

            <div class="row show-grid main ">
                <div class="span6 ">
                    <div class="barra-titulo">
                        <div class="esquerda">
                            <h3>
                                Ultimos Lancamentos de Processo
                            </h3>
                        </div>
                        <div class="direita">
                            <a class="btn btn-small btn-inverse" href="#">
                                    <i class="icon-plus icon-white"></i>
                                    Adicionar um Novo Processo
                                </a>
                                <a class="btn btn-small" href="#">
                                    <i class="icon-plus "></i>
                                </a>
                           
                        </div>
                    </div>
                </div>

                <div class="span6 ">
                    <div class="barra-titulo">
                        <div class="esquerda">
                            <h3>
                                Proximas Audiencias
                            </h3>
                        </div>
                        <div class="direita">
                            <a class="btn btn-small btn-success" href="#">
                                <i class="icon-plus icon-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>  

            <input type="hidden" id="id_pessoa" value="<?php echo $_SESSION['id_usuario'] ?>" />


        </div>      

    </body>
    
     <!------ Scripts -->

        <script type="text/javascript" src="drag/src/prototype.js"></script>
        <script type="text/javascript"  src="drag/src/scriptaculous.js" ></script> 
        <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>    
        <script type="text/javascript" src="jurilink_js.js"></script>    

        <script type="text/javascript">                                                        
                              
        </script>
    
</html>
