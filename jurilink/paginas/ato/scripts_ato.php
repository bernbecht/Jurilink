<script type="text/javascript"> 
    
    
    function atoAjaxGD(){
        
       
       var $form = $a( '#form_ato' ),
        nome = $form.find( 'input[name="nome"]' ).val(),
        previsao = $form.find( 'input[name="previsao"]' ).val(),
        descricao = $form.find( 'input[name="descricao"]' ).val(),
        user = $form.find( 'input[name="flag_userCheckbox"]:checked' ).val(),
        url = $form.attr( 'action' );
        
        //alert(user);
        
        $a.post(url,{
            nome:nome,
            previsao:previsao,
            descricao:descricao,
            user:user
        },function(data){         
       
            if(data == 0){
                $a('.alert').remove();
                $a('<div class="alert alert-error fade in"><p>O ato <b>'+nome+'</b> nao foi inserido no sistema.</p></div>').appendTo('#msg_resultado_processo');
            }
            else if(data==1){
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><p>O ato <b>'+nome+'</b> foi inserido no sistema com sucesso.</p></div>').appendTo('#msg_resultado_processo');
                limparForm('#form_ato');
            }
        });
    }
    
    function validaFormAtoSubmitGD(){    
        
        $a('.alert').remove();
        
        //alert('oi');
    
        var intRegex = /^\d+$/;
        var floatRegex = /^([0-9]*\,[0-9]{2})$/;
        var dataRegex = /^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/;
        
        var $form = $a( '#form_ato' ),
        nome = $form.find( 'input[name="nome"]' ).val(),
        previsao = $form.find( 'input[name="previsao"]' ).val(),
        desc = $form.find( 'input[name="descricao"]' ).val();
        
        
        var mandar = true;
            
        if(nome.length < 2){
            $a('#nome').removeClass("control-group").addClass("control-group error");
            $a('#nome_input').focus();
            mandar =false;
        } else{
            $a('#nome').removeClass("error");
        }
        if(previsao.length < 1){
            $a('#previsao').removeClass("control-group").addClass("control-group error");
            $a('#previsao_input').focus();
            mandar =false;
        } else{
            $a('#previsao').removeClass("error");
        }
        
        if(intRegex.test(previsao)) {
            $a('#previsao').removeClass("error");             
        }
        else{
            $a('#previsao').removeClass("control-group").addClass("control-group error");
        }
        
        if(desc.length < 2){
            $a('#descricao').removeClass("control-group").addClass("control-group error");
            $a('#descricao_input').focus();
            mandar =false;
        } else{
            $a('#descricao').removeClass("error");
        }
        
        return mandar;
    }
    
    
    
    
    //Função que contém os eventos para validação do cadastro de uum processo
    function validaFormAtoJSGD(){
        
        //botao que cancela  as operações do formulário de cadastro
        //redireciona para a página anterior
        $a(".cancelar-processo").click(function(){
        
            limparForm('#form_ato');
        
            var url = 'relacao_processos.php';
            
            
            $a(window.document.location).attr('href',url);
        });
               
        $a("#submit-ato").click(function(){
            var mandar = validaFormAtoSubmitGD();  
            //alert(mandar);
            if(mandar == true){
               
              atoAjaxGD();
            }
            else{
                
            }
        });
    }
    
    $a(document).ready(function (){              
             
        validaFormAtoJSGD();
        
    });      

</script>