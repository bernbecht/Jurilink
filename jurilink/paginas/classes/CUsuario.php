<?php

include_once 'CConexao.php';

class CUsuario {

    protected $id_pessoa;
    protected $email;
    protected $senha;
    
    public function editarUser($conexao, $id_pessoa, $s, $em) {
        $this->id_pessoa = $id_pessoa;
        if ($s == 0) {
            $query = "UPDATE usuario SET  email = '" . $em . "'
            WHERE id_pessoa = " . $this->id_pessoa . "";
        } 
       
        else {
            $this->senha = $s;
            $query = "UPDATE usuario SET  email = '" . $em . "',
              senha='" . $this->senha . "' 
            WHERE id_pessoa = " . $this->id_pessoa . "";
        }

        $editar = null;

        if ($conexao == 0) {
            $conexao1 = new CConexao();
            $conexao = $conexao1->novaConexao();
        }

        $editar = pg_query($conexao, $query);
        return $editar;
    }

    public function editarSenha($s, $em) {

        $query = "UPDATE usuario SET  senha = '" . $s . "'
            WHERE email = '" . $em . "'";

        $editar = null;

        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();


        $editar = pg_query($conexao, $query);
        return $editar;
    }
    public function alterarSenha($conexao,$id_pessoa,$senha) {

        $this->senha = $senha;
        $this->id_pessoa = $id_pessoa;
        
        $query = "UPDATE usuario SET  senha = '" . $this->senha . "'
            WHERE id_pessoa = '" . $this->id_pessoa . "'";

        $editar = null;

        $editar = pg_query($conexao, $query);
        return $editar;
    }

    public function excluirUser($conexao, $id_pessoa) {
        $this->id_pessoa = $id_pessoa;
        $excluir = null;

        $query = "DELETE from usuario WHERE id_pessoa =" . $this->id_pessoa . "";
        $excluir = pg_query($conexao, $query);
        return $excluir;
    }

    public function incluirUser($conexao, $id_pessoa, $s, $em) {

        $this->id_pessoa = $id_pessoa;
        $this->senha = md5($s);
        $this->email = $em;
        $incluir = null;

        $incluir = pg_exec($conexao, "insert into usuario(id_pessoa,senha,email)
                         values(
                {$this->id_pessoa},'"
                . $this->senha . "',
                 '" . $this->email . "')");


        return $incluir;
    }

    public function ehUser($id_pessoa) {

        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $query = "select * from usuario where usuario.id_pessoa = $id_pessoa";

        $pesq_user = pg_exec($conexao, $query);

        $user = pg_fetch_object($pesq_user);

        return $user;
    }

}

?>
