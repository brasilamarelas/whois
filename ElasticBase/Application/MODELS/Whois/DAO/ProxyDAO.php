<?php
namespace Whois\DAO;

use ElasticBase\System\Core\Configuration\Config as Config;

use Whois\Business\Dominio;
use Whois\Business\Papel;
use Whois\Business\Servidor;
use Whois\Business\Pessoa;


class ProxyDAO {

    protected $instancia;
    protected $dao;
    protected $dominioDAO;
    protected $papelDAO;
    protected $servidorDAO;
    protected $pessoaDAO;
    
    private function ProxyDAO(){
        ;
    }
    
    public static function getInstancia(){
        if (!isset(self::$instancia)) { 
                self::$instancia = new self; 
        }
        return self::$instancia;
    }
    
    private function __clone(){
        return false;
    }

    private function getDao() {
        return $this->dao;
    }

    private function setDao($dao) {
        $this->dao = $dao;
    }

    public function getDominioDAO() {
        return $this->dominioDAO;
    }

    public function setDominioDAO($dominioDAO) {
        $this->dominioDAO = $dominioDAO;
    }

    public function getPapelDAO() {
        return $this->papelDAO;
    }

    public function setPapelDAO($papelDAO) {
        $this->papelDAO = $papelDAO;
    }

    public function getServidorDAO() {
        return $this->servidorDAO;
    }

    public function setServidorDAO($servidorDAO) {
        $this->servidorDAO = $servidorDAO;
    }

    public function getPessoaDAO() {
        return $this->pessoaDAO;
    }

    public function setPessoaDAO($pessoaDAO) {
        $this->pessoaDAO = $pessoaDAO;
    }

    

}