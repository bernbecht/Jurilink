<script type="text/javascript"> 
    
    
    function comarcaAjax(){
        
      
        
         var $form = $a( '#form_juizo' ),
        nome = $form.find( 'input[name="nome"]' ).val(),
        id_comarca = $form.find( '#comarca' ).find('option').filter(':selected').val(),
        url = $form.attr( 'action' );
        
       
        
        $a.post(url,{
            nome:nome,
            id_comarca:id_comarca
        },function(data){
            //alert(data);
            if(data == 0){
                $a('.alert').remove();
                $a('<div class="alert alert-error fade in"><p>O juizo <b>'+nome+'</b> nao foi inserido no sistema.</p></div>').appendTo('#msg_resultado');
            }
            else if(data==1){
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><p>O juizo <b>'+nome+'</b> foi inserido no sistema com sucesso.</p></div>').appendTo('#msg_resultado');
                limparForm('#form_juizo');
            }
        });
    }
    
    function validaFormJuizoSubmit(){    
        
        $a('.alert').remove();
        
        //alert('oi');
    
        var intRegex = /^\d+$/;
        var floatRegex = /^([0-9]*\,[0-9]{2})$/;
        var dataRegex = /^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/;
        
        var $form = $a( '#form_juizo' ),
        nome = $form.find( 'input[name="nome"]' ).val(),
        comarca = $form.find( '#comarca' ).find('option').filter(':selected').val();
        
     
        var mandar = true;
            
        if(nome.length < 2){
            $a('#nome').removeClass("control-group").addClass("control-group error");
            $a('#nome_input').focus();
            mandar =false;
        } else{
            $a('#nome').removeClass("error");
        }
        
        if(comarca == -1){
            $a('#comarca').removeClass("control-group").addClass("control-group error");
            $a('#comarca_option').focus();
            mandar =false;
        }
        else{
            $a('#comarca').removeClass("error");
        }
        
        return mandar;
    }
    
    
    
    
    //Função que contém os eventos para validação do cadastro de uum processo
    function validaFormJuizoJS(){        
    
  
        //botao que cancela  as operações do formulário de cadastro
        //redireciona para a página anterior
        $a(".cancelar-juizo").click(function(){
        
            limparForm('#form_juizo');
        
            var url = 'relacao_juizos.php';
            
            
            $a(window.document.location).attr('href',url);
        });
               
        $a("#submit-juizo").click(function(){
            var mandar = validaFormJuizoSubmit();  
            //alert(mandar);
            if(mandar == true){
                //alert("Tr00");
                comarcaAjax();
            }
            else{
                
            }
        });
    }
    
    $a(document).ready(function (){              
             
        validaFormJuizoJS();
   
        
    });      

</script>