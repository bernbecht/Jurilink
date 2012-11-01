<script type="text/javascript">  
    var $a = jQuery.noConflict();
    
    /*Essa função pode ser chamada pra testar a pagina
     *teste_web_cadastrar_pessoa.php*/
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
        
       
       
 
    
    });  
    
        
        
   
</script>    

