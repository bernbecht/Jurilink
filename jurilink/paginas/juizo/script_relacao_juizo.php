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
                //Edição
                modal_juizo();
            }
                
        });
    }
    
    function modal_juizo(){
        $a('.editar-juizo').click(function(){
                        
            $a('#myModal').modal('show');
            $a('#nome_input').focus();
            $a('#nome').removeClass("error");
            
            //Pega o nome da comarca junto com o ID da mesma
            var dado = $a(this).find('input').val();
            var dado_split = dado.split('|');
            var nome = dado_split[0];
            var id_comarca = dado_split[1];
                
            //Põe o nome da comarca no campo do Modal
            var $form = $a( '.altera_juizo_Ajax' )
            $form.find( 'input[name="nome"]' ).val(nome),
            $form.find( 'input[name="id"]' ).val(id_juizo);
    
            
        });
    
    }
    
    $a(document).ready(function (){   
        loadInicial();
    }); 
    
</script>