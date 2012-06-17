<?php
namespace Whois\Business;

class Dominio{

    protected $id;
    protected $pessoa;
    protected $nome;
    protected $criacao;
    protected $expiracao;
    
    function Dominio($id, $pessoa, $nome, $criacao, $expiracao) {
        $this->id = $id;
        $this->pessoa = $pessoa;
        $this->nome = $nome;
        $this->criacao = $criacao;
        $this->expiracao = $expiracao;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPessoa() {
        return $this->pessoa;
    }

    public function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDataCriacao() {
        return $this->criacao;
    }

    public function setDataCriacao($criacao) {
        $this->criacao = $criacao;
    }

    public function getDataExpiracao() {
        return $this->expiracao;
    }

    public function setDataExpiracao($expiracao) {
        $this->expiracao = $expiracao;
    }
    
    

}