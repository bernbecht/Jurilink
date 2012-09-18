<?php
session_start();

if(!isset($_SESSION['usuario'])) header("location:../../logout.php");
//if ($_SESSION['tipo_usuario'] != 2) header("location:../../logout.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>JuriLink ~ Basic</title>       
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="../../bootstrap/css/jurilink.css" />   
         
    </head>

    <body>
        <div class="navbar ">
            <div class="navbar-inner">
                <div class="container">                    
                    <a  class="brand" href="../../jurilink_main.php">JuriLink</a>  
                    <ul class="nav  pull-right">
                        <li><a href="#">Ajuda</a></li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['usuario']; ?>
                                <b class="caret"></b></a>
                            <ul id="menu2" class=" nav-list dropdown-menu">
                                <li>
                                    <a href="../../info.php">
                                        <i class="icon-user"></i>
                                        Conta
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="../../logout.php">
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
                <li class="" id="inicio"><a href="../../jurilink_main.php">Inicio</a></li>
               
                <li class="dropdown" id="pessoa">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pessoas
                        <b class="caret"></b></a>
                    <ul id="pessoas_menu_dropdown" class="dropdown-menu">
                        <li><a  href="../pessoa/relacao_pfisica.php">F&iacute;sica</a></li>
                        <li><a  href="../pessoa/relacao_pjuridica.php">Jur&iacute;dica</a></li>
                        <li><a  href="../pessoa/relacao_padvogado.php">Advogados</a></li>


                    </ul>
                </li>
                
                <li id="processo"><a href="../processo/relacao_processos.php">Processos</a></li>
                
                
                
                <li id="dados" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gerenciar Dados
                        <b class="caret"></b></a>
                    <ul id="dados_menu_dropdown" class="dropdown-menu">
                        <li><a  href="../comarca/cadastrar_comarca.php">Comarca</a></li>
                        <li><a  href="../juizo/cadastrar_juizo.php">Juizo</a></li>
                        <li><a  href="../natureza_acao/cadastrar_natureza_acao.php">Natureza</a></li>
                        <li><a  href="../ato/cadastrar_ato.php">Ato</a></li>                        
                    </ul>
                </li>                          
            </ul>           
        </div>
