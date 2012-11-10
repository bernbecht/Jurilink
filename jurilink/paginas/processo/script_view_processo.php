<script type="text/javascript">
    
    var id_audiencia_excluida = null;
    var id_processo_excluido = null;
    var id_ato_excluido = null;
    
    
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
                excluirAto();
                tooltip();
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
            excluirAto();
            tooltip();
        });          

    }
    
    function retornaNumAtos(){
        $a('#max_ato').click(function(){
            
            loadAtos();   
            tooltip();			
            
        });
    }
    
    
    //Função que pega o ID do ATO e do Processo num campo hidden e exclui o ATO
    function confirmacaoExcluirAto(){
        var url = '../operacoes/CProcesso_ato/excluir_ato_op.php';
        
        $a('#excluir-ato-button').click(function(){            
                      
            var id_processo = id_processo_excluido;
            var id_ato = id_ato_excluido;
                      
            
            $a.post(url,{
                id_processo:id_processo,
                id_ato:id_ato               
            }, function(data){   
                
                //para fazer com que a dica de EXCLUIR suma.
                $a('.tooltip_class').tooltip('hide');
                $a('#exclusaoAtoModal').modal('hide');
                loadAtos();  
            }); 
        });
        
    }
    
     
    //função que pega o ID do Ato e do Processo e coloca num campo hidden no HTML
    function excluirAto(){
        $a('.excluir-ato').click(function(){            
            
            var target = $a(this); 
            var dado = target.find('input').val();  
            var dado_split = dado.split('|');
            var id_processo = dado_split[1];
            var id_ato = dado_split[0];
            
            id_processo_excluido = id_processo;
            id_ato_excluido = id_ato;
           
        });
    }
    
    function confirmacaoExcluirAudiencia(){
      
        var url = '../operacoes/CAudiencia/excluir_audiencia_op.php';
    
        $a('#excluir-audiencia-button').click(function(){    
           
            var id_audiencia = id_audiencia_excluida;
           
            $a.post(url,{
                id_audiencia:id_audiencia            
            }, function(data){              
                alert('PostAud');
                loadAudiencia();
                excluirAudiencia(); 
                $a('#exclusaoAudienciaModal').modal('hide');                    
            });
        });
    }
    
    
    function excluirAudiencia(){
        $a('.excluir-audiencia').click(function(){            
                      
            var dado = $a(this).find('input').val();  
          
            id_audiencia_excluida = dado;
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
                excluirAudiencia();
                tooltip();
                
            });            
            
        });
    
    }
   
    
    function loadAudiencia(){   
        
        var id_processo = $a('#id').val();       
        var limite = 5;
        
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
            excluirAudiencia();
            tooltip();
        });          

    }
    
    function retornaNumAudiencia(){
        $a('#max_audiencia').click(function(){
            loadAudiencia();   
            excluirAudiencia();
            tooltip();
            
        });
    }
    
    
    $a(document).ready(function (){   
     
        loadAudiencia();
        todasAudiencia();
        todosAtos();
        loadAtos();
        retornaNumAtos();
        retornaNumAudiencia();
        excluirAto();
        excluirAudiencia();    
        confirmacaoExcluirAto();
        confirmacaoExcluirAudiencia();
    
    }); 

</script>
