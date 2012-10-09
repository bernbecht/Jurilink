
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       

        <title>JuriLink - Login</title>       
        <link rel="stylesheet" href="jurilink/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="jurilink/bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="jurilink/bootstrap/css/jurilink.css" />  

    </head>

    <body class="body_login">
        <div class="navbar navbar-fixed-top ">
            <div class="navbar-inner">
                <div class="container">
                    <a  class="brand" href="#">JuriLink</a>  
                </div>
            </div>
        </div>

        <div class="container container_login content">


            <div class="well">
                <div>

                    <div class="page-header page_header_login">
                        <h1>
                            <b>Login</b>
                        </h1>
                    </div>

                    <div id="msg_resultado">

                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <form id ="form_login" action="jurilink/login.php" method="post">
                                <fieldset>
                                    <div class="row">
                                        <div class="span5">
                                            <div id="usuario" class="control-group">
                                                <label class="control-label" for="usuario">Login</label>
                                                <div class="controls">
                                                    <input type="text" class="input-xlarge aviso" id=usuario_input" name="usuario">                       
                                                        <span  class="help-inline "></span>                    
                                                </div>
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="span5">
                                            <div id="password" class="control-group">
                                                <label class="control-label" for="password">Senha</label>
                                                <div class="controls">
                                                    <input type="password" class="input-xlarge aviso" id=senha_input" name="senha">                       
                                                        <span  class="help-inline "></span>                    
                                                </div>
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="span7">
                                            <div id="" class="control-group">
                                                <label class="control-label" for="snha">
                                                    <button type='button' id="submit-login" class="btn btn-primary">Entrar </button>
                                                </label>


                                            </div>  
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        
                        <div class="span6">
                            <div class="alert alert-info">
                                <p>
                                    <h3>Esqueceu a senha?</h3>
                                    Não se preocupe. Mandamos outra para você. Basta clicar no botão abaixo e digitar o e-mail que está cadastrado no sistema.                                  
                                </p>
                                <p id='campo_recuperar_senha'>
                                    <button id="lembrar_senha_button" type="button" class="btn btn-primary">Recuperar Senha</button>
									
									
                                </p>
                            </div>
                        </div>                                
                    </div>
                </div>
            </div>
    </body>
     <!------ Scripts -->

        <script type="text/javascript" src="jurilink/drag/src/prototype.js"></script>
        <script type="text/javascript"  src="jurilink/drag/src/scriptaculous.js" ></script> 
        <script type="text/javascript" src="jurilink/bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="jurilink/bootstrap/js/bootstrap.js"></script>    
        <script type="text/javascript" src="jurilink/jurilink_js.js"></script>    

        <script type="text/javascript">                                                        
                              
        </script>
</html>