<script type="text/javascript">
    
    //SCRIPT QUE COMANDA A PAGINA DE RELAÇÃO DE PROCESSOS
    //FAZ A PROCURA DOS PROCESSOS POR AJAX
    
    var frente = true;
    var tras = true;
    
    function setarLimiteEvento(){

        $a('#limite').change(function(){
            
            setarLimiteAjax();
            removeAlerta();
        });     
                
    }//FUNCTION    
    
    function setarLimiteAjax(){
    
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
                $a('<div id="alert_ato" class="alert alert-info fade in"><p><h4>Não há <b>processos</b> cadastrados.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
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
    
    function buscaProcessoAjax(){    
     
        $a("#busca-input").keyup(function() {
            var txt =  $a("#busca-input").val();
            var url = 'getProcessosFiltro.php';            
            $a.post(url,
            {
                txt:txt 
            },function(data){
                removeAlerta();
                
                if(data==1){
                    $a('#tabela').remove();
                    $a('.centro').show();
                    setarLimiteAjax();
                } 
                
                else if(data==-1){
                     
                } 
                
                else if(data==0){
                     $a('#tabela').remove();
                     $a('.centro').hide();
                    $a('<div id="alert_filtro" class="alert alert-info fade in"><p><h4>Processo não existe.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
                } 
                
                else{
                    $a('#tabela').remove();
                    $a('.centro').hide();                  
                    $a(data).appendTo('#tabela_container');
                }
                
            });//post
        });//keyup       

    } 
    
    function removeAlerta(){
        $a('#alert_filtro').remove();
    }
    
    
    
    $a(document).ready(function (){   
        loadInicial();
        setarLimiteEvento();
        irPraFrente();
        irPraTras();
        buscaProcessoAjax();
    
        
    }); 

</script>

