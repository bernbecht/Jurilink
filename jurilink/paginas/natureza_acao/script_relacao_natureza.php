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
            }
                
        });
    }
    
    $a(document).ready(function (){   
        loadInicial();
    }); 
    
</script>