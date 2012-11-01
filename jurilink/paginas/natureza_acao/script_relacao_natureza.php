<script type="text/javascript">
    
    //SCRIPT QUE COMANDA A PAGINA DE RELAÇÃO DE NATUREZAS DE AÇÃO
    //FAZ A PROCURA DE NATUREZAS DE AÇÃO POR AJAX


    function loadInicial(){
            
        var url = 'get_relacao_naturezas.php';
               
        $a.post(url, function(data){
            
            //se tiver nenhum juizo, mostre
            if(data==0){
                $a('<div id="alert_natureza" class="alert alert-info fade in"><p><h4>Não há <b>naturezas de ação</b> cadastradas.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
            }            
            else{
                $a('#tabela').remove();
                $a(data).appendTo('#tabela_container');
                
                //como a tabela de dados é algo dinâmico, é associá-la com o método 
                tooltip();
                modal_natureza();
                editar_natureza();
            }
                
        });
    }
    
    function modal_natureza(){
        $a('.editar-natureza').click(function(){
            // Mostra modal para alteração
            
            $a('#myModal').modal('show');
            $a('#nome_input').focus();
            $a('#nome').removeClass("error");
            
            //Pega o nome da comarca junto com o ID da mesma
            var dado = $a(this).find('input').val();
            var dado_split = dado.split('|');
            var nome = dado_split[0];
            var id_natureza = dado_split[1];
                
            //Põe o nome da comarca no campo do Modal
            var $form = $a( '.altera_natureza_Ajax' )
            $form.find( 'input[name="nome"]' ).val(nome),
            $form.find( 'input[name="id"]' ).val(id_natureza);
    
        });
    
    }
    
    function edita_naturezaAjax(){
        var $form = $a( '.altera_natureza_Ajax' )
        nome = $form.find( 'input[name="nome"]' ).val(),
        id_natureza = $form.find( 'input[name="id"]' ).val(),
        url = $form.attr( 'action' );
        
        $a('#myModal').modal('hide');
        
        $a.post(url,{
            nome:nome,
            id_natureza:id_natureza
        },function(data){
            if(data == 0){
                $a('.alert').remove();
                $a('<div class="alert alert-error fade in"><p>A natureza de ação <b>'+nome+'</b> não foi editada no sistema.</p></div>').appendTo('#aviso');
            }
            else if(data==1){
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>A natureza de ação <b>'+nome+'</b> foi editada no sistema com sucesso.</p></div>').appendTo('#aviso');
                loadInicial();
                
            }
        });
            
    }
    
    function editar_natureza(){
        $a('.ok-modal-natureza').click(function(){
            var mandar = valida_form_edita_natureza();
            if (mandar == true){
                edita_naturezaAjax();
                
            }
            
        });
    }
    
    function valida_form_edita_natureza(){
        
        var $form = $a( '.altera_natureza_Ajax' )
        nome = $form.find( 'input[name="nome"]' ).val(),
        id_natureza = $form.find( 'input[name="id"]' ).val();
            
        var mandar = true;
            
        if(nome.length < 2){
            $a('#nome').removeClass("").addClass("control-group error");
            $a('#nome_input').focus();
            mandar = false;
                
        } else{
            $a('#nome').removeClass("error");
        }
        return mandar;
           
    }
    
    function bloqueiaEnter(){
     
        $a('.altera_natureza_Ajax').keypress(function(e){
            if(e.which==13) return false;
            
            if(e.which ==13) e.preventDefault();


        }); 
        
    }

    
    
    $a(document).ready(function (){   
        loadInicial();
        bloqueiaEnter();
    }); 
    
</script>