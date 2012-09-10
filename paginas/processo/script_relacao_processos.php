<script type="text/javascript">
    
    var frente = true;
    var tras = true;
    
    function setarLimite(){

        $a('#limite').change(function(){
            var limite = $a('#limite :selected').val();         
            var url = 'get_relacao_processos.php';
            var modalidade = 0;            
          
            
            //alert("oi");
            
         
            $a.post(url,{
                limite:limite,
                modalidade:modalidade
                
            }, function(data){
                
                //alert(data);
                
                split_data = data.split('!');
                
                //alert(split_data[1]);
                
                $a('#tabela').remove();
                $a(split_data[0]).appendTo('#tabela_container');
                
                if(split_data[2]==1){
                    //alert('deu 1 setar');
                    $a('#botao_proximo').addClass('disabled');
                    frente = false;
                }
                else{
                    $a('#botao_proximo').removeClass('disabled');
                    frente = true;
                    
                }
                
                if(split_data[1]==2){
                    //alert('deu 2 setar');
                    $a('#botao_anterior').addClass('disabled');  
                    tras= false;
                }
                else{
                    $a('#botao_anterior').removeClass('disabled');
                    tras= true;
                }
                
            });
        });     
                
    }
    
    
    function irPraFrente(){
       
        $a('#botao_proximo').click(function(){
            var limite = $a('#limite :selected').val();         
            var url = 'get_relacao_processos.php';
            var modalidade = 1;
         
            if(frente == true){
         
                $a.post(url,{
                    limite:limite,               
                    modalidade:modalidade
                
                }, function(data){
                    //alert(data);
                    //alert('den');
                    split_data = data.split('!');
                
                    //alert(split_data[1]);
                
                    $a('#tabela').remove();
                    $a(split_data[0]).appendTo('#tabela_container');
                
                    if(split_data[1]==1){
                        //alert('deu 1 load');
                        $a('#botao_proximo').addClass('disabled');  
                        frente = false;
                    }
                    else{
                        $a('#botao_proximo').removeClass('disabled');
                        frente = true;
                    }
                
                    if(split_data[2]==2){
                        //alert('deu 2 load');
                        $a('#botao_anterior').addClass('disabled');
                        tras= false;
                    }
                    else{
                        $a('#botao_anterior').removeClass('disabled');
                        tras= true;
                    }
                
                });
            }

        });     
              
                
    }
    
    function irPraTras(){
       
        $a('#botao_anterior').click(function(){
            var limite = $a('#limite :selected').val();       
            var url = 'get_relacao_processos.php';
            var modalidade = 2;
            
            //alert("oi");
            
            if(tras==true){ 
                $a.post(url,{
                    limite:limite,
                    modalidade:modalidade
                
                }, function(data){
                    //alert(data);
                    split_data = data.split('!');
                
                    //alert(split_data[1]);
                
                    $a('#tabela').remove();
                    $a(split_data[0]).appendTo('#tabela_container');
                
                    if(split_data[2]==1){
                        // alert('deu 1 load');
                        $a('#botao_proximo').addClass('disabled');  
                        frente = false;
                    }
                    else{
                        $a('#botao_proximo').removeClass('disabled');
                        frente = true;
                    }
                
                    if(split_data[1]==2){
                        //alert('deu 2 load');
                        $a('#botao_anterior').addClass('disabled'); 
                        tras= false;
                    }
                    else{
                        $a('#botao_anterior').removeClass('disabled');
                        tras= true;
                    }
                
                });
            }

        });     
              
                
    }
    
    
    
    function loadInicial(){
            
        var limite = 5;
        var tipo = $a('#tipo').val();            
        var url = 'get_relacao_processos.php';
        var modalidade = -1;
            
        //alert("oi");
            
         
        $a.post(url,{
            limite:limite,
            modalidade:modalidade
                
        }, function(data){
            //alert(data);
            split_data = data.split('!');
                
            //alert(split_data[1]);
                
            $a('#tabela').remove();
            $a(split_data[0]).appendTo('#tabela_container');
                
            if(split_data[2]==1){
                //alert('deu 1 load');
                $a('#botao_proximo').addClass('disabled');
                frente = false;
            }
            else{
                $a('#botao_proximo').removeClass('disabled');
                frente = true;
            }
                
            if(split_data[1]==2){
                //alert('deu 2 load');
                $a('#botao_anterior').addClass('disabled');  
                tras= false;
            }
            else{
                $a('#botao_anterior').removeClass('disabled');
                tras= true;
            }
                
        });

        
    }
    
    $a(document).ready(function (){   
        loadInicial();
        setarLimite();
        irPraFrente();
        irPraTras();
       
 
    
    }); 

</script>

