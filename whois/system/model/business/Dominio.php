<?php

/**
 * Description of Dominio
 *
 * @author developer
 */


class Dominio {

    /**
    * Método construtor da classe Dominio
    */ 
    public function Dominio(){

    }
    
    protected $nome;
    protected $data_criacao;
    protected $data_alteracao;
    protected $status;
    protected $server1;
    protected $server2;
    
    /**
    *Obtem o nome do dominio exemplo: rededobairro.com.br
    *@return string $nome 
    */ 
    public function getNome() {
        return $this->nome;
    }
    
    /*      
    *Seta o nome do dominio exemplo: rededobairro.com.br
    *@param string $nome 
    */ 
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /*
    *Obtem a data de criação do dominio 
    *@return int $data_criacao 
    */
    public function getData_criacao() {
        return $this->data_criacao;
    }
    
    /*
    *Seta a data de criação do dominio 
    *@param int $data_criacao 
    */     
 
    public function setData_criacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }
    
    /*
    * Obtem a data de alteração do domínio
    *@return int $data_alteracao
    */ 
    public function getData_alteracao() {
        return $this->data_alteracao;
    }

    /*
    *Seta a data de alteração do dominio
    *@param int $data_alteracao
    */ 
    public function setData_alteracao($data_alteracao) {
        $this->data_alteracao = $data_alteracao;
    }
    
    /*
    *Obtem o status do dominio
    *@return string $status
    */
    public function getStatus() {
        return $this->status;
    }
    
    /*
    *Seta o status do domínio
    *@param string $status
    */     
    public function setStatus($status) {
        $this->status = $status;
    }
    
    /*
    *Obtem o primeiro Nome do servidor
    *@return string $server1
    */     
    public function getServer1() {
        return $this->server1;
    }
    
    /*
    *Seta o primeiro Nome do servidor
    *@param string $server1
    */     
    public function setServer1($server1) {
        $this->server1 = $server1;
    }
    
    /*
    *Obtem o segundo nome do servidor
    *@return string $server2;
    */     
    public function getServer2() {
        return $this->server2;
    }
    
    /*
    *Seta o segundo nome do servidor
    *@param string $server2
    */     
    public function setServer2($server2) {
        $this->server2 = $server2;
    }

}

$oDominio = new Dominio();

$oDominio->setNome("rededobairro.com.br");

echo $oDominio->getNome();



$oDominio->setData_criacao($oX=new X());
