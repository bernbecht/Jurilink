<script type="text/javascript">
    
    function todosProcessosCom(){
        var id = $a('#id').val();
        var href = location.href;
        href= href.split('_');
        href= href[1].split('.');
        var url = 'pega_processos_com.php';
        
        
        
        $a('#todos_processos_com').click(function(){            
            //alert(id);            
            $a.post(url,{
                id_pessoa:id,
                href: href[0]                
            }, function(data){
                $a("#tabela_processo_cliente").remove();
                $a(data).appendTo("#container_tabela_processo_cliente");                
            });
            
            
        });
    }
    
    function todosProcessosContra(){
        var id = $a('#id').val();
        var href = location.href;
        href= href.split('_');
        href= href[1].split('.');
        var url = 'pega_processos_contra.php';
        
        
        $a('#todos_processos_contra').click(function(){            
            //alert(id);            
            $a.post(url,{
                id_pessoa:id,
                href: href[0]                
            }, function(data){
                //alert(data);
                $a("#tabela_processo_contra").remove();
                $a(data).appendTo("#container_tabela_processo_contra");                
            });
            
            
        });
    }
    
    
    $a(document).ready(function (){   
        todosProcessosCom();
        todosProcessosContra();
       
      // alert("OI");
 
 
    
    }); 

</script>
