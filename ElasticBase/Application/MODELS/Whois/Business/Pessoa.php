<?php
namespace Whois\Business;

class Pessoa{

    protected $nic_hdl_br;
    protected $nome;
    protected $email;
    protected $criacao;
    protected $alteracao;
    
    function Pessoa($nic_hdl_br, $nome, $email, $criacao, $alteracao) {
        $this->nic_hdl_br = $nic_hdl_br;
        $this->nome = $nome;
        $this->email = $email;
        $this->criacao = $criacao;
        $this->alteracao = $alteracao;
    }

    public function getNicHdlBr() {
        return $this->nic_hdl_br;
    }

    public function setNicHdlBr($nic_hdl_br) {
        $this->nic_hdl_br = $nic_hdl_br;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDataCriacao() {
        return $this->criacao;
    }

    public function setDataCriacao($criacao) {
        $this->criacao = $criacao;
    }

    public function getDataAlteracao() {
        return $this->alteracao;
    }

    public function setDataAlteracao($alteracao) {
        $this->alteracao = $alteracao;
    }

}