<?php
namespace Whois\Business;

class Papel{

    protected $id;
    protected $titulo;
    
    function Papel($id, $titulo) {
        $this->id = $id;
        $this->titulo = $titulo;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
}