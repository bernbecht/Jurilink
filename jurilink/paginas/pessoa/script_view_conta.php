<script type="text/javascript">
    
    //Função que manda o formulário de alteração de senha por AJAX
    function senhaAjax(){
    
        var $form = $a( '.trocaSenha' ),
        nova_senha = $form.find( 'input[name = "nova_senha"]').val(),
        id_pessoa = $form.find('input[name="id_pessoa"]').val(),
        tipo = $form.find('input[name="tipo_usuario"]').val(),
        url = $form.attr( 'action' );
    
    
        $a('<img id="loading_img" src="../../bootstrap/img/loading.gif" height="36" width="36" />').appendTo('#loading_content_senha'); // appendTo é pra por em algum lugar
    
        $a.post(url,{
            id_pessoa:id_pessoa,
            nova_senha:nova_senha        
        },function(data){ 
            $a('#loading_img').remove();
            $a('.alert').remove();
            if(data == 1){
                $a('<div class="alert alert-success fade in"><p>Senha alterada com sucesso.</p></div>').appendTo('#msg_resultado_confirma_senha'); // appendTo é pra por em algum lugar
            
                setTimeout(function() {
                    $a('.edit-conta').removeAttr('disabled');
                    $a('#myModal').modal('hide');
                }, 2500);          
            }
            else{           
                $a('<div class="alert alert-error fade in"><p>Não foi possível alterar seus dados.</p></div>').appendTo('#msg_resultado_confirma_senha'); // appendTo é pra por em algum lugar
        
                $a('.troca-senha').removeAttr('disabled');
                $a(".troca-senha").removeClass('disabled');
            }         
        });
    }


    //Função que manda o form de edição de conta por AJAX
    function contaAjax(){
        var $form = $a( '.editConta' ),
        id_pessoa = $form.find('input[name="id_pessoa"]').val(),
        email = $form.find( 'input[name = "email"]').val(),
        tel = $form.find('input[name="telefone"]').val(),
        endereco = $form.find('input[name="endereco"]').val(),
        bairro = $form.find('input[name="bairro"]').val(),
        cidade = $form.find('input[name="cidade"]').val(),
        estado = $form.find( 'option').filter(':selected' ).val(),
        tipo = $form.find('input[name="tipo_usuario"]').val(),
        url = $form.attr( 'action' );
    
        $a('<img id="loading_img" src="../../bootstrap/img/loading.gif" height="36" width="36" />').appendTo('#loading_content'); // appendTo é pra por em algum lugar
        $a.post(url,{
            id_pessoa:id_pessoa,
            email:email,
            tel:tel,
            endereco:endereco,
            bairro:bairro,
            cidade:cidade,
            estado:estado
        },function(data){ 
            $a('#loading_img').remove();
            subirPagina();
            $a('.alert').remove();
            if(data == 1){
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>Seus dados foram alterados com sucesso.</p></div>').appendTo('#msg_resultado_confirma_senha'); // appendTo é pra por em algum lugar

                setTimeout(function() {
                    $a('.edit-conta').removeAttr('disabled');
                    $a('#myModal').modal('hide');
                }, 2500);          
            }
            else{
                $a('<div class="alert alert-error fade in"><p>Não foi possível alterar seus dados.</p></div>').appendTo('#msg_resultado_confirma_senha'); // appendTo é pra por em algum lugar
                $a('.edit-conta').removeAttr('disabled');
                $a(".edit-conta").removeClass('disabled');
           
                               
            }
        });
    }
    
    function checa_senhaAjax(modalidade){
    
        var $form = $a( '.checa_senha_AjaxForm' ),
        senha_digitada = $form.find( 'input[name = "senha"]').val(),
        url = $form.attr( 'action' );
    
        $a.post(url,{
            senha_digitada:senha_digitada
        },function(data){ 
            if (data == 1){
                limparForm('.checa_senha_AjaxForm');               
            
                //Alterar dados da conta
                if (modalidade == 0){
                    $a('#loading_img').remove();
                    contaAjax();
                }
                //Alterar Senha
                if(modalidade == 1){
                    $a('#loading_img').remove();
                    senhaAjax();
                }
            }
        
            else {
                $a('.alert').remove();
                $a('<div class="alert alert-error fade in"><p>Senha inválida</p></div>').appendTo('#msg_resultado_confirma_senha'); // appendTo é pra por em algum lugar
                $a('#senha_atual_input').focus();
            
            }
        
        });

    }


    function checa_senha(modalidade){
        $a('#myModal').modal('show');
        $a('#senha_atual_input').focus();
        $a(".checa-senha").click(function(){ 
            checa_senhaAjax(modalidade);
        });
    } 
    
    function validaFormEditConta(){
    $a('.alert').remove();

    var intRegex = /^\d+$/;
    
    var $form = $a( '.editConta' ),
    id_pessoa = $form.find('input[name="id_pessoa"]').val(),
    email = $form.find( 'input[name = "email"]').val(),
    tel = $form.find('input[name="telefone"]').val(),
    endereco = $form.find('input[name="endereco"]').val(),
    bairro = $form.find('input[name="bairro"]').val(),
    cidade = $form.find('input[name="cidade"]').val(),
    estado = $form.find( 'option').filter(':selected' ).val();
    var mandar = true;
    if(tel.length != 0){             //Se foi digitado um telefone, deve acontecer a validação
        if(tel.length  == 8){            
            if(intRegex.test(tel)) {
                $a('#telefone').removeClass("error").addClass("");            
            }
            
            else{
                $a('#telefone').removeClass("").addClass("error");
                mandar =false;
            }
        
        
        }   
        else if (tel.length  == 10){
            if(intRegex.test(tel)) {
                $a('#telefone').removeClass("error").addClass("");            
            }
            
            else{
                $a('#telefone').removeClass("").addClass("error");
                mandar =false;
            } 
        }
        else if(tel.length!=8 && tel.length!=10){
            $a('#telefone').removeClass("").addClass("error");
            mandar =false;
            
        }
    }
    if(email.length  < 7){
        $a('#email').removeClass("").addClass("error"); 
        mandar =false;
    }
    else{
        $a('#email').removeClass("error").addClass("");
    }
    if(cidade.length <=2){
        $a('#cidade').removeClass("control-group").addClass("control-group error");  
        mandar =false;
    }
    
    else{
        $a('#cidade').removeClass("control-group error").addClass("control-group");  
    }
        
    if(estado == -1){            
        $a('#estado').removeClass("control-group").addClass("control-group error");  
        mandar =false;
    }        
    else{
        $a('#estado').removeClass("control-group error").addClass("control-group");  
    }
            
    if (endereco.length > 0){ //Se endereço for digitado, faz a validação
        if(endereco.length <=2){
            $a('#endereco').removeClass("control-group").addClass("control-group error");  
            mandar =false;
        }
    
        else{
            $a('#endereco').removeClass("control-group error").addClass("control-group");  
        }
    }
     
    if (bairro.length > 0){
        if(bairro.length <=2){
            $a('#bairro').removeClass("").addClass("error");  
            mandar =false;
        }        
        else{
            $a('#bairro').removeClass("error").addClass("control-group");  
        }
    }
    return mandar;        
}

