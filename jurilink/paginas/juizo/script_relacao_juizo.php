<script type="text/javascript">
    
    //SCRIPT QUE COMANDA A PAGINA DE RELAÇÃO DE JUÍZOS
    //FAZ A PROCURA DE JUÍZOS POR AJAX


    function loadInicial(){
            
        var url = 'get_relacao_juizos.php';
               
        $a.post(url, function(data){
            
            //se tiver nenhum juizo, mostre
            if(data==0){
                $a('<div id="alert_juizo" class="alert alert-info fade in"><p><h4>Não há <b>juízos</b> cadastrados.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
            }            
            else{
                $a('#tabela').remove();
                $a(data).appendTo('#tabela_container');
                
                //como a tabela de dados é algo dinâmico, é associá-la com o método 
                tooltip();
                modal_juizo();
                editar_juizo();
            }
        });
    }
    
    function modal_juizo(){
        $a('.editar-juizo').click(function(){
            // Mostra modal para alteração
            
            $a('#myModal').modal('show');
            $a('#nome_input').focus();
            $a('#nome').removeClass("error");
            $a('.alert').remove();
            
            //Pega o nome da juizo junto com o ID da mesma
            var dado = $a(this).find('input').val();
            var dado_split = dado.split('|');
            var nome = dado_split[0];
            var id_juizo = dado_split[1];
            var comarca = dado_split[2];
            var id_comarca = dado_split[3];
            
            
            
                
            //Põe o nome da juizo no campo do Modal
            var $form = $a( '.altera_juizo_Ajax' )
            $form.find( 'input[name="nome"]' ).val(nome),
            $form.find( 'input[name="id"]' ).val(id_juizo),
            $form.find( '#comarca' ).find('option').filter(':selected').text(comarca).val(id_comarca);
      
    
        });
    
    }
    
       
    function edita_juizoAjax(){
        var $form = $a( '.altera_juizo_Ajax' )
        nome = $form.find( 'input[name="nome"]' ).val(),
        id_juizo = $form.find( 'input[name="id"]' ).val(),
        id_comarca = $form.find( '#comarca' ).find('option').filter(':selected').val(),
        url = $form.attr( 'action' );
        
          
        
        $a.post(url,{
            nome:nome,
            id_juizo:id_juizo,
            id_comarca:id_comarca
        },function(data){
            
            if(data == 0){
                $a('.alert').remove();
                $a('<div id="alert_editar_result" class="alert alert-error fade in"><p>O juízo <b>'+nome+'</b> não foi editado no sistema.</p></div>').appendTo('#msg_resultado');
            }
            else if(data==1){
                $a('.alert').remove();
                $a('<div id="alert_editar_result" class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O juízo <b>'+nome+'</b> foi editado no sistema com sucesso.</p></div>').appendTo('#msg_resultado');
                
                loadInicial();
                setTimeout(function() {
                    $a('.alert').remove();
                    $a('#myModal').modal('hide');
                },1200);
                
            }
        });
                    
    }
    
    function editarJuizo(){
        $a('.ok-modal-juizo').click(function(){          
            
            var mandar = valida_form_edita_juizo();
            if (mandar == true){
                edita_juizoAjax();                
            }            
        });
    }
    
    function valida_form_edita_juizo(){
        
        var $form = $a( '.altera_juizo_Ajax' )
        nome= $form.find( 'input[name="nome"]' ).val();
        
            
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
     
        $a('.altera_juizo_Ajax').keypress(function(e){
            if(e.which==13) return false;
            
            if(e.which ==13) e.preventDefault();


        }); 
        
    }

    $a(document).ready(function (){   
     
        loadInicial();
        bloqueiaEnter();
        editarJuizo();

    }); 
    
</script>