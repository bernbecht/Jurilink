<script type="text/javascript">
    
    var frente = true;
    var tras = true;
    
    //função que tem o envento de OnChange da combobox de limite
    function setarLimite(){                
        
        $a('#limite').change(function(){
            setarLimiteAjax();
        });       
    }
    
    //função que carrega a tabela de pessoas de acordo com a combobox de LIMITE
    function setarLimiteAjax(){
        var limite = $a('#limite :selected').val();
        var tipo = $a('#tipo').val();            
        var url = 'get_relacao_pessoa.php';
        var modalidade = 0;
         
        $a.post(url,{
            limite:limite,
            tipo:tipo,
            modalidade:modalidade
                
        }, function(data){
                
            split_data = data.split('!');               
            
            $a('#tabela').remove();
            $a(split_data[0]).appendTo('#tabela_container');
                
            if(split_data[2]==1){
                 
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
                tras = false;
            }
            else{
                $a('#botao_anterior').removeClass('disabled');
                tras = true;
            }
                
        });
    }
    
    //função que avança a página
    function irPraFrente(){
       
        $a('#botao_proximo').click(function(){
            var limite = $a('#limite :selected').val();
            var tipo = $a('#tipo').val();            
            var url = 'get_relacao_pessoa.php';
            var modalidade = 1;
            
            //alert("oi");
            
            if(frente == true){
                $a.post(url,{
                    limite:limite,
                    tipo:tipo,
                    modalidade:modalidade
                
                }, function(data){
                    //alert(data);
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
                        tras = false;
                    }
                    else{
                        $a('#botao_anterior').removeClass('disabled');
                        tras = true;
                    }
                
                });
            }
        });       
    }
    
    //função que retrocede com a página
    function irPraTras(){
       
        $a('#botao_anterior').click(function(){
            var limite = $a('#limite :selected').val();
            var tipo = $a('#tipo').val();            
            var url = 'get_relacao_pessoa.php';
            var modalidade = 2;
            
            if(tras == true){
                $a.post(url,{
                    limite:limite,
                    tipo:tipo,
                    modalidade:modalidade
                
                }, function(data){
                 
                    split_data = data.split('!');
                
                
                    $a('#tabela').remove();
                    $a(split_data[0]).appendTo('#tabela_container');
                
                    if(split_data[2]==1){
                 
                        $a('#botao_proximo').addClass('disabled'); 
                        frente = false;
                    }
                    else{
                        $a('#botao_proximo').removeClass('disabled');
                        frente = true;
                    }
                
                    if(split_data[1]==2){
                      
                        $a('#botao_anterior').addClass('disabled');  
                        tras = false;
                    }
                    else{
                        $a('#botao_anterior').removeClass('disabled');
                        tras = true;
                    }
                
                });
            }
        });      
    }   
    
    //função que carrega a tabela de pessoas quando a página é carregada
    function loadInicial(){
            
        var limite = 5;
        var tipo = $a('#tipo').val();            
        var url = 'get_relacao_pessoa.php';
        var modalidade = -1; 
        
        $a.post(url,{
            limite:limite,
            tipo:tipo,
            modalidade:modalidade
                
        }, function(data){
          
            if(data==0){
                $a('<div id="alert_ato" class="alert alert-info fade in"><p><h4>Nao ha <b>pessoas</b> cadastradas.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
            }
            else{
                split_data = data.split('!');
       
                $a('#tabela').remove();
                $a(split_data[0]).appendTo('#tabela_container');
                
                if(split_data[2]==1){
        
                    $a('#botao_proximo').addClass('disabled'); 
                    frente = false;
                }
                else{
                    $a('#botao_proximo').removeClass('disabled');
                    frente = true;
                }
                
                if(split_data[1]==2){
              
                    $a('#botao_anterior').addClass('disabled');  
                    tras = false;
                }
                else{
                    $a('#botao_anterior').removeClass('disabled');
                    tras =  true;
                }
            }
                
        });
    }
    
    //função que cuida do filtro de pessoas da página de relações
    function buscaPessoaAjax(){    
     
        $a("#busca-input").keyup(function() {
            var txt =  $a("#busca-input").val();
            var url = 'getPessoaFiltro.php'; 
            
            //pega o endereço da pagina
            var href = location.href;
            
            //separa num array os valores divididos por um '_'        
            var href_split = href.split('_');
            
            if(href_split[1]=="pfisica.php"){
                var modalidade =  1;
            }
            else if(href_split[1]=="pjuridica.php"){
                var modalidade =  2;
            }
            else if(href_split[1]=="padvogado.php"){
                var modalidade =  3;
            }
          
            $a.post(url,
            {
                txt:txt,
                modalidade:modalidade
            },function(data){
                removeAlerta();
                
                //quando o servidor percebe que o campo está vazio                
                if(data==1){
                    
                    $a('#tabela').remove();
                    $a('.centro').show();
                    setarLimiteAjax();
                } 
                
                //quando a string não é aceita pelo servidor
                else if(data==-1){
                     
                } 
                
                //se a string é válida mas retornou nada do BD
                else if(data==0){
                    $a('#tabela').remove();
                    $a('.centro').hide();
                    $a('<div id="alert_filtro" class="alert alert-info fade in"><p><h4>Pessoa não existe.</h4></p></div>').appendTo('#tabela_container'); // appendTo é pra por em algum lugar                
                } 
                
                //quando alguma informação é retornada do BD
                else{
                    $a('#tabela').remove();
                    $a('.centro').hide();   
                    //alert(data);
                    $a(data).appendTo('#tabela_container');
                }
                
            });//post        
          
        });//keyup       

    } 
    
    //função que retira a imagem de erro do filtro
    function removeAlerta(){
        $a('#alert_filtro').remove();
    }
    
    $a(document).ready(function (){   
        loadInicial();
        setarLimite();
        irPraFrente();
        irPraTras();
        buscaPessoaAjax(); 
    }); 

</script>

