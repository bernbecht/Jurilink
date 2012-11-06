<script type="text/javascript">
    
    //SCRIPT QUE COMANDA A PAGINA DE RELAÇÃO DE COMARCAS
    //FAZ A PROCURA DE COMARCAS POR AJAX


    function loadInicial(){
            
        var url = 'get_relacao_comarcas.php';
               
        $a.post(url, function(data){
            
            //se tiver nenhuma comarca, mostre
            if(data==0){
                $a('<div id="alert_comarca" class="alert alert-info fade in"><p><h4>Não há <b>comarcas</b> cadastradas.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
            }            
            else{
                $a('#tabela').remove();
                $a(data).appendTo('#tabela_container');
                
                //como a tabela de dados é algo dinâmico, é associá-la com o método 
                tooltip();
                //Edição
                modal_comarca();
                editar_comarca();
            }
        });
    }
    
    function modal_comarca(){
        $a('.editar-comarca').click(function(){
            // Mostra modal para alteração
            
            $a('.alert').remove();
            
            $a('#myModal').modal('show');
            $a('#nome_input').focus();
            $a('#nome').removeClass("error");
            
            //Pega o nome da comarca junto com o ID da mesma
            var dado = $a(this).find('input').val();
            var dado_split = dado.split('|');
            var nome = dado_split[0];
            var id_comarca = dado_split[1];
                
            //Põe o nome da comarca no campo do Modal
            var $form = $a( '.altera_comarca_Ajax' )
            $form.find( 'input[name="nome"]' ).val(nome),
            $form.find( 'input[name="id"]' ).val(id_comarca);
    
        });
    
    }
    
    function edita_comarcaAjax(){
        var $form = $a( '.altera_comarca_Ajax' )
        nome = $form.find( 'input[name="nome"]' ).val(),
        id_comarca = $form.find( 'input[name="id"]' ).val(),
        url = $form.attr( 'action' );
        
        
        
        $a.post(url,{
            nome:nome,
            id_comarca:id_comarca
        },function(data){
            if(data == 0){
                $a('.alert').remove();
                $a('<div class="alert alert-error fade in"><p>A comarca <b>'+nome+'</b> não foi inserida no sistema. Verifique se o nome está correto.</p></div>').appendTo('#msg_resultado_edita_comarca');
            }
            else if(data==1){
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><p>A comarca <b>'+nome+'</b> foi editada no sistema com sucesso.</p></div>').appendTo('#msg_resultado_edita_comarca');
                
                loadInicial();
                setTimeout(function() {
                    $a('#myModal').modal('hide');
                },1200);
            }
        });
            
    }
    
    function editar_comarca(){
        $a('.ok-modal-comarca').click(function(){
            var mandar = valida_form_edita_comarca();
            if (mandar == true){
                edita_comarcaAjax();
                
            }
            
        });
    }
    
    function valida_form_edita_comarca(){
        
        var $form = $a( '.altera_comarca_Ajax' ),
        nome = $form.find( 'input[name="nome"]' ).val(),
        id_comarca = $form.find( 'input[name="id"]' ).val();
            
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

    

    
    $a(document).ready(function (){   
     
        loadInicial();
        $a('.altera_comarca_Ajax').keypress(function(e){
            if(e.which==13) return false;
            
            if(e.which ==13) e.preventDefault();
        });

    }); 
    
</script>