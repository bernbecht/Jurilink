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
    protected $id_pessoa;

    function CPessoa() {
        
    }

    public function editarConta($conexao,$email,$telefone,$estado,$endereco,$cidade,$bairro,$id_pessoa){
        $this->email = $email;
        $this->telefone = $telefone;
        $this->uf = $estado;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->id_pessoa=$id_pessoa;
        $editar = null;
        
        $query = "UPDATE pessoa SET endereco = '".$this->endereco."',
                                 cidade ='".$this->cidade."',
                                 tel = '".$this->telefone."',
                                 bairro = '".$this->bairro."',
                                 email = '".$this->email."',
                                 id_uf = ".$this->uf."
                WHERE pessoa.id_pessoa = $this->id_pessoa";

        $editar = pg_query($conexao,$query);
        
        return $editar;
        
        
    }
    
    
    public function editarPessoa($conexao,$id_pessoa, $n, $e, $em, $t, $c, $uf, $b, $tipo) {
        $this->nome = $n;
        $this->endereco = $e;
        $this->email = $em;
        $this->telefone = $t;
        $this->cidade = $c;
        $this->uf = $uf;
        $this->bairro = $b;
        $this->tipo = $tipo;
        $this->id_pessoa = $id_pessoa;
        $editar = null;
        
        $query = "UPDATE pessoa SET nome = '".$this->nome."', endereco = '".$this->endereco."',
            tel = '".$this->telefone."', cidade = '".$this->cidade."',id_uf =".$this->uf.",
            email = '".$this->email."',bairro = '".$this->bairro."' WHERE pessoa.id_pessoa = $this->id_pessoa";
        
        $editar = pg_query($conexao,$query);
        return $editar;
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

        //Insere no Banco e Retorna o id_pessoa
        $incluir = pg_exec($conexao, "insert into pessoa(nome,endereco,tel,cidade,id_uf,email,tipo,bairro)
                         values('"
                . $this->nome . "','"
                . $this->endereco . "','"
                . $this->telefone . "','"
                . $this->cidade . "',"
                . $this->uf . ",'"
                . $this->email . "', "
                . $this->tipo . ",'"
                . $this->bairro . "') RETURNING id_pessoa");

        $resultado = pg_fetch_object($incluir);

        return $resultado->id_pessoa;
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
        $sql = pg_exec($conexao, "select id_pessoa from pessoa where email='" . $email . "'");
        $resultado = pg_fetch_object($sql);

        return $resultado->id_pessoa;
    }

    /* Operação Usada pelo AUTOCOMPLETE para procurar id por nome 
     * e restringir por TIPO.
     * Usado no AUTOCOMPLETE DA PAGINA DE PROCESSO
     */

    public function getPessoaNomeTipo($nome, $t) {
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
    public function getIDPessoaNome($conexao1, $p) {
        $array_data = explode(',', $p);
        $n = count($array_data);
        $i = 0;
        
        while ($i < $n) {
            if ($array_data[$i] != '') {
                $array_data[$i] = ltrim($array_data[$i]);
                $array_data[$i] = rtrim($array_data[$i]);
            }
            $i++;
        }
        $i = 0;
        
        while ($i < $n) {
            if ($array_data[$i] != '') {
                $sql = pg_query($conexao1, "select * 
                        from pessoa 
                        where nome = '{$array_data[$i]}' ");
                 
                $resultado = pg_fetch_object($sql);
                
                if ($resultado->id_pessoa == '') {
                    return -1;
                } else {
                    //$resultado = pg_fetch_object($sql);

                    $id[] = $resultado->id_pessoa;
                    //echo $resultado;
                    //echo $array_data[$i] . " " . $id[$i] . " ";
                }
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

    public function getPessoas($tipo, $limite, $offset) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();
        
        $pesquisa = null;
        $query = null;
        $registros = null;
        switch ($tipo) {
            //Retorna relação de pessoas físicas
            case 0:
                $query = "select pessoa.nome as nome_pessoa, pessoa.id_pessoa, fisica.cpf, fisica.rg, pessoa.email, 
                pessoa.tel, pessoa.cidade, uf.nome as nome_estado from pessoa, fisica, uf where
                pessoa.id_pessoa = fisica.id_pessoa and pessoa.id_uf = uf.id_uf and pessoa.tipo = 0 order by nome_pessoa 
                limit $limite offset $offset";

                $pesquisa = pg_exec($conexao, $query);

                $query = "select count (nome) from pessoa, fisica where pessoa.id_pessoa = fisica.id_pessoa and pessoa.tipo = 0";
                $registros = pg_exec($conexao, $query);

                return array($pesquisa, $registros);
                break;

            //Retorna relação de pessoas jurídicas
            case 1:
                $query = "select pessoa.nome as nome_pessoa, pessoa.id_pessoa, juridica.cnpj, pessoa.email, 
                pessoa.tel, pessoa.cidade, uf.nome as nome_estado from pessoa, juridica, uf where
                pessoa.id_pessoa = juridica.id_pessoa and pessoa.id_uf = uf.id_uf and pessoa.tipo = 1 order by nome_pessoa limit $limite offset $offset";

                $pesquisa = pg_exec($conexao, $query);

                $query = "select count (nome) from pessoa, juridica where pessoa.id_pessoa = juridica.id_pessoa and pessoa.tipo = 1";
                $registros = pg_exec($conexao, $query);

                return array($pesquisa, $registros);
                break;

            //Retorna relação de advogados
            case 2:
                $query = "select pessoa.nome as nome_pessoa,pessoa.id_pessoa, advogado.flag_func, advogado.oab,
                fisica.cpf, fisica.rg, pessoa.email, pessoa.tel, pessoa.cidade, uf.nome as nome_estado
                from advogado, fisica, pessoa, uf
                where pessoa.id_pessoa = fisica.id_pessoa and pessoa.id_uf = uf.id_uf and pessoa.tipo = 2 
                and pessoa.id_pessoa = advogado.id_pessoa order by nome_pessoa limit $limite offset $offset";

                $pesquisa = pg_exec($conexao, $query);

                $query = "select count (nome) from pessoa, advogado where pessoa.id_pessoa = advogado.id_pessoa and pessoa.tipo = 2";
                $registros = pg_exec($conexao, $query);

                return array($pesquisa, $registros);
                break;        
        }
    }

}

?>
