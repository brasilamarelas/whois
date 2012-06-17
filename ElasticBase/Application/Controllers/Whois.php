<?php
namespace ElasticBase\Application\Controllers;

use ElasticBase\System\Core\Controller as Controller;
use Whois\Business\Whois as Whois;

class Whois extends Controller{
    
    protected $whois;
       
    public function Whois() {
        parent::Controller();
    }
    
    
    /**
     *
     * @return Whois\Bui 
     */
    public function getWhois() {
        return $this->whois;
    }

    /**
     *
     * @param Whois\Business\Whois $whois 
     */
    public function setWhois($whois) {
        $this->whois = $whois;
    }

    public function pesquisar($pesquisa){
        try{
            return $this->getWhois()->search($pesquisa);
        }catch(Exception $erro){
            echo $erro;
        }
    }
    
    
}