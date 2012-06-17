<?php
/**
 * ElasticBase
 * @author      Andre Vitor - andrevitor@jsmart.com.br
 * @copyright   Copyright (c) 2011 - 2012 Jsmart Inc.
 * @link        http://dev.jsmart.com.br/opensource
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     1.2
 * @package     ElasticBase
 * @subpackage  ElasticBase\System\Configuration
 */

/**
 * @package ElasticBase\System\Core\Configuration
 */
namespace ElasticBase\System\Core\Configuration;

/**
 * Classe Config
 * Responsavel por conter todas as configurações necessarias para o sistema.
 */
final class Config{
    
    /**
     * Guarda a referencia da Instancia do Objeto Config.
     * @var Object Config
     */
    private static $_instance;
    
    /**
     * Configurações do servidor
     * @var Array
     */
    private $server     = null;
    
    /**
     * Configurações dos Diretorios
     * @var Array
     */
    private $path       = null;
    
    /**
     * Configurações do Banco de Dados
     * @var Array
     */
    private $database   = null;
    
    /**
     * Tipos de Doctypes disponiveis
     * @var Array
     */
    private $doctypes   = null;
    
    /**
     * Tipos de MimeTypes disponiveis
     * @var Array
     */
    private $mimes      = null;
    
    /**
     * Guarda algumas configurações padrão
     * Exemplo controller_default
     * @var Array
     */
    private $default    = null;
    
    /**
     * Evita que a classe seja instanciada publicamente
     */
    private function __construct(){
        ;
    }

    /**
     * Evita que a classe seja clonada
     * @return Boolean(false)
     */
    private function __clone(){
        return false;
    }
    
    /**
     * Obtem a Instancia do Object Config
     * @return Object Config
     */
    public static function obterInstancia(){
        if (!isset(self::$_instance)) { 
                self::$_instance = new self; 
        }
        return self::$_instance;
    }
    
    /**
     * Seta informações de Configuração de acesso ao DB
     * @param Array
     * @return void
     */
    public function setDatabase($value){
        $this->database = $value;
    }
    
    /**
     * Obtem informações de Configuração de acesso ao DB
     * @return Array
     */
    public function getDatabase(){
        return $this->database;
    }
    
    /**
     * Seta configurações sobre DocTypes
     * @param Array
     * @return void
     */
    public function setDocTypes($value){
        $this->doctypes = $value;
    }
    
    /**
     * Obtem as configurações sobre DocTypes
     * @return Array
     */
    public function getDocTypes(){
        return $this->doctypes;
    }
    
    /**
     * Seta as configurações sobre MimeTypes
     * @param Array
     * @return void
     */
    public function setMimeTypes($value){
        $this->mimes = $value;
    }
    
    /**
     * Obtem configurações sobre MimeTypes
     * @return Array
     */    
    public function getMimeTypes(){
        return $this->mimes;
    }
    
    /**
     * Seta as configurações de diretorios disponiveis.
     * @param Array
     * @return void
     */
    public function setPath($value){
        $this->path = $value;
    }
    
    /**
     * Obtem todas as configurações de diretorios disponiveis.
     * @return Array
     */
    public function getPath(){
        return $this->path;
    }
    
    /**
     * Obtem o caminho do diretorio root
     * @return String
     */
    public function getPathRoot(){
        return $this->path['root'];
    }
    
    /**
     * Obtem o caminho do diretorio system
     * @return String
     */    
    public function getPathSystem(){
        return $this->path['system'];
    }
    
    /**
     * Obtem o caminho do diretorio application
     * @return String
     */
    public function getPathApplication(){
        return $this->path['application'];
    }
    
    /**
     * Obtem o caminho do diretorio modules
     * @return String
     */
    public function getPathModules(){
        return $this->path['modules'];
    }
    
    /**
     * Obtem o caminho do diretorio controllers
     * @return String
     */
    public function getPathControllers(){
        return $this->path['controllers'];
    }
    
    /**
     * Obtem o caminho do diretorio Models
     * @return String
     */
    public function getPathModels(){
        return $this->path['models'];
    }
    
    /**
     * Obtem o caminho do diretorio views
     * @return String
     */
    public function getPathViews(){
        return $this->path['views'];
    }
    
    /**
     * Obtem o caminho do diretorio libraries
     * @return String
     */
    public function getPathLibraries(){
        return $this->path['libraries'];
    }
    
    /**
     * Obtem o caminho do diretorio logs
     * @return String
     */
    public function getPathLogs(){
        return $this->path['logs'];
    }
    
    /**
     * Obtem o caminho do diretorio assets
     * @return String
     */
    public function getPathAssets(){
        return $this->path['assets'];
    }
    
    /**
     * Obtem o caminho do diretorio Project
     * @return String
     */
    public function getPathProject(){
        return $this->path['project'];
    }
    
    /**
     * Obtem o caminho do diretorio Project
     * @return String
     */
    public function getPathFramework(){
        return $this->path['framework'];
    }
    
    /**
     * Seta as configurações disponiveis do Servidor
     * @param Array
     */
    public function setServer($value){
        $this->server = $value;
    }
    
    /**
     * Obtem as configurações disponiveis do Servidor
     * @return Array
     */
    public function getServer(){
        return $this->server;
    }
    
    /**
     * Seta algumas configurações padrão
     * @param Array
     */
    public function setDefault($value){
        $this->default = $value;
    }
    
    /**
     * Obtem algumas configurações padrão
     * @return Array
     */
    public function getDefault(){
        return $this->default;
    }
    
    /**
     * Obtem o controller_default ( controller padrão )
     * @return String
     */
    public function getControllerDefault(){
        return $this->default["controller_default"];
    }    
}