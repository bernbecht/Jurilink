<script type="text/javascript">
    
    //SCRIPT QUE COMANDA A PAGINA DE RELAÇÃO DE ATOS
    //FAZ A PROCURA DE ATOS POR AJAX


    function loadInicial(){
            
        var url = 'get_relacao_atos.php';
               
        $a.post(url, function(data){
            
            //se tiver nenhuma ato, mostre
            if(data==0){
                $a('<div id="alert_ato" class="alert alert-info fade in"><p><h4>Não há <b>atos</b> cadastrados.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
            }            
            else{
                $a('#tabela').remove();
                $a(data).appendTo('#tabela_container');
                
                //como a tabela de dados é algo dinâmico, é associá-la com o método 
                tooltip();
                //Edição
                modal_ato();
                editar_ato();
                reseta_form_modal();
            }
        });
    }
    
    function modal_ato(){
        $a('.editar-ato').click(function(){
            // Mostra modal para alteração
            
            $a('#myModal').modal('show');
            $a('#nome_input').focus();
            $a('#nome').removeClass("error");
            
            //Pega o nome da ato junto com o ID da mesma
            var dado = $a(this).find('input').val();
            var dado_split = dado.split('|');
            var nome = dado_split[0];
            var id_ato = dado_split[1];
            var descricao = dado_split[2];
            var previsao = dado_split[3];
            var flag_cliente = dado_split[4];
            
            //Põe o nome da ato no campo do Modal
            var $form = $a( '.altera_ato_Ajax' )
            $form.find( 'input[name="nome"]' ).val(nome),
            $form.find( 'input[name="id"]' ).val(id_ato),
            $form.find( 'input[name="descricao"]' ).val(descricao),
            $form.find( 'input[name="previsao"]' ).val(previsao);
            if (flag_cliente == 't'){
                $form.find('input[name="flag_userCheckbox"]').attr ( "checked" , true );
            }
            if (flag_cliente == 'f'){
                $form.find('input[name="flag_userCheckbox"]').attr ( "checked" , false );
            }
                
        });
    
    }
    
    function edita_atoAjax(){
        var $form = $a( '.altera_ato_Ajax' ),
        nome = $form.find( 'input[name="nome"]' ).val(),
        previsao = $form.find( 'input[name="previsao"]' ).val(),
        desc = $form.find( 'input[name="descricao"]' ).val(),
        id_ato = $form.find( 'input[name="id"]' ).val(),
        flag_cliente = $form.find( 'input[name="flag_userCheckbox"]:checked' ).val(),
        url = $form.attr( 'action' );
        
        $a('#myModal').modal('hide');

        
        
        if(flag_cliente == undefined) flag_cliente=0;
        
        
        $a.post(url,{
            nome:nome,
            id_ato:id_ato,
            previsao:previsao,
            desc:desc,
            flag_cliente:flag_cliente
        },function(data){
            if(data == 0){
                $a('.alert').remove();
                $a('<div class="alert alert-error fade in"><p>O ato <b>'+nome+'</b> não foi editado no sistema.</p></div>').appendTo('#aviso');
            }
            else if(data==1){
                $a('.alert').remove();
                $a('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">x</button><p>O ato <b>'+nome+'</b> foi editado no sistema com sucesso.</p></div>').appendTo('#aviso');
                
                loadInicial();
                
            }
        });
            
    }
    
    function editar_ato(){
        $a('.ok-modal-ato').click(function(){
            var mandar = valida_form_edita_ato();
            if (mandar == true){
                edita_atoAjax();
                
            }
            
        });
    }
    
    function valida_form_edita_ato(){
        $a('.alert').remove();
        
        //alert('oi');
    
        var intRegex = /^\d+$/;
        var floatRegex = /^([0-9]*\,[0-9]{2})$/;
                
        var $form = $a( '.altera_ato_Ajax' ),
        nome = $form.find( 'input[name="nome"]' ).val(),
        previsao = $form.find( 'input[name="previsao"]' ).val(),
        desc = $form.find( 'input[name="descricao"]' ).val();
        
        
        var mandar = true;
            
        if(nome.length < 2){
            $a('#nome').removeClass("control-group").addClass("control-group error");
            $a('#nome_input').focus();
            mandar =false;
        } else{
            $a('#nome').removeClass("error");             
        }
        if(previsao.length < 1){
            $a('#previsao').removeClass("control-group").addClass("control-group error");
            $a('#previsao_input').focus();
            mandar =false;
        } else{
            $a('#previsao').removeClass("error");
        }
        
        if(intRegex.test(previsao)) {
            $a('#previsao').removeClass("error");             
        }
        else{
            $a('#previsao').removeClass("control-group").addClass("control-group error");
        }
        
        if(desc.length < 2){
            $a('#descricao').removeClass("control-group").addClass("control-group error");
            $a('#descricao_input').focus();
            mandar =false;
        } else{
            $a('#descricao').removeClass("error");
        }
        
        return mandar;
    }

    function reseta_form_modal(){
        $a('.cancelar-modal-ato').click(function(){
            $a('#previsao').removeClass("error");    
            $a('#descricao').removeClass("error");
            $a('#nome').removeClass("error");
            
            
        });
        
    }

    
    function bloqueiaEnter(){
     
        $a('.altera_ato_Ajax').keypress(function(e){
            if(e.which==13) return false;
            
            if(e.which ==13) e.preventDefault();


        }); 
        
    }

    $a(document).ready(function (){   
     
        loadInicial();
        bloqueiaEnter();

    });  
    
</script>