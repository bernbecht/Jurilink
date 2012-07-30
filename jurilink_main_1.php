<?php
require_once ( 'paginas/config.php');
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
                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown">daani_hart@msn.com
                                <b class="caret"></b></a>
                            <ul id="menu2" class=" nav-list dropdown-menu">
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i>
                                        Conta
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
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
                <li class="active"><a href="../../jurilink_main.php">Inicio</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pessoas
                        <b class="caret"></b></a>
                    <ul id="menu1" class="dropdown-menu">
                        <li><a href="paginas/pessoa/cadastrar_pessoa.php">Clientes</a></li>
                        <li><a href="#">Advogados</a></li>
                        <li><a href="#">Outros</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Processos
                        <b class="caret"></b></a>
                    <ul id="menu2" class="dropdown-menu">
                        <li><a href="paginas/processo/cadastrar_processo.php">Incluir</a></li>
                        <li><a href="paginas/comarca/excluir_processo.php">Excluir</a></li>
                        <li><a href="#">Editar</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Comarcas
                        <b class="caret"></b></a>
                    <ul id="menu2" class="dropdown-menu">
                        <li><a href="paginas/comarca/cadastrar_comarca.php">Incluir</a></li>
                        <li><a href="paginas/comarca/excluir_comarca.php">Excluir</a></li>
                        <li><a href="#">Editar</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Juizos
                        <b class="caret"></b></a>
                    <ul id="menu3" class="dropdown-menu">
                        <li><a href="paginas/juizo/cadastrar_juizo.php">Incluir</a></li>
                        <li><a href="paginas/juizo/excluir_juizo.php">Excluir</a></li>
                        <li><a href="#">Editar</a></li>
                    </ul>

                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Natureza
                        <b class="caret"></b></a>
                    <ul id="menu3" class="dropdown-menu">
                        <li><a href="paginas/natureza_acao/cadastrar_natureza_acao.php">Incluir</a></li>
                        <li><a href="paginas/natureza_acao/excluir_natureza_acao.php">Excluir</a></li>
                        <li><a href="#">Editar</a></li>
                    </ul>				
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ato
                        <b class="caret"></b></a>
                    <ul id="menu3" class="dropdown-menu">
                        <li><a href="paginas/ato/cadastrar_ato.php">Incluir</a></li>
                        <li><a href=#>Excluir</a></li>
                        <li><a href="#">Editar</a></li>
                    </ul>
                </li>
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
