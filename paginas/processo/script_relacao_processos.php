<script type="text/javascript">
    
    //SCRIPT QUE COMANDA A PAGINA DE RELAÇÃO DE PROCESSOS
    //FAZ A PROCURA DOS PROCESSOS POR AJAX
    
    var frente = true;
    var tras = true;
    
    function setarLimite(){

        $a('#limite').change(function(){
            var limite = $a('#limite :selected').val();         
            var url = 'get_relacao_processos.php';
            var modalidade = 0;            
                      
         
            $a.post(url,{
                limite:limite,
                modalidade:modalidade
                
            }, function(data){
                
                split_data = data.split('!');
                
                
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
                
    }//FUNCTION    
    
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
    }//fuinction
    
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
    }//function
    
    
    
    function loadInicial(){
            
        var limite = 5;
        var tipo = $a('#tipo').val();            
        var url = 'get_relacao_processos.php';
        var modalidade = -1;
        
        $a.post(url,{
            limite:limite,
            modalidade:modalidade
                
        }, function(data){
            
            //se tiver nenhum processo, mostre
            if(data==0){
                 $a('<div id="alert_ato" class="alert alert-info fade in"><p><h4>Nao ha <b>processos</b> cadastrados.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
            }            
            else{
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

