

<script type="text/javascript">  
    
    var $a = jQuery.noConflict();
    
    
    //função de teste para ajax e caixa diferente
    function processoAjax(){


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
        
        //reseta o modal para cada clique
        $a('.pessoa-modal').click(function(){
            limparForm(".pessoaFormAjax");
            $a('.error').removeClass("error");
            $a('.alert').remove();
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

    //função de teste para ajax e caixa diferente
    function validaFormProcessoJS(){
        var mandar = true;  
       
        
        $a("#submit-processo").click(function(){
            processoAjax();
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
