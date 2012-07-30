
<!-- Função que cria objetos AUTOCOMPLETE -->


<script type="text/javascript">  
    
    var $a = jQuery.noConflict();
        
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
        
    });      
    
  
   
</script>    

</body>
</html>
