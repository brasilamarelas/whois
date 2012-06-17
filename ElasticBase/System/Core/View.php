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
 * @uses ElasticBase\System\Core\Configuration\Config
 */
use \ElasticBase\System\Core\Configuration\Config as Config;

/**
 * Classe View
 * Representa a entidade View do Padrão MVC 
 */
final class View{

    /**
     * Guarda a referencia da Instancia do Objeto Config.
     * @var type Config
     */
    protected $_config;
    
    /**
     * Construct
     * Ao ser criado obtem a instancia do objeto Config
     * @return void.
     */
    public function __construct(Config $config){
        $this->setConfig($config);        
    }
    /**
     * Destruct 
     * Se auto destroi
     * @return void.
     */
    public function __destruct() {
        unset($this);
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
     * @return type Config
     */
    public function getConfig(){
        return $this->_config;
    }
    
    /**
     * Load - carrega uma view para o buffer interno de saída.
     * @param $filename String Nome do Arquivo que deve ser carregado
     * @param $vars_views Array Coleção de variaveis que vai ser repassado para a view.
     * @return String Retorna o que foi carregado para buffer de saída.
     */
    public function load($filename,$vars_views=array()){
        ob_start();
        $this->renderizar($filename, $vars_views);
        $buffer = ob_get_contents();
        @ob_end_clean();
        return $buffer;
    }
    
    /**
     * Renderizar - Ao contrario do Load, carrega uma view, mas não impede a saída do buffer.
     * @param $filename String Nome do Arquivo que deve ser carregado
     * @param $vars_views Array Coleção de variaveis que vai ser repassado para a view.
     */
    public function renderizar($filename,$vars_views=array()){
        $config = $this->getConfig();
        try{
            if(is_array($vars_views)){
                extract($vars_views);
            }
            $no_exists = true;        
            $paths = array(
                $config->getPathFramework().DIRECTORY_SEPARATOR.$config->getPathViews(),
                $config->getPathFramework().DIRECTORY_SEPARATOR.$config->getPathModules()
                    );
            foreach($paths as $path){
                if(file_exists($path.$filename.".php")){
                        echo eval('?>'.preg_replace("/;*\s*\?>/", "; ?>", str_replace('<?=', '<?php echo ', file_get_contents($path.$filename.".php"))));
                    $no_exists = false;
                    break;
                }
            }
            if($filename=='error404' && $no_exists){
                throw new \Exception("#404 - File not found. XP");
            }
            if($no_exists){
                $this->error404();
            }
        }catch(\Exception $erro){
            echo $erro->getMessage();
        }
    }
    
    /**
     * Chama a página de Not Fount ERROR 404
     */
    public function error404($mensagem=null){
        if(!empty($mensagem)){
            $dados = array(
                'mensagem' => $mensagem,
            );
        }else{
            $dados = array();
        }
        $this->renderizar('error404',$dados);
        exit();
    }
}