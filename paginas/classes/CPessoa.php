<?php

include_once 'CConexao.php';

class CPessoa {

    protected $nome;
    protected $endereco;
    protected $email;
    protected $telefone;
    protected $cidade;
    protected $uf;
    protected $bairro;
    protected $tipo;

    function CPessoa() {
        
    }

    public function incluirPessoa($conexao, $n, $e, $em, $t, $c, $uf, $b, $tipo) {
        $this->nome = $n;
        $this->endereco = $e;
        $this->email = $em;
        $this->telefone = $t;
        $this->cidade = $c;
        $this->uf = $uf;
        $this->bairro = $b;
        $this->tipo = $tipo;
        $incluir = null;


        // $conexao1 = new CConexao();
        //  $conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao, "insert into pessoa(nome,endereco,tel,cidade,id_uf,email,tipo,bairro)
                         values('"
                . $this->nome . "','"
                . $this->endereco . "','"
                . $this->telefone . "','"
                . $this->cidade . "',"
                . $this->uf . ",'"
                . $this->email . "', "
                . $this->tipo . ",'"
                . $this->bairro . "')");

        // $conexao1->closeConexao();

        return $incluir;
    }

    public function incluirPessoa1($n, $e, $em, $t, $c, $uf, $b, $tipo) {
        $this->nome = $n;
        $this->endereco = $e;
        $this->email = $em;
        $this->telefone = $t;
        $this->cidade = $c;
        $this->uf = $uf;
        $this->bairro = $b;
        $this->tipo = $tipo;
        $incluir = null;


        $conexao1 = new CConexao();

        $conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao, "insert into pessoa(nome,endereco,tel,cidade,id_uf,email,tipo,bairro)
                         values('"
                . $this->nome . "','"
                . $this->endereco . "','"
                . $this->telefone . "','"
                . $this->cidade . "',"
                . $this->uf . ",'"
                . $this->email . "', "
                . $this->tipo . ",'"
                . $this->bairro . "')");

        $conexao1->closeConexao();

        return $incluir;
    }

    public function excluirPessoa($id_pessoa) {
        $conexao1 = new CConexao();


        $conexao = $conexao1->novaConexao();
        pg_exec($conexao, "delete 
                                from pessoa
                                     where id_pessoa=" . $id_pessoa);

        $conexao1->closeConexao();
    }

    //Retorna o ID da pessoa passando o email
    public function getId($conexao, $email) {
        //$conexao1 = new CConexao();
        //$conexao = $conexao1->novaConexao();
        $sql = pg_exec($conexao, "select id_pessoa from pessoa where email='" . $email . "'");
        $resultado = pg_fetch_object($sql);

        //$conexao1->closeConexao();

        return $resultado->id_pessoa;
    }

    /*Operação Usada pelo AUTOCOMPLETE para procurar id por nome 
     * e restringir por TIPO.
     * Usado no AUTOCOMPLETE DA PAGINA DE PROCESSO
     */
    public function getPessoaNomeTipo($nome,$t) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $sql = pg_exec($conexao, "select * 
            from pessoa 
            where nome like '{$nome}%' 
            and tipo= {$t}
            ");

        $conexao1->closeConexao();

        return $sql;
    }
    
    
    //Operação Usada pelo AUTOCOMPLETE para procurar id por nome
    public function getPessoaNome($nome) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $sql = pg_exec($conexao, "select * 
            from pessoa 
            where nome like '{$nome}%' 
            ");

        $conexao1->closeConexao();

        return $sql;
    }

    //Retorna um array de ID das pessoas dando o nome
    public function getIDPessoaNome($conexao1, $autor) {

        $array_data = explode(',', $autor);
        $n = count($array_data);
        $i = 0;

        while ($i < $n) {
            if ($array_data[$i] != '') {
                $sql = pg_exec($conexao1, "select * 
                        from pessoa 
                        where nome = '{$array_data[$i]}' ");

                $resultado = pg_fetch_object($sql);

                $id[] = $resultado->id_pessoa;

                echo $array_data[$i] . " " . $id[$i] . " ";
            } else {
                echo "Nada cadastrado";
                return null;
            }
            $i++;
        }

        return $id;
    }

    //retorna o nome da pessoa pelo id
    public function getPessoa($id) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();
        $sql = pg_exec($conexao, "select nome from pessoa where id_pessoa='" . $id . "'");
        $resultado = pg_fetch_object($sql);

        $conexao1->closeConexao();

        return $resultado->nome;
    }

     //Pega o ID da pessoa pelo nome
    public function getIDNome($nome) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $sql = pg_exec($conexao, "select nome from pessoa where nome ='" . $nome . "' ");

        $conexao1->closeConexao();

        return $sql;
    }

}

?>
