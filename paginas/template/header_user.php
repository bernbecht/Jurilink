<?php
session_start();

if(!isset($_SESSION['usuario'])) header("location:main.php");
if ($_SESSION['tipo_usuario'] == 2) header("location:../../logout.php");
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
                    <a  class="brand" href="../pessoa/view_user.php">JuriLink</a>  
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
                <li class="" id="inicio"><a href="../pessoa/view_user.php">Inicio</a></li>
                
            </ul>           
        </div>
