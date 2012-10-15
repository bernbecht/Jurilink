//Variável para evitar conflito JQUERY ~ PROTOTYPE
var $a = jQuery.noConflict();

function mandarSenhaEmail(){
    var email = $a('#email_input').val();
    var url = 'jurilink/paginas/operacoes/Login/lembrar_senha_op.php';
	
    $a('<img id="loading_img" src="jurilink/bootstrap/img/loading.gif" height="36" width="36" />').appendTo('#campo_recuperar_senha'); // appendTo é pra por em algum lugar                
	
    $a('#cancelar_email').remove();	
    $a('#enviar_email').remove();
    $a('#email_input').remove();
			
			
	
    $a.post(url,{
        email:email
    },function(data){
        $a('#loading_img').remove();
	
        $a('<button id="lembrar_senha_button" type="button" class="btn btn-primary">Recuperar Senha</button>').appendTo('#campo_recuperar_senha');
        esqueci_senha();
    });
	

}

function esqueciSenhaSubmit(){
    var email = $a('#email_input').val();
    var mandar = true;
	
    if(email.length <5){	
        $a('#email_input').addClass('erro_input');
        mandar = false;
    }
    else{
        $a('#email_input').removeClass('erro_input');	
    }
	
    return mandar;
}

function esqueci_senha_botões(){
    $a('#enviar_email').click(function(){
        var mandar = esqueciSenhaSubmit();
        if(mandar == true){
		
            mandarSenhaEmail();
        }
    });
    $a('#cancelar_email').click(function(){
        $a(this).remove();
        $a('#enviar_email').remove();
        $a('#email_input').remove();
        $a('<button id="lembrar_senha_button" type="button" class="btn btn-primary">Recuperar Senha</button>').appendTo('#campo_recuperar_senha');
        esqueci_senha();
    });
}

function esqueci_senha(){
    $a('.recuperar_senha').hide();

    $a('#lembrar_senha_button').click(function(){
        $a('<input type="text" class="input-xlarge recuperar_senha"  id="email_input" name="email"><button id="enviar_email" type="button" class="btn btn-primary recuperar_senha">Enviar</button><button id="cancelar_email" type="button" class="btn recuperar_senha">Cancelar</button>').appendTo('#campo_recuperar_senha');
        $a(this).remove();
        esqueci_senha_botões();
    });

}



