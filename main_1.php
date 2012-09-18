
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>teste login</title>

        <title>JuriLink ~ Basic</title>       
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="bootstrap/css/jurilink.css" />  

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
                    <form action="login.php" method="post">
                        <fieldset>
                            <div class="page-header page_header_login">
                                <h1>
                                    <b>Login</b>
                                </h1>
                            </div>
                            <div class="row">
                                <div class="span5">
                                    <div id="usuario" class="control-group">
                                        <label class="control-label" for="usuario">Numero Unificado</label>
                                        <div class="controls">
                                            <input type="text" class="input-xlarge aviso" id=usuario_input" name="usuario">                       
                                                <span  class="help-inline "></span>                    
                                        </div>
                                    </div>    
                                </div>
                            </div>

                            <div class="row">
                                <div class="span5">
                                    <div id="senha" class="control-group">
                                        <label class="control-label" for="senha">Senha</label>
                                        <div class="controls">
                                            <input type="text" class="input-xlarge aviso" id=senha_input" name="senha">                       
                                                <span  class="help-inline "></span>                    
                                        </div>
                                    </div>    
                                </div>
                            </div>

                            <div class="row">
                                <div class="span5">
                                    <div id="senha" class="control-group">
                                        <label class="control-label" for="senha">
                                            <button type='button' class="btn btn-primary">Entrar </button>
                                        </label>


                                    </div>  
                                </div>
                            </div>




                        </fieldset>
                    </form>
                </div>
            </div>




    </body>
</html>