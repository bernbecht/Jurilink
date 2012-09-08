//Variável para evitar conflito JQUERY ~ PROTOTYPE
var $a = jQuery.noConflict();

var id=666;

//Quando a janela carregar, executa iniDrag
//Não há () no iniDrag pq estou apenas referenciando e não executando a função
window.onload = iniDrag;
  
//Função executada ao carregamento da página   
function iniDrag(){
    
    //obtém um array com todos os objetos DIV
    var  divs =  document.getElementsByTagName('div');                        
    
                
    for( var i=0; i< divs.length ; i++){
        
        //se a div for da classe especificada
        if( divs[i].className == 'drag'){                      
                                    
            //coloca um id nessa div, pois o prototype só trabalha com ids!                        
            divs[i].id= "drag"+i;       
                       
            //torna a div draggable
            new Draggable(
                divs[i].id, 
                {
                    revert: true                              
                }); 
        }
         
        if( divs[i].className == 'span6 drop' || divs[i].className == 'span12 drop'){
            
            //coloca um id nessa div, pois o prototype só trabalha com ids!                        
            divs[i].id= "drag"+i;     
            
            //torna a div droppable   
            Droppables.add(
                divs[i].id,
                {
                    hoverclass: 'hoverActive',
                    onDrop: moveItem
                }
                );
                    
            // Set drop area by default  non cleared.
            $( divs[i].id).cleared = false;                                                                                         
        
        } //if              
    }     //for            
}

function moveItem( draggable,droparea){
    /*if (!droparea.cleared) {
        droparea.innerHTML = '';
        droparea.cleared = true;
    }*/
    draggable.parentNode.removeChild(draggable);
    droparea.appendChild(draggable);         
      
}
            
            
function pegaId(){
    alert(this.id);
}

function initFormPessoa(){
    $a("#nome_input").focus();
    $a('#senha').hide();
    
    
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
        $a('<div class="alert alert-error fade in">'+data_split+'</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
        $a('<div class="alert alert-error fade in">'+split1+'</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
                    
    }    
}

//Função que manda o form de cadastro de pessoa por AJAX
function pessoaAjax(modalidade){
        
    
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
    url = $form.attr( 'action' );
    
    var id_pessoa = $a('#id').val();
     
    //alert(tipo);      
       
       
    $a.post(url,{
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
        //alert(data);
        
        //modalidade de adicionar 1 pessoa
        if(modalidade==0){
            //alert("modo 0");
            if(data==1){
                //alert("If 0"); 
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>A pessoa<b>'+nome+'</b> foi inserida no sistema com sucesso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar
                
                //limparForm('.pessoaAjaxForm');
                
                subirPagina();
        
                //pega o endereço da pagina
                var href = location.href;
      
                //separa num array os valores divididos por um '_'        
                href_split = href.split('_');
        
                //alert(href_split);
                var url = "relacao_"+href_split[1]+".php";
                //alert(url);   
                           
                setTimeout(function() {
                    limparForm('.pessoaAjaxForm');
                    $a(window.document.location).attr('href',url);

                }, 3000);          
            }
            
            else{
                //alert("Else 0");
                //alert(data);
                msgErroBD(data);
                subirPagina();
                               
            }
        }
        
        //modalidade de adicionar outra pessoa
        else if(modalidade==1){
            if(data==1){
                //alert("FOI"); 
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>A pessoa <b>'+nome+'</b> foi inserida no sistema com sucesso.</p></div>').appendTo('#msg_resultado'); // appendTo é pra por em algum lugar                
                limparForm('.pessoaAjaxForm');
                initFormPessoa();
                subirPagina();
                  
            }
            else{
                //alert("Else 1");
                //alert(data);
                msgErroBD(data);
                subirPagina();
            }
        }
        
        //modalidade de modal
        else if(modalidade==2){
            if(data==1){
                //alert("FOI"); 
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
                    $a('#myModal').modal('toggle');

                }, 3000);   
               
            }
            else{
                //alert("Else 1");
                //alert(data);
                msgErroBD(data);
                subirModal();
                
            }
        }
        
        //modalidade de editar uma pessoa
        else if(modalidade==3){
            //alert("modo 0");
            if(data==1){
                //alert("If 0"); 
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
                    //limparForm('.pessoaAjaxForm');
                    $a(window.document.location).attr('href',url);

                }, 3000);          
            }
            
            else{
                //alert("Else 0");
                //alert(data);
                msgErroBD(data);
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
    senha = $form.find( 'input[name="senha"]' ).val();
        
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
        $a('#telefone').removeClass("error").addClass("");  
    }   
    else if (tel.length  == 10){            
        $a('#telefone').removeClass("error").addClass("");  
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
            pessoaAjax(3);
        }
        
        else{
        //alert(mandar);            
        }
    });
}

function habilitarSenha(){
    
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
}
   

//Função de JQUERY
$a(document).ready(function(){   
    
    
    validaFormPessoaJS();
    trocarAbaSubnav();
    initFormPessoa();
    botaoMaximizar();
    habilitarSenha();
    
     
   		
});

//Função para limite de resultados em relações de pessoas físicas, jurídicas e advogados
function valor(){

    document.forms["num_resultados"].submit();

}