function loginAjax(){   
    
    var $form = $a('#form_login'),
    usuario = $form.find( 'input[name="usuario"]' ).val(),
    senha = $form.find( 'input[name="senha"]' ).val(),
    url = $form.attr( 'action' );
    
    $a.post(url,{
        usuario:usuario,
        senha:senha           
    },function(data){
        //alert(data);
        $a('#alert_login').remove();
        if(data == 0){
            //limparForm('.pessoaAjaxForm');
            $a('#submit-login').removeAttr('disabled');
            $a("#submit-login").removeClass('disabled');
            $a('<div id="alert_login" class="alert alert-error fade in"><p><b>Usuário</b> ou <b>Senha </b> deve estar incorreto.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar           
        }
        else if(data==1){
            $a(window.document.location).attr('href','jurilink/index.php');
        }
        else if(data == 2){
            $a(window.document.location).attr('href','jurilink/paginas/pessoa/view_user.php');
        }
    });
}

function validaFormLoginSubmit(){
    
    $a('#alert_login').remove();
    
    var dataRegex = /^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/;
    
    var $form = $a('#form_login'),
    usuario = $form.find( 'input[name="usuario"]' ).val(),
    senha = $form.find( 'input[name="senha"]' ).val();
    
    var mandar = true;
    
    if(usuario.length <=5){
        $a('#usuario').removeClass("control-group").addClass("control-group error"); 
        mandar =false;
    }        
    else{
        $a('#usuario').removeClass("control-group error").addClass("control-group");  
    }
    
    if(senha.length <1){
        $a('#password').removeClass("control-group").addClass("control-group error"); 
        mandar =false;
    }        
    else{
        $a('#password').removeClass("control-group error").addClass("control-group");  
    }
    
    return mandar;
        
    
    
}

function validaFormLoginJS(){    

    //Apertar o botão para login
    $a("#submit-login").click(function(){ 
        var mandar = validaFormLoginSubmit();  
        subirPagina();     
         
        if(mandar==true){            
            
            //impedir duplo clique
            $a('.submit-login').attr('disabled','disabled');
            $a(".submit-login").addClass('disabled');
            loginAjax();
           
        }
        
        else{
            $a('<div id="alert_login" class="alert alert-error fade in"><p><b>Usuário</b> ou <b>Senha</b> deve estar incorreto.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar           
        }
    });  
}

//Inicializa o form de cadastro de pessoa
function initFormPessoa(){
    $a("#nome_input").focus();
//$a('#senha').hide();
}

//faz uma pagina inteira subir
function subirPagina(){
    $a('body,html').animate({
        scrollTop: 0
    }, 500);
    return false;
}

//faz uma pagina inteira subir
function subirModal(){
    $a('.modal-body').animate({
        scrollTop: 0
    }, 500);
    return false;
}


//função que limpa formulário. Deve ser mandado o form como parâmetro
function limparForm(form){
    
    $a(form).find(':input').each(function(){
        switch(this.type){
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $a(this).val('');
                break;
            
            case 'checkbox':
            case 'radio':
                this.checked = false;                
        }
    });    
}

//função que trata os erros que vem do BD na hora de cadastrar no sistema
//e mostra de forma estilizada
function msgErroBD(data){
    data_aux = data;
    var data_split_rg = data.split(' ');
    var data_split = null;
    data_split = data_aux.split('\n');
    if(data_split != null)
        var split1 = data_split[0].split(' ');
                
    //alert(data_split_rg);
    //alert(split1);
               
    $a('.alert').remove();
    if(data_split_rg[11]=='"check_cpf"'){
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>CPF</b> digitado eh invalido.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#cpf').removeClass("").addClass("error");
    }
    else if(data_split_rg[2]=="RG"){
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>RG</b> digitado ja foi cadastrado.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#rg').removeClass("").addClass("error");
    }
                
    else if(split1[11]=='"check_cpf"'){
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>CPF</b> digitado eh invalido.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#cpf').removeClass("").addClass("error");
    }
               
    else if(split1[12]=='"email_unico"'){
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>E-MAIL</b> digitado ja esta em uso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#email').removeClass("").addClass("error");
    }
    else if(split1[12]=='"indice_cnpj"'){
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>CNPJ</b> digitado ja esta em uso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#cnpj').removeClass("").addClass("error"); 
    } 
    else if(split1[11]=='"indice_cnpj"'){
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>CNPJ</b> digitado ja esta em uso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#cnpj').removeClass("").addClass("error"); 
    } 
    else if(split1[12]=='"indice_cpf"'){        
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>CPF</b> digitado ja esta em uso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#cpf').removeClass("").addClass("error");
    } 
    else if(split1[11]=='"indice_cpf"'){
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>CPF</b> digitado ja esta em uso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#cpf').removeClass("").addClass("error");
    } 
    else if(data_split[11]=='"rg_tamanho"'){
        $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>RG</b> digitado e invalido.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('#rg').removeClass("").addClass("error");
    }
                
    else{
        $a('<div class="alert alert-error fade in">'+data_split[7]+data+'</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('<div class="alert alert-error fade in">'+split1[9]+'</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
                    
    }    
}


function atoAjax(modalidade){
    var $form = $a( '.AtoAjaxForm' ),
    id_ato = $form.find( 'option').filter(':selected' ).val(),
    id_processo = $form.find( 'input[name="id_processo"]' ).val(),
    url = $form.attr( 'action' );
    
    $a('.submit-ato-modal').attr('disabled','disabled');
    $a(".submit-ato-modal").addClass('disabled');
    $a('<img id="loading_img" src="../../bootstrap/img/loading.gif" height="27" width="27" />').appendTo('#loading_content'); // appendTo é pra por em algum lugar                
    
    $a.post(url,{
        id_ato:id_ato,
        id_processo:id_processo
    },function(data){ 
        $a("#loading_img").remove();
        //alert(data);
        if (data == 1){
            $a('<div id="alert_ato" class="alert alert-success fade in"><p>O ato foi inserido no sistema com sucesso.</p></div>').appendTo('#msg_resultado_ato'); // appendTo é pra por em algum lugar                
            
            //espera um tempo e desliga a modal
            setTimeout(function() {
                loadAtos();
                $a('#myModal').modal('hide');
                limparForm('#form_atualiza_ato');
                $a('#alert_ato').remove();
                $a('.submit-ato-modal').removeAttr('disabled');
                $a(".submit-ato-modal").removeClass('disabled');                
            }, 2500); 
        }//if        
       
        
        else if(data==0){
            $a('<div id="alert_ato" class="alert alert-danger fade in"><p>O <b>ato</b> não pode ser incluído no sistema. Verifique se ele já não foi cadastrado anteriormente.</p></div>').appendTo('#msg_resultado_ato'); // appendTo é pra por em algum lugar                
            $a('.submit-ato-modal').removeAttr('disabled');
            $a(".submit-ato-modal").removeClass('disabled');
        }
        
        else {
            $a('<div id="alert_ato" class="alert alert-warning fade in"><p>Não foi possível localizar o <b>e-mail</b> do cliente. O ato será gravado no sistema mas o cliente não será notificado.</p></div>').appendTo('#msg_resultado_ato'); // appendTo é pra por em algum lugar                
            setTimeout(function() {
                loadAtos();
                $a('#myModal').modal('hide');
                limparForm('#form_atualiza_ato');
                $a('#alert_ato').remove();
                $a('.submit-ato-modal').removeAttr('disabled');
                $a(".submit-ato-modal").removeClass('disabled');                
            }, 2900); 
        }
        
        
    });
    
    
}

function audienciaAjax(modalidade){
    var $form = $a( '.AudienciaAjaxForm' ),
    id_processo = $form.find( 'input[name="id_processo"]' ).val(),
    tipo_audiencia = $form.find( 'input[name="tipo_audiencia"]' ).val(),
    data_audiencia = $form.find( 'input[name="data_audiencia"]' ).val(),
    local = $form.find( 'input[name="local"]' ).val(),
    url = $form.attr( 'action' );
    
    $a('.submit-audiencia-modal').attr('disabled','disabled');
    $a(".submit-audiencia-modal").addClass('disabled');
    
    
    
    
    
    $a.post(url,{
        id_processo:id_processo,
        tipo_audiencia:tipo_audiencia,
        data_audiencia:data_audiencia,
        local:local
    },function(data){        

        if (data==1){
            $a('<div id="alert_audiencia" class="alert alert-success fade in"><p>A audiencia foi inserida no sistema com sucesso.</p></div>').appendTo('#msg_resultado_audiencia'); // appendTo é pra por em algum lugar                
            
            //espera um tempo e desliga a modal
            setTimeout(function() {
                loadAudiencia();
                $a('#audienciaModal').modal('toggle');
                limparForm('#form_atualiza_audiencia');
                $a('#alert_audiencia').remove();                
                $a('.submit-audiencia-modal').removeAttr('disabled');
                $a(".submit-audiencia-modal").removeClass('disabled');    
                
            }, 2000);
        }//if
        else{
           
            $a('<div id="alert_audiencia" class="alert alert-danger fade in"><p>Não foi possível inserir audiência. Verifique se a <b>data da audiência</b> é anterior a <b>data de distribuição.</b></p></div>').appendTo('#msg_resultado_audiencia'); // appendTo é pra por em algum lugar                
        
            $a('.submit-audiencia-modal').removeAttr('disabled');
            $a(".submit-audiencia-modal").removeClass('disabled');
        }
    });
    
}

//Função que manda o form de cadastro de pessoa por AJAX
function pessoaAjax(modalidade){
    var $form = $a( '.pessoaAjaxForm' ),
    id_pessoa = $form.find( 'input[name="id_pessoa"]' ).val(),
    nome = $form.find( 'input[name="nome"]' ).val(),
    tipo = $form.find( 'input[name="tipo"]' ).val(),
    oab = $form.find( 'input[name="oab"]' ).val(),
    cnpj = $form.find( 'input[name="cnpj"]' ).val(),
    cpf = $form.find( 'input[name="cpf"]' ).val(),
    rg = $form.find( 'input[name="rg"]' ).val(),
    comarca = $form.find( 'input[name="comarca"]' ).val(),
    cidade = $form.find( 'input[name="cidade"]' ).val(),
    endereco = $form.find( 'input[name="endereco"]' ).val(),
    bairro = $form.find( 'input[name="bairro"]' ).val(),
    estado = $form.find( 'option').filter(':selected' ).val(),
    tel = $form.find( 'input[name="telefone"]' ).val(),
    email = $form.find( 'input[name="email"]' ).val(),
    user = $form.find( 'input[name="userCheckbox"]:checked' ).val(),           
    url = $form.attr( 'action' );
    
    var id_pessoa = $a('#id').val();
     
    $a('<img id="loading_img" src="../../bootstrap/img/loading.gif" height="36" width="36" />').appendTo('#loading_content'); // appendTo é pra por em algum lugar                
    
       
       
    $a.post(url,{
        id_pessoa:id_pessoa,
        nome:nome,
        tipo:tipo,
        oab:oab,
        cnpj:cnpj,
        cpf:cpf,
        rg:rg,
        comarca:comarca,
        cidade:cidade,
        endereco:endereco,
        bairro:bairro,
        estado:estado,
        telefone:tel,
        email:email,
        userCheckbox:user,
        id_pessoa:id_pessoa
        
    },function(data){ 
        
        $a('#loading_img').remove();
        
        if(modalidade==0){
            if(data==1){
            
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>A pessoa <b>'+nome+'</b> foi inserida no sistema com sucesso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
                
                //limparForm('.pessoaAjaxForm');
                
                subirPagina();
        
                //pega o endereço da pagina
                var href = location.href;
      
                //separa num array os valores divididos por um '_'        
                href_split = href.split('_');
        
                //alert(href_split);
                var url = "relacao_"+href_split[1];
                //alert(url);   
                           
                setTimeout(function() {
                    limparForm('.pessoaAjaxForm');
                    $a('.submit-pessoa').removeAttr('disabled');
                    $a(".submit-pessoa").removeClass('disabled');
                    $a(window.document.location).attr('href',url);

                }, 3000);          
            }
            
            else{
                //alert("Else 0");
                //alert(data);
                msgErroBD(data);
                $a('.submit-pessoa').removeAttr('disabled');
                $a(".submit-pessoa").removeClass('disabled');
                subirPagina();
                               
            }
        }
        
        //modalidade de adicionar outra pessoa
        else if(modalidade==1){
            if(data==1){
                
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>A pessoa <b>'+nome+'</b> foi inserida no sistema com sucesso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar                
                limparForm('.pessoaAjaxForm');
                initFormPessoa();
                subirPagina();
                $a('.submit-outra-pessoa').removeAttr('disabled');
                $a(".submit-outra-pessoa").removeClass('disabled');
                  
            }
            else{
                //alert("Else 1");
                //alert(data);
                msgErroBD(data);
                $a('.submit-outra-pessoa').removeAttr('disabled');
                $a(".submit-outra-pessoa").removeClass('disabled');
                subirPagina();
            }
        }
        
        //modalidade de modal
        else if(modalidade==2){
            if(data==1){
            
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>A pessoa <b>'+nome+'</b> foi inserida no sistema com sucesso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar                
                limparForm('.pessoaAjaxForm');  
                
                //pega o valor do campo HIDDEN CAMPO-MODAL no 
                //form de processo para saber onde colocar o nome
                //depois de um inserção bem sucedida
                var $form = $a( '#form_processo' ),
                pessoa = $form.find( 'input[name="campo-modal"]' ).val();
                
                var nome_campo = nome +',';
                
                if(pessoa==0){
                    $a('#autor_input').val(nome_campo);
                }
                else if(pessoa==1){
                    $a('#reu_input').val(nome_campo);
                }
                
                else if(pessoa==2){
                    $a('#autor_ad_input').val(nome_campo);
                }
                
                else if(pessoa==3){
                    $a('#reu_ad_input').val(nome_campo);
                }
                
                else if(pessoa==4){
                    $a('#autor_rep_input').val(nome_campo);
                }
                
                else if(pessoa==5){
                    $a('#reu_rep_input').val(nome_campo);
                }
                
                subirModal();
                
                setTimeout(function() {
                    $a('.submit-pessoa-modal').removeAttr('disabled');
                    $a(".submit-pessoa-modal").removeClass('disabled');
                    $a('#myModal').modal('toggle');

                }, 3000);   
               
            }
            else{
                //alert("Else 1");
                //alert(data);
                msgErroBD(data);
                $a('.submit-pessoa-modal').removeAttr('disabled');
                $a(".submit-pessoa-modal").removeClass('disabled'); 
                subirModal();
                
            }
        }
        
        //modalidade de editar uma pessoa
        else if(modalidade==3){
            
            if(data==1){
                
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>A pessoa <b>'+nome+'</b> foi editada no sistema com sucesso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
                
                //limparForm('.pessoaAjaxForm');
                
                subirPagina();
        
                //pega o endereço da pagina
                href = location.href;
      
                //separa num array os valores divididos por um '_'        
                href_split = href.split('?');
                
                href_aux = href_split[0].split('_');
                
                //alert(href_aux[1]);
                
                if(href_aux[1] == 'pfisica.php')
                    url = "view_pessoafisica.php?"+href_split[1];
                
                else if(href_aux[1] == 'pjuridica.php')
                    url = "view_pessoajuridica.php?"+href_split[1];
                else
                    url = "view_advogado.php?"+href_split[1];
                 
                //alert(url);
                           
                setTimeout(function() {
                    
                    $a('.editar-pessoa').removeAttr('disabled');
                    $a(".editar-pessoa").removeClass('disabled');
                    $a(window.document.location).attr('href',url);

                }, 3000);          
            }
            
            else{
                //alert("Else 0");
                //alert(data);
                msgErroBD(data);
                $a('.editar-pessoa').removeAttr('disabled');
                $a(".editar-pessoa").removeClass('disabled');
                subirPagina();
                               
            }
        }
        
        
        
        
    });  
    
}


//Função que diz qual NAV está selecionada
function trocarAbaSubnav(){
    
    //pega o endereço da pagina
    var href = location.href;
      
    //separa num array os valores divididos por um '/'
    href_split = href.split('/');
      
    //pega a PASTA da página  
    var pagina = href_split[5];
    
    $a('.active').removeClass('active');
    
    if(pagina == 'pessoa')
        $a('#pessoa').addClass('active');
    
    else if(pagina == 'processo')
        $a('#processo').addClass('active');
     
    else if(pagina == 'comarca' || pagina == 'juizo' || pagina == 'ato' 
        || pagina == 'natureza_acao')
        $a('#dados').addClass('active');
    
    else
        $a('#inicio').addClass('active');    
 
}

/*Função que valida o form de ato no evento submit*/
function validaFormAtoSubmit(){
    $a('#alert_ato').remove();
    
    var intRegex = /^\d+$/;
    var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    
    var $form = $a( '.AtoAjaxForm' ),
    id_ato = $form.find( 'option').filter(':selected' ).val(),
    id_processo = $form.find( 'input[name="id_processo"]' ).val();
    var mandar = true;
        
    if(id_ato == -1){            
        $a('#ato').removeClass("control-group").addClass("control-group error");  
        mandar =false;
    }
    
    if(id_processo == -1){            
        $a('#id_processo').removeClass("control-group").addClass("control-group error");  
        mandar =false;
    }
    
    return mandar;
}

function validaFormAudienciaSubmit(){
    $a('#alert_audiencia').remove();
    
    var dataRegex = /^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/;
    
    var $form = $a('.AudienciaAjaxForm'),
    tipo_audiencia = $form.find( 'input[name="tipo_audiencia"]' ).val(),
    data_audiencia = $form.find( 'input[name="data_audiencia"]' ).val(),
    local = $form.find( 'input[name="local"]' ).val(),
    id_processo = $form.find( '.input[name="id_processo"]' ).val();
    
    var mandar = true;
    
    if(tipo_audiencia.length <=2){
        $a('#tipo_audiencia').removeClass("control-group").addClass("control-group error"); 
        mandar =false;
    }        
    else{
        $a('#tipo_audiencia').removeClass("control-group error").addClass("control-group");  
    }
        
    /*********************************************************************************************************/
    if(dataRegex.test(data_audiencia)) {
        $a('#data_audiencia').removeClass("error");             
    }
    else{
        $a('#data_audiencia').removeClass("").addClass("error");
        if(focus==false){
            $a('#data_audiencia_input').focus();
            focus=true;
        }
        mandar =false;
    }
        
        
    
    if(local.length <=2){
        $a('#local').removeClass("control-group").addClass("control-group error"); 
        mandar =false;
    }        
    else{
        $a('#local').removeClass("control-group error").addClass("control-group");  
    }

    return mandar;
}

/*Função que valida o form de Pessoa no evento SUBMIT*/
function validaFormPessoaSubmit(){
    
    //alert("SUBMIT");
    $a('.alert').remove();
    
    var intRegex = /^\d+$/;
    var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    
    var $form = $a( '.pessoaAjaxForm' ),
    nome = $form.find( 'input[name="nome"]' ).val(),
    tipo = $form.find( 'input[name="tipo"]' ).val(),
    oab = $form.find( 'input[name="oab"]' ).val(),
    cnpj = $form.find( 'input[name="cnpj"]' ).val(),
    cpf = $form.find( 'input[name="cpf"]' ).val(),
    rg = $form.find( 'input[name="rg"]' ).val(),
    comarca = $form.find( 'input[name="comarca"]' ).val(),
    cidade = $form.find( 'input[name="cidade"]' ).val(),
    endereco = $form.find( 'input[name="endereco"]' ).val(),
    bairro = $form.find( 'input[name="bairro"]' ).val(),
    estado = $form.find( 'option').filter(':selected' ).val(),
    tel = $form.find( 'input[name="telefone"]' ).val(),
    email = $form.find( 'input[name="email"]' ).val(),
    user = $form.find( 'input[name="userCheckbox"]:checked' ).val(),
    senha = $form.find( 'input[name="senha"]' ).val(),
    id_pessoa = $form.find('input[name="id_pessoa"]').val();
        
    var mandar = true;
        
    if(nome.length <=2){
        $a('#nome').removeClass("control-group").addClass("control-group error"); 
        mandar =false;
    }        
    else{
        $a('#nome').removeClass("control-group error").addClass("control-group");  
    }
        
    if(endereco.length <=2){
        $a('#endereco').removeClass("control-group").addClass("control-group error");  
        mandar =false;
    }        
    else{
        $a('#endereco').removeClass("control-group error").addClass("control-group");  
    }
        
    if(bairro.length <=2){
        $a('#bairro').removeClass("control-group").addClass("control-group error");  
        mandar =false;
    }        
    else{
        $a('#bairro').removeClass("control-group error").addClass("control-group");  
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
    else{
        $a('#telefone').removeClass("success").addClass("error");  
        mandar =false;            
    }


               
    if(user == 1){
        if(email.length  < 7){
            $a('#email').removeClass("").addClass("error"); 
            mandar =false;
        }
        else{
            $a('#email').removeClass("error").addClass("");
        }
            
        
    }
    else{
        if(email.length  > 0){ 
            if(email.length  < 7){
                $a('#email').removeClass("").addClass("error"); 
                mandar =false;
            }
            else{
                $a('#email').removeClass("error").addClass("");
            }
        } 
        else{
            $a('#email').removeClass("error");
        }
    }
        
        
    if($a('#tipo_input').val() == 0 || $a('#tipo_input').val() == 2){           
                        
        if(cpf.length == 11){
            if(intRegex.test(cpf)) {
                $a('#cpf').removeClass("error").addClass("");            
            }
            
            else{
                $a('#cpf').removeClass("").addClass("error");
                mandar =false;
            }
        }             
        else{
            $a('#cpf').removeClass("").addClass("error");
            mandar =false;
        }
    }
        
    if($a('#tipo_input').val() == 0 || $a('#tipo_input').val() == 2){          
        
        if(rg.length >=7){
            if(intRegex.test(rg) || floatRegex.test(rg)) {
                $a('#rg').removeClass("error").addClass("");            
            }
            
            else{
                $a('#rg').removeClass("").addClass("error");
                mandar =false;
            }
        }             
        else{
            $a('#rg').removeClass("").addClass("error");
            mandar =false;
        }
    }
        
    if($a('#tipo_input').val() == 0 || $a('#tipo_input').val() == 2){          
        
        if(comarca.length >1){
                
            $a('#comarca').removeClass("error").addClass("");            
        }                
                         
        else{
            $a('#comarca').removeClass("").addClass("error");
            mandar =false;
        }        
    }
        
    if($a('#tipo_input').val() == 1){
       
        if(cnpj.length == 14){
            if(intRegex.test(cnpj) || floatRegex.test(cnpj)) {
                $a('#cnpj').removeClass("error").addClass("");            
            }
            
            else{
                $a('#cnpj').removeClass("").addClass("error");
                mandar =false;
            }
        }             
        else{
            $a('#cnpj').removeClass("").addClass("error");
            mandar =false;
        }
    }
        
    if($a('#tipo_input').val() == 2){
            
        if(oab.length > 3){
            if(intRegex.test(oab) || floatRegex.test(oab)){
                $a("#oab").removeClass('error').addClass('');
            }
            else{
                $a("#oab").removeClass('').addClass('error');
                mandar =false;
            }
        }             
        else{
            $a('#oab').removeClass("").addClass("error");
            mandar =false;
        }        
    }       
    
    
    
    return mandar;
    
}

function validaFormAudienciaJS(){  
    $a(".cancelar-modal").click(function(){
        limparForm('.AudienciaAjaxForm');
        
    });
    //Apertar o botão para incluir audiencia via modal

    $a(".submit-audiencia-modal").click(function(){       
        var mandar = validaFormAudienciaSubmit();  
        subirModal();
        if(mandar==true){
            audienciaAjax(0);
        }
        
        else{
        //alert(mandar);            
        }
    }); 
}

//Função que contém os eventos para validação do cadastro de uma pessoa
function validaFormPessoaJS(){  
    
    //botao que cancela  as operações do formulário de cadastro
    //redireciona para a página anterior
    $a(".cancelar").click(function(){
        
        limparForm('.pessoaAjaxForm');
        
        //pega o endereço da pagina
        var href = location.href;
      
        //separa num array os valores divididos por um '_'        
        href_split = href.split('_');
        
        //alert(href_split);
        var url = "relacao_"+href_split[1];
        //alert(url);       
        $a(window.document.location).attr('href',url);
    });
    
    //botão cancelar no form modal de pessoa em cadastrar processo
    $a(".cancelar-modal").click(function(){
        limparForm('.pessoaAjaxForm');
    });
     
    //Apertar o botão para incluir 1 pessoa
    $a(".submit-pessoa").click(function(){ 
        var mandar = validaFormPessoaSubmit();  
        subirPagina();
         
        if(mandar==true){            
            
            //impedir duplo clique
            $a('.submit-pessoa').attr('disabled','disabled');
            $a(".submit-pessoa").addClass('disabled');
            pessoaAjax(0);
           
        }
        
        else{
        //alert(mandar);            
        }
    });   
        
    
    //Apertar o botão para incluir + 1 pessoa
    $a(".submit-outra-pessoa").click(function(){ 
        var mandar = validaFormPessoaSubmit();  
        subirPagina();
        if(mandar==true){
            
            $a('.submit-outra-pessoa').attr('disabled','disabled');
            $a(".submit-outra-pessoa").addClass('disabled');
            pessoaAjax(1); 
        }
        
        else{
        //alert(mandar);            
            
        }
    }); 
    
    //Apertar o botão para incluir 1 pessoa no modal
    $a(".submit-pessoa-modal").click(function(){       
        var mandar = validaFormPessoaSubmit();  
        subirModal();
        if(mandar==true){
            $a('.submit-pessoa-modal').attr('disabled','disabled');
            $a(".submit-pessoa-modal").addClass('disabled');
            pessoaAjax(2);
        }
        
        else{
        //alert(mandar);            
        }
    }); 
    
    //Apertar o botão para editar uma pessoa
    $a(".edit-pessoa").click(function(){ 
        var mandar = validaFormPessoaSubmit();  
        subirPagina();
        if(mandar==true){
            $a('.edit-pessoa').attr('disabled','disabled');
            $a(".edit-pessoa").addClass('disabled');
            pessoaAjax(3);
        }
        
        else{
        //alert(mandar);            
        }
    });
}

/*function habilitarSenha(){
    
    $a('#senha').hide();
    
    $a('#userCheckbox').change(function(){
        var $form = $a( '.pessoaAjaxForm' ),
        user = $form.find( 'input[name="userCheckbox"]:checked' ).val();
        
        if(user == 1){
            $a('#senha').show();  
        }
        
        else{
            $a('#senha').hide();
        }
    }); 
}
 */

function botaoMaximizar(){
    
   
    $a(".maximizar").click(function(){
        
        var classe = $a(this).find("i").attr("class");
        
        if(classe == "icon-plus"){
            $a(this).find("i").removeClass("icon-plus").addClass("icon-minus");
        }
        else{
            $a(this).find("i").removeClass("icon-minus").addClass("icon-plus");
        }
    });
    
    $a(".maxi_main").click(function(){
        
        var classe = $a(this).find("i").attr("class");
        
        if(classe == "icon-plus"){
            $a(this).find("i").removeClass("icon-plus").addClass("icon-minus");
        }
        else{
            $a(this).find("i").removeClass("icon-minus").addClass("icon-plus");
        }
    });
}
   

function validaFormAtoJS(){
    
    //Apertar o botão para atualizar ato no modal de view_processo.php
    $a(".submit-ato-modal").click(function(){       
        var mandar = validaFormAtoSubmit();  
        if(mandar==true){
            atoAjax(0);
        }
        
        else{
        //alert(mandar);            
        }
    });    
    
}

//função que carrega os processos no grid no menu INICIO
function loadProcessosMain(){
    var id_pessoa = $a('#id_pessoa').val();
    var url ='paginas/operacoes/Main/getProcessosMain.php';
    $a('<img class="loading_img_processo" src="bootstrap/img/loading.gif" height="80" width="80" />').appendTo('#ultimos_processos'); // appendTo é pra por em algum lugar                
    
    $a.post(url,{
        id_pessoa:id_pessoa
    },function(data){
        $a('.loading_img_processo').remove();
        if(data==0){
            $a("<div id='alerta_ultimos_processos' class='alert alert-info'><p><h3>Não há processos cadastrados.</h3></p></div>").appendTo('#ultimos_processos');
        }
        else{
            $a('#alerta_ultimos_processos').remove();
            $a(data).appendTo('#ultimos_processos');
        }
    });
}//function

//função que carrega os processos no grid no menu INICIO
function loadAudienciasMain(){
    var id_pessoa = $a('#id_pessoa').val();
    var url ='paginas/operacoes/Main/getAudienciasMain.php';
    $a('<img class="loading_img_audiencia" src="bootstrap/img/loading.gif" height="80" width="80" />').appendTo('#ultimas_audiencias'); // appendTo é pra por em algum lugar                
    
    
    $a.post(url,{
        id_pessoa:id_pessoa
    },function(data){
        $a('.loading_img_audiencia').remove();
        if(data==0){
            $a("<div id='alerta_ultimas_audiencias' class='alert alert-info'><p><h3>Não há audiências cadastradas.</h3></p></div>").appendTo('#ultimas_audiencias');
        }
        else{
            $a('#alerta_ultimas_audiencias').remove();
            $a(data).appendTo('#ultimas_audiencias');
        }
    });
}//function

function tooltip(){
    $a('.tooltip_class').hover(
        function () {
            $a(this).tooltip('show');
        }, 
        function () {
         
            $a(this).tooltip('hide');
        }
        );
}

//Função de JQUERY
$a(document).ready(function(){   
    
    
    validaFormPessoaJS();
    trocarAbaSubnav();
    initFormPessoa();
    botaoMaximizar();
    // habilitarSenha();
    validaFormAtoJS();
    validaFormAudienciaJS();
    $a('.clear-form').click(function(){
        alert('limpar');
        limparForm('.pessoaAjaxForm');  
    });
    loadProcessosMain();
    loadAudienciasMain();
    validaFormLoginJS();
    tooltip();
    esqueci_senha();
  
    
 

});

//Função para limite de resultados em relações de pessoas físicas, jurídicas e advogados
function valor(){

    document.forms["num_resultados"].submit();

}
