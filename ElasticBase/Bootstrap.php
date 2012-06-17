<?php
/**
 * ElasticBase
 * @author      Andre Vitor - andrevitor@jsmart.com.br
 * @copyright   Copyright (c) 2011 - 2012 Jsmart Inc.
 * @link        http://dev.jsmart.com.br/opensource
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     1.2
 * @package     ElasticBase
 */

/**
 * @package ElasticBase
 */
namespace ElasticBase;

/*
| -------------------------------------------------------------------
|  Obtem arquivo de configurações com informações setadas 
| -------------------------------------------------------------------
*/

/**
 * Classes usadas
 * @uses ElasticBase\System\Core\Loader.
 */
use \ElasticBase\System\Core\Loader as Loader;
use \ElasticBase\System\Core\Configuration\Config as Config;

/**
 * Class Bootstrap
 * Responsavel por iniciar todo o sistema, por isso bootstrap
 */
class Bootstrap{
    
    /**
     * Guarda a referencia da Instancia do Objeto Bootstrap.
     * @var Bootstrap
     */
    private static $_instance;
    
    private $_config;

    /**
     * Construct
     * Obtem a instancia de Loader e registra as principais autoloads do sistema.
     * @return void.
     */
    public function __construct(Config $config){
        $this->obterClassLoader();
        spl_autoload_register(array($this,'obterClass'));
        $this->setConfig($config);
    }
    
    /**
     * Obtem a Instancia de Bootstrap
     * @return Bootstrap Retorna um Objeto Bootstrap
     */
    public static function obterInstancia(Config $config){
        if (!isset(self::$_instance)) { 
                self::$_instance = new self($config);
        }
        return self::$_instance;
    }
    /**
     * Inicia o Processo de Boot do Sistema.
     * @return void
     */
    public static function iniciar(Config $config){
        self::obterInstancia($config);
    }
    
    /**
     * Carrega a Class Loader na mémoria, que é necessaria para o sistema funcionar.
     * @return void.
     */
    private function obterClassLoader(){
        require_once('Libraries/PSR0/SplClassLoader.php');
        require_once('System/Core/Loader.php');
    }
    
    /**
     * Obtem a Class requerida.
     * @param String NAMESPACE + CLASSE requirida.
     * @return void.
     */
    public function obterClass($className){
        $config = $this->getConfig();
        //dirname(dirname(__FILE__)."/"
        $loader = new \ElasticBase\System\Core\Loader($className,$config->getPathProject());
        $loader->setNamespaceSeparator(DIRECTORY_SEPARATOR);
        $loader->register();
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
}