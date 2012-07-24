<?php

class Responsavel {
    
    /**
    * Metodo construtor da classe Dominio
    */
    public function Responsavel(){
        
    }

    protected $nome;

    /**
    * Obtem o Nome do Responsável
    * @return string $nome;
    */
    public function getNome() {
        return $this->nome;
    }
    
    /**
    * Seta o nome do Responsável
    * @param string $nome
    */
    public function setNome($nome) {
        $this->nome = $nome;
    }


}