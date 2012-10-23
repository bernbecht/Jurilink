<script type="text/javascript">
    
    //SCRIPT QUE COMANDA A PAGINA DE RELAÇÃO DE ATOS
    //FAZ A PROCURA DE ATOS POR AJAX


function loadInicial(){
            
        var url = 'get_relacao_atos.php';
               
        $a.post(url, function(data){
            
            //se tiver nenhuma comarca, mostre
            if(data==0){
                 $a('<div id="alert_ato" class="alert alert-info fade in"><p><h4>Não há <b>atos</b> cadastrados.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
            }            
            else{
                $a('#tabela').remove();
                $a(data).appendTo('#tabela_container');
                
                 //como a tabela de dados é algo dinâmico, é associá-la com o método 
                tooltip();
            }
                
        });
    }
    
    $a(document).ready(function (){   
        loadInicial();
    }); 
    
</script>