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
            }
                
        });
    }
    
    $a(document).ready(function (){   
        loadInicial();
    }); 
    
</script>