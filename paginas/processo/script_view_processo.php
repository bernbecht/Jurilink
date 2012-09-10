<script type="text/javascript">
    
    function todosAtos(){
        $a('#todos_atos').click(function(){
        
            var id_processo = $a('#id').val();       
            var limite = 1000000;        
     
            var url = 'get_todos_atos.php';
        
            $a.post(url,{
                id_processo:id_processo,
                limite:limite                
            }, function(data){
                //alert(data);
                $a(".tabela_at").remove();
                $a(data).appendTo("#tabela_ato");                
            });            
            
        });
    
    }
    
    function loadAtos(){   
        
        var id_processo = $a('#id').val();       
        var limite = 3;        
     
        var url = 'get_todos_atos.php';
        
        $a.post(url,{
            id_processo:id_processo,
            limite:limite                
        }, function(data){
            //alert(data);
            $a(".tabela_at").remove();
            $a(data).appendTo("#tabela_ato");     
            todosAtos();
        });          

    }
    
    function retornaNumAtos(){
        $a('#max_ato').click(function(){
            loadAtos();                     
            
        });
    }
    
    
    
    function todasAudiencia(){
        $a('#todas_audiencias').click(function(){
        
            var id_processo = $a('#id').val();       
            var limite = 1000000;        
     
            var url = 'get_todas_audiencias.php';
        
            $a.post(url,{
                id_processo:id_processo,
                limite:limite                
            }, function(data){
                //alert(data);
                $a(".tabela_aud").remove();
                $a(data).appendTo("#tabela_audiencia");                
            });            
            
        });
    
    }
   
    
    function loadAudiencia(){   
        
        var id_processo = $a('#id').val();       
        var limite = 3;
        
        //alert(id_processo);
        var url = 'get_todas_audiencias.php';
        
        $a.post(url,{
            id_processo:id_processo,
            limite:limite                
        }, function(data){
            //alert(data);
            $a(".tabela_aud").remove();
            $a(data).appendTo("#tabela_audiencia");    
            todasAudiencia();
        });          

    }
    
    function retornaNumAudiencia(){
        $a('#max_audiencia').click(function(){
            loadAudiencia();                   
            
        });
    }
    
    
    $a(document).ready(function (){   
     
        loadAudiencia();
        todasAudiencia();
        todosAtos();
        loadAtos();
        retornaNumAtos();
        retornaNumAudiencia();
       
        // alert("OI");
 
 
    
    }); 

</script>
