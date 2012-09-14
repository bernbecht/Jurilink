

<script type="text/javascript">  
    
    var $a = jQuery.noConflict();
    
    
    //função de teste para ajax e caixa diferente
    function processoAjax1(){


        /* stop form from submitting normally */
        event.preventDefault(); 
        var msg='';
        $a('.box span').each(function(){
            msg = msg + $a(this).text()+',';
            
        });
        alert(msg);
    }
    
    //inicializa o form de PROCESSO
    function initFormProcesso(){
        
        
        $a(".opa").click(function(){
            $a('#myModal').modal('toggle');
        });
        
        
        //coloca o focu no input de numero unificado
        $a('#numero_unificado_input').focus();
        
        //reseta o modal para cada clique
        $a('.pessoa-modal').click(function(){
            limparForm(".pessoaFormAjax");
            $a('.error').removeClass("error");
            $a('.alert').remove();
            
        });
        
        $a(".cancelar-processo").click(function(){            
            limparForm("#form_processo");
        });        
        
        /*Eventos para dizer onde o callback do modal PESSOA deve
         *preencher com o nome*/
        $a('#autor-modal').click(function(){
            //alert('autor-modal');
            $a('#campo-modal').val(0);
        });
        
        $a('#reu-modal').click(function(){
            //alert('reu-modal');
            $a('#campo-modal').val(1);
        });
        
        $a('#autor-ad-modal').click(function(){
            //alert('reu-modal');
            $a('#campo-modal').val(2);
        });
        
        $a('#reu-ad-modal').click(function(){
            //alert('reu-modal');
            $a('#campo-modal').val(3);
        });
        
        $a('#autor-rep-modal').click(function(){
            //alert('reu-modal');
            $a('#campo-modal').val(4);
        });
        
        $a('#reu-rep-modal').click(function(){
            //alert('reu-modal');
            $a('#campo-modal').val(5);
        });
    }
    
    function validaFormProcessoSubmit(){
        
        $a('.alert').remove();
    
        var intRegex = /^\d+$/;
        var floatRegex = /^([0-9]*\,[0-9]{2})$/;
        var dataRegex = /^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/;
        
        var $form = $a( '#form_processo' ),
        id_processo = $form.find( 'input[name="id_processo"]' ).val(),
        num = $form.find( 'input[name="numero_unificado"]' ).val(),
        distribuicao = $form.find( 'input[name="data_distribuicao"]' ).val(),
        causa = $form.find( 'input[name="valor_causa"]' ).val(),
        juizo_val = $a('#juizo').find('option').filter(':selected' ).val(),
        nat_val = $a('#natureza').find('option').filter(':selected' ).val(),
        autor_val = $form.find( 'input[name="autor"]' ).val(),
        autor_ad_val = $form.find( 'input[name="autor_advogado"]' ).val(),
        autor_rep = $form.find( 'input[name="autor_rep"]' ).val(),
        reu_val = $form.find( 'input[name="reu"]' ).val(),
        reu_ad_val = $form.find( 'input[name="reu_advogado"]' ).val(),
        reu_rep = $form.find( 'input[name="reu_rep"]' ).val(),
        transito = $form.find( 'input[name="transito_em_julgado"]' ).val(),
        deposito = $form.find( 'input[name="deposito_judicial"]' ).val(),
        auto = $form.find( 'input[name="auto_penhora"]' ).val();      
       
        var mandar = true;
        var focus = false;
        
        if(num.length !=21){
            $a('#numero_unificado').removeClass("control-group").addClass("control-group error");
            $a('#numero_unificado_input').focus();
            focus=true;
            mandar =false;
        } 
        else{
            $a('#numero_unificado').removeClass("control-group error").addClass("control-group");  
        }
        
        if(dataRegex.test(distribuicao)) {
            $a('#data_distribuicao').removeClass("error");             
        }
        else{
            $a('#data_distribuicao').removeClass("").addClass("error");
            if(focus==false){
                $a('#data_dist_input').focus();
                focus=true;
            }
            mandar =false;
        }
        
        if(juizo_val == -1){
            $a('#juizo-control').removeClass("control-group").addClass("control-group error"); 
            if(focus==false){
                $a('#juizo').focus();
                focus=true;
            }
            mandar =false;
        }
        else{
            $a('#juizo-control').removeClass("error");            
        }
        
        if(nat_val == -1){
            $a('#natureza-control').removeClass("control-group").addClass("control-group error"); 
            mandar =false;
            if(focus==false){
                $a('#natureza').focus();
                focus=true;
            }
        }
        else{
            $a('#natureza-control').removeClass("error");            
        }
        
        if(floatRegex.test(causa)) {
            $a('#valor_causa').removeClass("error").addClass("");            
        }
        else{
            $a('#valor_causa').addClass("error");
            if(focus==false){
                $a('#valor_causa_input').focus();
                focus=true;
            }
            mandar =false;
        }
        
        if(autor_val.length == 0){
            $a('#autor').addClass("error");
            mandar =false;
            if(focus==false){
                $a('#autor_input').focus();
                focus=true;
            }
        }
        else{
            $a('#autor').removeClass("error");

        }
        
        if(autor_ad_val.length == 0){
            $a('#autor_advogado').addClass("error");
            mandar =false;
            if(focus==false){
                $a('#autor_ad_input').focus();
                focus=true;
            }
        }
        else{
            $a('#autor_advogado').removeClass("error");
        }       
        
        if(autor_rep.length !=0){
            if(autor_rep.length<=2){
                $a('#autor_rep').addClass("error");
                mandar =false;
                if(focus==false){
                    $a('#autor_rep_input').focus();
                    focus=true;
                }
            }
            else{
                $a('#autor_rep').removeClass("error");
            }
        }
        else{
            $a('#autor_rep').removeClass("error");
        }
      
        
        if(reu_val.length == 0){
            //alert(reu_val);
            $a('#reu').addClass("error");
            mandar =false;
            if(focus==false){
                $a('#reu_input').focus();
                focus=true;
            }
        }
        else{
            $a('#reu').removeClass("error");

        }
        
        if(reu_ad_val.length == 0){
            $a('#reu_advogado').addClass("error");
            mandar =false;
            if(focus==false){
                $a('#reu_ad_input').focus();
                focus=true;
            }
        }
        else{
            $a('#reu_advogado').removeClass("error");

        }
        
        if(reu_rep.length!=0){
            if(reu_rep.length<=2){
                $a('#reu_rep').addClass("error");
                mandar =false;
                if(focus==false){
                    $a('#reu_rep_input').focus();
                    focus=true;
                }
            }
            else{
                $a('#reu_rep').removeClass("error");
            }
        }
        else{
            $a('#reu_rep').removeClass("error");
        }
        
        
        
        if(transito.length != 0){
            if(dataRegex.test(transito)) {
                $a('#transito_em_julgado').removeClass("error");           
            }
            else{
                $a('#transito_em_julgado').removeClass("").addClass("error");
                mandar =false;
                if(focus==false){
                    $a('#tej_input').focus();
                    focus=true;
                }
            }
        }
        else{
            $a('#transito_em_julgado').removeClass("error");         

        }
        
        if(deposito.length != 0){
            if(floatRegex.test(deposito)) {
                $a('#deposito_judicial').removeClass("error").addClass("");            
            }
            else{
                $a('#deposito_judicial').addClass("error");
                mandar =false;
                if(focus==false){
                    $a('#deposito_judicial_input').focus();
                    focus=true;
                }
            }
        }
        else{
            $a('#deposito_judicial').removeClass("error").addClass("");           
        }
        
        if(auto.length != 0){
            if(floatRegex.test(deposito)) {
                $a('#auto_penhora').removeClass("error").addClass("");            
            }
            else{
                $a('#auto_penhora').addClass("error");
                mandar =false;
                if(focus==false){
                    $a('#auto_penhora_input').focus();
                    focus=true;
                }
            }
        }
        else{
            $a('#auto_penhora').removeClass("error").addClass("");           
        }
        
        subirPagina();
            
        
        return mandar;      
        
    }
    
    function msgErroProcessoBD(data){
        if(data=="ERRADO AUTOR"){
            $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O campo <b>AUTOR</b> possui pelo menos um dado incorreto.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
            $a('#autor').addClass("error");      
            $a('#autor_input').focus();
        }
        else if(data=="ERRADO REU"){
            $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O campo <b>REU</b> possui pelo menos um dado incorreto.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
            $a('#reu').addClass("error"); 
            $a('#reu_input').focus();
        }
        else if(data=="ERRADO ADVOGADO AUTOR"){
            $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O campo <b>ADVOGADO AUTOR</b> possui pelo menos um dado incorreto.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
            $a('#autor_advogado').addClass("error");  
            $a('#autor_ad_input').focus();
        }
        else if(data=="ERRADO ADVOGADO REU"){
            $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O campo <b>ADVOGADO REU</b> possui pelo menos um dado incorreto.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
            $a('#reu_advogado').addClass("error");    
            $a('#reu_ad_input').focus();
        }
        else if(data=="ERRADO REPRESENTANTE AUTOR"){
            $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O campo <b>REPRESENTANTE AUTOR</b> possui pelo menos um dado incorreto.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
            $a('#autor_rep').addClass("error");    
            $a('#autor_rep_input').focus();
            
        }
        else if(data=="ERRADO REPRESENTANTE REU"){
            $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O campo <b>REPRESENTANTE REU</b> possui pelo menos um dado incorreto.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
            $a('#reu_rep').addClass("error");  
            $a('#reu_rep_input').focus();
        }
        
        else{
            data_split_aux = data.split('\n');
            data_split = data_split_aux[0].split(' ');
            if(data_split[11]=='"num_unico"'){
                $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>Numero Unificado</b> ja esta em uso.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
                $a('#numero_unificado').removeClass("control-group").addClass("control-group error");
                $a('#numero_unificado_input').focus();
            }
            else if(data_split[11]=='"num_unificado_index"'){
                $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>Numero Unificado</b> ja esta em uso.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
                $a('#numero_unificado').removeClass("control-group").addClass("control-group error");
                $a('#numero_unificado_input').focus();
            }
             else if(data_split[2]=='Trânsito'){
                $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>Transito em Julgado</b> nao pode ser maior que a data atual.</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
                $a('#transito_em_julgado').removeClass("control-group").addClass("control-group error");
                $a('#tej_input').focus();
            }
            
            else if(data_split[2]=='Data'){
                $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O <b>Transito em Julgado</b> nao pode ser menor que a <b>Data de Distribuicao</b></p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
                $a('#transito_em_julgado').removeClass("control-group").addClass("control-group error");
                $a('#tej_input').focus();
            }
            else
                $a('<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>'+data+'</p></div>').appendTo('#msg_resultado_processo'); // appendTo é pra por em algum lugar
        }
    }
    
    function processoAjax(modalidade){
        
        var $form = $a( '#form_processo' ),
        id_processo = $form.find( 'input[name="id_processo"]' ).val(),
        num = $form.find( 'input[name="numero_unificado"]' ).val(),
        distribuicao = $form.find( 'input[name="data_distribuicao"]' ).val(),
        causa = $form.find( 'input[name="valor_causa"]' ).val(),
        juizo_val = $a('#juizo').find('option').filter(':selected' ).val(),
        nat_val = $a('#natureza').find('option').filter(':selected' ).val(),
        autor_val = $form.find( 'input[name="autor"]' ).val(),
        autor_ad_val = $form.find( 'input[name="autor_advogado"]' ).val(),
        autor_rep = $form.find( 'input[name="autor_rep"]' ).val(),
        reu_val = $form.find( 'input[name="reu"]' ).val(),
        reu_ad_val = $form.find( 'input[name="reu_advogado"]' ).val(),
        reu_rep = $form.find( 'input[name="reu_rep"]' ).val(),
        transito = $form.find( 'input[name="transito_em_julgado"]' ).val(),
        deposito = $form.find( 'input[name="deposito_judicial"]' ).val(),
        auto = $form.find( 'input[name="auto_penhora"]' ).val(),
        url = $form.attr( 'action' );
        
        //alert(modalidade);
        
        $a.post(url,{
            id_processo:id_processo,
            transito_em_julgado:transito,
            data_distribuicao:distribuicao,
            deposito_judicial:deposito,
            numero_unificado:num,
            auto_penhora:auto,
            valor_causa:causa,
            id_natureza:nat_val,
            id_juizo:juizo_val,
            autor:autor_val,
            autor_advogado:autor_ad_val,
            reu:reu_val,
            reu_advogado:reu_ad_val,
            autor_rep:autor_rep,
            reu_rep:reu_rep           
        
        }, function(data){             
            // alert(data);
            if(modalidade == 1){
                if(data==1){
                    //alert("OK");
                    $a('.alert').remove();
                    $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O processo <b>'+num+'</b> foi inserido no sistema com sucesso.</p></div>').appendTo('#msg_resultado_processo');
                    
                    subirPagina();
                    
                    //limparForm('#form_processo');
                    
                    var url = '../jurilink_main.php';
                    
                    setTimeout(function() {
                    
                        limparForm('#form_processo');
                        $a(window.document.location).attr('href',url);

                    }, 2000);  
                }
                else{
                    
                   
                    msgErroProcessoBD(data);
                    subirPagina();;
                }
            } 
            
            else if(modalidade ==2){
                if(data==1){
                    $a('.alert').remove();
                    $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O processo <b>'+num+'</b> foi inserido no sistema com sucesso.</p></div>').appendTo('#msg_resultado_processo');
                    
                    subirPagina();
                    
                    limparForm('#form_processo'); 
                    
                    $a('#numero_unificado_input').focus();
                    
                    
                    
                }
                else{
                    
                    msgErroProcessoBD(data);
                    subirPagina();;
                }
            
            }
            
            else if(modalidade ==3){
                if(data==1){
                    $a('.alert').remove();
                    $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O processo <b>'+num+'</b> foi editado no sistema com sucesso.</p></div>').appendTo('#msg_resultado_processo');
                    
                    subirPagina();
                  
                    //pega o endereço da pagina
                    href = location.href;
      
                    //separa num array os valores divididos por um '_'        
                    href_split = href.split('?');                
               
                    url = 'view_processo.php?'+href_split[1];                
                                          
                    setTimeout(function() {                   
                        $a(window.document.location).attr('href',url);

                    }, 3000);                  
                                
                }
                else{
                    
                    msgErroProcessoBD(data);
                    subirPagina();;
                }               

            }//else 3
            
        });       
        
    }//function
    

    //Função que contém os eventos para validação do cadastro de uum processo
    function validaFormProcessoJS(){        
    
    
        //botao que cancela  as operações do formulário de cadastro
        //redireciona para a página anterior
        $a(".cancelar-processo").click(function(){
        
            limparForm('#form_processo');
        
            var url = 'relacao_processos.php';
            
            
            $a(window.document.location).attr('href',url);
        });
               
        $a("#submit-processo").click(function(){
            //alert("Chamou");
            var mandar = validaFormProcessoSubmit();  
            //alert(mandar);
            if(mandar == true){
                //alert("Tr00");
                processoAjax(1);
            }
            else{
                
            }
        });
        
        $a("#submit-outro-processo").click(function(){
            var mandar = validaFormProcessoSubmit();  
            //alert(mandar);
            if(mandar == true){
                //alert("Tr00");
                processoAjax(2);
            }
            else{
                
            }
        });
        
        $a("#editar-processo").click(function(){
            var mandar = validaFormProcessoSubmit();  
            //alert(mandar);
            if(mandar == true){
                //alert("Tr00");
                processoAjax(3);
            }
            else{
                
            }
        });
         
    
    }   
    
    //Muda o tipo da pessoa na modal box de pessoa na tela de cadastrar processo
    function mudarTipoPessoaForm(){
        $a('#rg').show();
        $a('#comarca').show();
        $a('#cpf').show();
        $a('#cnpj').hide();
        $a('#oab').hide();
       
        $a('#tipo_input').val(0);            
        
        
        $a('#fisica').click(function(){
            $a('#rg').show();
            $a('#comarca').show();
            $a('#cpf').show();
            $a('#cnpj').hide();
            $a('#oab').hide();
            
            $a('#tipo_input').val(0);
            
            $a(this).addClass('disabled');
            $a('#juridica').removeClass('disabled');
            $a('#advogado').removeClass('disabled');
            
            
        });
        
        $a('#juridica').click(function(){
            $a('#rg').hide();
            $a('#comarca').hide();
            $a('#cpf').hide();
            $a('#cnpj').show();
            $a('#oab').hide();
            
            $a(this).addClass('disabled');
            $a('#advogado').removeClass('disabled');
            $a('#fisica').removeClass('disabled');
            
            $a('#tipo_input').val('1');
        });
        
        $a('#advogado').click(function(){
            $a('#rg').show();
            $a('#comarca').show();
            $a('#cpf').show();
            $a('#cnpj').hide();
            $a('#oab').show();
            
            $a('#tipo_input').val('2');
            
            $a(this).addClass('disabled');
            $a('#juridica').removeClass('disabled');
            $a('#fisica').removeClass('disabled');
        });
    }
    
        
    $a(document).ready(function (){              
             
             
        <!-- Função que cria objetos AUTOCOMPLETE -->             
        new Ajax.Autocompleter( 
        'autor_input',
        'autocompleteAutor',
        'getPessoaAutoCompleteAutor.php',
        {tokens: ','}
    );    
        
        new Ajax.Autocompleter( 
        'reu_input',
        'autocompleteReu',
        'getPessoaAutoCompleteReu.php',
        {tokens: ','}
    );  
        
        new Ajax.Autocompleter( 
        'autor_ad_input',
        'autocompleteAdvogado1',
        'getPessoaAutoCompleteAd1.php',
        {tokens: ','}
    );
        
        new Ajax.Autocompleter( 
        'reu_ad_input',
        'autocompleteAdvogado2',
        'getPessoaAutoCompleteAd2.php',
        {tokens: ','}
    );
        new Ajax.Autocompleter( 
        'autor_rep_input',
        'autocompleteAutorRep1',
        'getPessoAutoCompleteRep1.php',
        {tokens: ','}
    );
        
        new Ajax.Autocompleter( 
        'reu_rep_input',
        'autocompleteAutorRep2',
        'getPessoAutoCompleteRep2.php',
        {tokens: ','}
    );        
        
        //inicializa o FORM de PROCESSO
        initFormProcesso();
        
        //contém os EVENTOS de para validar o form PROCESSO
        validaFormProcessoJS(); 
  
        //muda o tipo de pessoa no formulário de cadastro de pessoa
        // na pagina de cadastro de processo
        mudarTipoPessoaForm();
        
        
    });      
    
  
   
</script>    

</body>
</html>
