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
            }
                
        });
    }
    
    $a(document).ready(function (){   
        loadInicial();
    }); 
    
</script>