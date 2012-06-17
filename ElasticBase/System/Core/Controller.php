<?php
/**
 * ElasticBase
 * @author      Andre Vitor - andrevitor@jsmart.com.br
 * @copyright   Copyright (c) 2011 - 2012 Jsmart Inc.
 * @link        http://dev.jsmart.com.br/opensource
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     1.2
 * @package     ElasticBase
 * @subpackage  ElasticBase\System\Core
 */

/**
 * @package ElasticBase\System\Core
 */
namespace ElasticBase\System\Core;

/**
 * Classes usadas
 * @uses ElasticBase\System\Core\View.
 * @uses ElasticBase\System\Core\Configuration\Config.
 */
use ElasticBase\System\Core\View as View;
use \ElasticBase\System\Core\Configuration\Config as Config;

/**
 * Classe Controller
 * Representa a entidade Controller do Padrão MVC
 */
class Controller{
    
    /**
     * Representa a variavel Global $_POST
     * @var Array
     */
    protected $post = array();
    
    /**
     * Representa a variavel Global $_GET
     * @var Array
     */
    protected $get = array();
    
    /**
     * Representa a variavel Global $_SERVER
     * @var Array
     */
    protected $server = array();
    
    /**
     * Representa a variavel Global $_REQUEST
     * @var Array
     */
    protected $request = array();
    
    /**
     * Representa a variavel Global $_COOKIES
     * @var Array
     */
    protected $cookies = array();
    
    /**
     * Representa a variavel Global $_SESSION
     * @var Array
     */
    protected $session = array();
    
    /**
     * Contém a instancia do Objeto View
     * @var View
     */
    protected $_view = null;
    
    /**
     * Guarda a referencia da Instancia do Objeto Bootstrap.
     * @var Config
     */
    protected $_config = null;
    
    /**
     * Construct
     * Ao ser criado guarda as variaveis globais do php como atributos de si.
     * @return void
     */
    public  function __construct(Config $config=null){
        $this->setPost($_POST);
        $this->setGet($_GET);
        $this->setServer($_SERVER);
        $this->setRequest($_REQUEST);
        @session_start();
        $this->setSession($_SESSION);
        if(is_null($config)){
            $config = \ElasticBase\System\Core\Configuration\Config::obterInstancia();
        }
        $this->setView(new View($config));
        $this->setConfig($config);
    }
    
    /**
     * Destruct 
     * Se auto destroi.
     * @return void
     */
    public function __destruct() {
        @session_destroy();
        unset($this);
    }
    
    /**
     * Seta o atributo $post
     * @param Array
     * @return void
     */
    private function setPost($value){
        $this->post = $value;
    }
    
    /**
     * Obtem o atributo $post
     * @return Array
     */
    public  function getPost(){
        return $this->post;
    }
    
    /**
     * Seta o atributo $get
     * @param Array
     * @return void
     */
    private function setGet($value){
        $this->get = $value;
    }
    
    /**
     * Obtem o atributo $get
     * @return Array
     */
    public  function getGet(){
        return $this->get;
    }
    
    /**
     * Seta o atributo $server
     * @param Array
     * @return void
     */
    private function setServer($value){
        $this->server = $value;
    }
    
    /**
     * Obtem o atributo $server
     * @return Array
     */
    public  function getServer(){
        return $this->server;
    }
    
    /**
     * Seta o atributo $request
     * @param Array
     * @return void
     */
    private function setRequest($value){
        $this->request = $value;
    }
    
    /**
     * Obtem o atributo $request
     * @return Array
     */
    public  function getRequest(){
        return $this->request;
    }
    
    /**
     * Seta o atributo $cookies
     * @param Array
     * @return void
     */
    private function setCookies($value){
        $this->cookies = $value;
    }
    
    /**
     * Obtem o atributo $cookies
     * @return Array
     */
    public  function getCookies(){
        return $this->cookies;
    }
    
    /**
     * Seta o atributo $session
     * @param Array
     * @return void
     */
    private function setSession($value){
        $this->session = $value;
    }
    
    /**
     * Obtem o atributo $session
     * @return Array
     */
    public  function getSession(){
        return $this->session;
    }
    
    /**
     * Metodo em Desenvolvimento
     */
    public function loadConfigSession(){
        @session_start();
    }
    
    /**
     * Seta a Instancia do Objeto Config
     * @param Config $config 
     * @return void
     */
    public function setConfig(Config $config){
        $this->_config = $config;
    }
    /**
     * Obtem a Instancia do Objeto Config
     * @return Config
     */
    public function getConfig(){
        return $this->_config;
    }
    
    /**
     * Seta a Instancia do Objeto View
     * @param View $view
     * @return void
     */
    public function setView(View $view){
        $this->_view = $view;
    }
    /**
     * Obtem a Instancia do Objeto View
     * @return View
     */
    public function getView(){
        return $this->_view;
    }
    
    
    
    /**
     * Obtem uma String com o NameSpace do Controller
     * @return String
     */
    public function getNameSpace(){
        return __NAMESPACE__;
    }
    
    
}