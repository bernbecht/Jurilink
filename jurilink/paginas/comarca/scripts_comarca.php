<script type="text/javascript"> 
    
    
    function comarcaAjax(){
        
        var $form = $a( '#form_comarca' ),
        nome = $form.find( 'input[name="nome"]' ).val(),
        url = $form.attr( 'action' );
        
        $a.post(url,{
            nome:nome
        },function(data){
            //alert(data);
            if(data == 0){
                $a('.alert').remove();
                $a('<div class="alert alert-error fade in"><p>A comarca <b>'+nome+'</b> nao foi inserida no sistema.</p></div>').appendTo('#msg_resultado_processo');
            }
            else if(data==1){
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><p>A comarca <b>'+nome+'</b> foi inserida no sistema com sucesso.</p></div>').appendTo('#msg_resultado_processo');
                limparForm('#form_comarca');
            }
        });
    }
    
    function validaFormComarcaSubmit(){    
        
        $a('.alert').remove();
        
        //alert('oi');
    
        var intRegex = /^\d+$/;
        var floatRegex = /^([0-9]*\,[0-9]{2})$/;
        var dataRegex = /^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/;
        
        var $form = $a( '#form_comarca' ),
        nome = $form.find( 'input[name="nome"]' ).val();
        
        var mandar = true;
            
        if(nome.length < 2){
            $a('#nome').removeClass("control-group").addClass("control-group error");
            $a('#nome_input').focus();
            mandar =false;
        } else{
            $a('#nome').removeClass("error");
        }
        
        return mandar;
    }
    
    
    
    
    //Função que contém os eventos para validação do cadastro de uum processo
    function validaFormComarcaJS(){        
    
  
        //botao que cancela  as operações do formulário de cadastro
        //redireciona para a página anterior
        $a(".cancelar-comarca").click(function(){
        
            limparForm('#form_comarca');
        
            var url = 'relacao_comarcas.php';
            
            
            $a(window.document.location).attr('href',url);
        });
               
        $a("#submit-comarca").click(function(){
            var mandar = validaFormComarcaSubmit();  
            //alert(mandar);
            if(mandar == true){
                //alert("Tr00");
                comarcaAjax(1);
            }
            else{
                
            }
        });
    }

    
    $a(document).ready(function (){              
             
        validaFormComarcaJS();

    });      

</script>