function validaFormTrocaSenha(){
    var $form = $a( '.trocaSenha' ),
    nova_senha = $form.find( 'input[name = "nova_senha"]').val(),
    c_nova_senha = $form.find('input[name="c_nova_senha"]').val();
    
    
    var mandar = true;
    
    //Se forem diferentes
    if (nova_senha!=c_nova_senha){
        $a('.alert').remove();
        $a('<div class="alert alert-error fade in"><p>Senhas diferentes</p></div>').appendTo('#msg_resultado_senha'); // appendTo é pra por em algum lugar
        $a('#c_nova_senha').removeClass("control-group").addClass("control-group error"); 
        $a('#nova_senha').removeClass("control-group").addClass("control-group error"); 
        mandar = false;
    }
    //Se forem iguais
    else {
        $a('.alert').remove();
        $a('nova_senha').removeClass("control-group error").addClass("control-group");  
        $a('c_nova_senha').removeClass("control-group error").addClass("control-group");          
        if(nova_senha.length <8){
            $a('.alert').remove();
             $a('<div class="alert alert-error fade in"><p>A senha deve conter pelo menos 8 dígitos.</p></div>').appendTo('#msg_resultado_senha'); // appendTo é pra por em algum lugar
            $a('#nova_senha').removeClass("control-group").addClass("control-group error"); 
            $a('#c_nova_senha').removeClass("control-group").addClass("control-group error"); 
            mandar =false;
        }        
        else{
            $a('.alert').remove();
            $a('#nova_senha').removeClass("control-group error").addClass("control-group");  
            $a('#c_nova_senha').removeClass("control-group error").addClass("control-group");  
        }
    }
    return mandar;
}


    function validaFormSenha(){
        $a(".troca-senha").click(function(){ 
            var mandar = validaFormTrocaSenha();
                
            if(mandar==true){            
                //impedir duplo clique
                /*$a('.troca-senha').attr('disabled','disabled');
            $a(".troca-senha").addClass('disabled');
                 */
                checa_senha(1);
            }        
        });
    
    }

    function validaFormConta(){
        //Apertar botão para Salvar alterações
        $a(".edit-conta").click(function(){
        
            var mandar = validaFormEditConta();
        
            if(mandar == true){
                //impedir duplo clique
                /* $a('.edit-conta').attr('disabled','disabled');
            $a(".edit-conta").addClass('disabled');*/
                checa_senha(0);
            
            
            }
        });
     
    }
    
    function removeAlertaModalChecaSenha(){
        
        $a("#enviar").click(function(){
            $a('.alert').remove();
        });
    }
    
    
    $a(document).ready(function (){   
        
        removeAlertaModalChecaSenha();
        validaFormConta();
 
    
    }); 


</script>
