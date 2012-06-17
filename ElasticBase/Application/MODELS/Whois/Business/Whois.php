<?php
namespace Whois\Business;

use Whois\DAO\ProxyDAO as ProxyDAO;

class Whois{
    
    protected $serviceDAO;
    
    public function Whois(){
        $this->setServiceDAO(\ProxyDAO::obterInstancia());
    }
    
    public function getServiceDAO() {
        return $this->serviceDAO;
    }

    public function setServiceDAO($serviceDAO) {
        $this->serviceDAO = $serviceDAO;
    }
    
    /**
     * Realiza a consulta
     * @param string $url
     * @return Array 
     */
    public function search($url){
        $command = "whois ".$url;
        exec($command, $output);
        return $output;
    }
    
    public function tratarDadosNacionais($dados){
        foreach($dados as $chave=>&$conteudo){
            if(strstr($conteudo, ":")){
                $dados[] = explode(":", $conteudo);
            }
        }
        return $dados;
    }
    
    public function tratarDadosInternacionais($dados){
        
    }
}