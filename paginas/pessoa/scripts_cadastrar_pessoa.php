<script type="text/javascript">  
    var $a = jQuery.noConflict();
        
    $a(document).ready(function (){   
        
        $a('#rg-modal').show();
        $a('#comarcamodal').show();
        $a('#cpf-modal').show();
        $a('#cnpj-modal').hide();
        $a('#oab-modal').hide();
       
        $a('#tipo_input').val(0);            
        
        
        $a('#fisica').click(function(){
            $a('#rg-modal').show();
            $a('#comarca-modal').show();
            $a('#cpf-modal').show();
            $a('#cnpj-modal').hide();
            $a('#oab-modal').hide();
            
            $a('#tipo_input').val(0);
            
            $a(this).addClass('disabled');
            $a('#juridica').removeClass('disabled');
            $a('#advogado').removeClass('disabled');
            
            
        });
        
        $a('#juridica').click(function(){
            $a('#rg-modal').hide();
            $a('#comarca-modal').hide();
            $a('#cpf-modal').hide();
            $a('#cnpj-modal').show();
            $a('#oab-modal').hide();
            
            $a(this).addClass('disabled');
            $a('#advogado').removeClass('disabled');
            $a('#fisica').removeClass('disabled');
            
            $a('#tipo_input').val('1');
        });
        
        $a('#advogado').click(function(){
            $a('#rg-modal').show();
            $a('#comarca-modal').show();
            $a('#cpf-modal').show();
            $a('#cnpj-modal').hide();
            $a('#oab-modal').show();
            
            $a('#tipo_input').val('2');
            
            $a(this).addClass('disabled');
            $a('#juridica').removeClass('disabled');
            $a('#fisica').removeClass('disabled');
        });
 
 
    
    });
    
    
        
        
   
</script>    

</body>
</html>
