
<!-- Função que cria objetos AUTOCOMPLETE -->


<script type="text/javascript">  
    
    var $a = jQuery.noConflict();
    
    function processoAjax(){


        /* stop form from submitting normally */
        event.preventDefault(); 
        var msg='';
        $a('.box span').each(function(){
             msg = msg + $a(this).text()+',';
            
        });
        alert(msg);
    }

    function validaFormProcessoJS(){
        var mandar = true;  
       
        
        $a("#submit-processo").click(function(){
            processoAjax();
        });
         
    
    }    
    
        
    $a(document).ready(function (){              
             
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
        
        validaFormProcessoJS();       
        
        
    });      
    
  
   
</script>    

</body>
</html>
