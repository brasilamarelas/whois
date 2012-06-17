<?php
namespace Whois\Business;

class Servidor{

    protected $id;
    protected $nserver;
    protected $nsstat;
    protected $nslastaa;
    
    function Servidor($id, $nserver, $nsstat, $nslastaa) {
        $this->id = $id;
        $this->nserver = $nserver;
        $this->nsstat = $nsstat;
        $this->nslastaa = $nslastaa;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNserver() {
        return $this->nserver;
    }

    public function setNserver($nserver) {
        $this->nserver = $nserver;
    }

    public function getNsstat() {
        return $this->nsstat;
    }

    public function setNsstat($nsstat) {
        $this->nsstat = $nsstat;
    }

    public function getNslastaa() {
        return $this->nslastaa;
    }

    public function setNslastaa($nslastaa) {
        $this->nslastaa = $nslastaa;
    }
}