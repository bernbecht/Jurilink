<?php

class CConexao {
  protected $Host='177.101.20.68';
  protected $User='jlink';
  protected $Password='senha';
  protected $Porta='5432';
  protected $DbName='Jlink';
  protected $Conexao=null;

    public function __construct(){}
    public function  __destruct() {}

    public function novaConexao(){
   
    $this->Conexao =  @pg_connect("host='".$this->Host.
            "' user='".$this->User.
            "' password='".$this->Password.
            "'port='".$this->Porta
            ."' dbname='".$this->DbName."'");
    return $this->Conexao;
   }

  public function verificaConexao(){

    if(!$this->Conexao){
      echo '<h3>N&atilde;o estamos conectados ao banco [' .$this->DbName.'] em ['.$this->Host.'].</h3>';
      exit;
       }
    else{
      echo '<h3>Estamos conectados ao banco ['.$this->DbName.'] em ['.$this->Host.'].</h3>';
        }
   }
    public function closeConexao(){

    @pg_close($this->Conexao);
  }

}

?>
