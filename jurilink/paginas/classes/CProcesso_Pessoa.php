<?php

require_once 'CConexao.php';

class CProcesso_Pessoa {

    protected $id_processo;
    protected $id_pessoa;
    protected $flag_papel;
    protected $tipo;

    public function excluirParte($conexao, $id_processo, $flag, $tipo) {
        $this->id_processo = $id_processo;
        $this->id_pessoa = $id_pessoa;
        $this->flag_papel = $flag; //0 pessoa, 1 advogado, 2 representante
        $this->tipo = $tipo; //tipo 0 autor, 1 reu

        if ($this->tipo == 0)
            $query = "DELETE FROM autor WHERE flag_papel = $this->flag_papel and id_processo = $this->id_processo";
        if ($this->tipo == 1)
            $query = "DELETE FROM reu WHERE flag_papel = $this->flag_papel and id_processo = $this->id_processo";

        $excluir = pg_query($conexao, $query);
    }

    public function editarReu($conexao, $id_processo, $pessoa, $flag) {
        $this->id_processo = $id_processo;
        $this->id_pessoa = $pessoa;
        $this->flag_papel = $flag;
        $editar = null;

        $query = "insert into reu(id_pessoa,id_processo,flag_papel)
                         values(                
                    {$this->id_pessoa},
                    {$this->id_processo},
                    {$this->flag_papel})";

        $editar = pg_query($conexao, $query);
        return $editar;
    }

    public function editarAutor($conexao, $id_processo, $pessoa, $flag) {
        $this->id_processo = $id_processo;
        $this->id_pessoa = $pessoa;
        $this->flag_papel = $flag;
        $editar = null;

        $query = "insert into autor(id_pessoa,id_processo,flag_papel)
                         values(                
                    {$this->id_pessoa},
                    {$this->id_processo},
                    {$this->flag_papel})";

        $editar = pg_query($conexao, $query);
        return $editar;
    }

    public function incluirAutor($conexao1, $processo, $pessoa, $flag) {

        $this->id_pessoa = $pessoa;
        $this->id_processo = $processo;
        $this->flag_papel = $flag;
        $incluir = null;

        //$conexao1 = new CConexao();
        //$conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao1, "insert into autor(id_pessoa,id_processo,flag_papel)
                         values(                
                    {$this->id_pessoa},
                    {$this->id_processo},
                    {$this->flag_papel})");

        //$conexao1->closeConexao();

        return $incluir;
    }

    public function incluirReu($conexao1, $processo, $pessoa, $flag) {

        $this->id_pessoa = $pessoa;
        $this->id_processo = $processo;
        $this->flag_papel = $flag;
        $incluir = null;

        //$conexao1 = new CConexao();
        //$conexao = $conexao1->novaConexao();
        $incluir = pg_exec($conexao1, "insert into reu(id_pessoa,id_processo,flag_papel)
                         values(
                    {$this->id_pessoa},
                    {$this->id_processo},
                    {$this->flag_papel})");

        //$conexao1->closeConexao();

        return $incluir;
    }

    public function getTodosIDProcessosPessoa($id_pessoa, $tipo) {
        $conexao1 = new CConexao();
        $conexao = $conexao1->novaConexao();

        $query = "SELECT id_processo
            from autor
            where id_pessoa = $id_pessoa
            and flag_papel = $tipo

            union

            SELECT id_processo
            from reu
            where id_pessoa = $id_pessoa
            and flag_papel = $tipo";


        $sql = pg_exec($conexao,$query);
        
        return $sql;
    }

}

?>
