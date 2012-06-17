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
 * @package ElasticBase\System\Core.
 */
namespace ElasticBase\System\Core;

/**
 * Classes usadas
 * @use ElasticBase\System\Core\Controller
 * @use ElasticBase\System\Core\Configuration\Config
 */
use \ElasticBase\System\Core\Controller as Controller;
use \ElasticBase\System\Core\Configuration\Config as Config;

/**
 * Classe Manager
 * Tem a responsabilidade de ser o Manager dos Controllers, encontrando e repassar
 * a requisições para os controllers destinados a processar aquele tipo de operação
 * recebida.
 */
class Manager extends \ElasticBase\System\Core\Controller{
   
    /**
     * Nome do Controller requerido para realizar uma determinada operação.
     * @var String
     */
    protected $controller;
    
    /**
     * Nome do metodo que o controller requerido devera realizar ( operação do controller requerida ).
     * @var String
     */
    protected $metodo;
    
    /**
     * Parametros com os dados para realizar o controller realizar o metodo requerido ( operação ).
     * @var Array
     */
    protected $dados;
    
    /**
     * Construct
     * obtem a instancia do loader ao se construir além de validar o Request ( Entrada no Servidor )
     * e repassar para o Controller responsavel.
     * @return void.
     */
    public function __construct(Config $config){
        parent::__construct($config);
        $this->validarRequest();
    }
    
    /**
     * Metodo principal, este metodo sempre é chamado ao se construir um objeto deste tipo.
     * funciona como um metodo main de outros linguagens ( C , C ++ , Java )
     * @return void.
     */
    public function index(){
        $view = $this->getView();
        try{
            //object Controller Call Request
            $controller = $this->load_object($this->getController());
            if(!is_object($controller)){
                throw new \Exception("Resource not avaliabe at the moment !");
            }
            
            if(!empty($controller)){
                $metodo = $this->getMetodo();
                $dados = $this->getDados();
                if(is_array($dados)){
                    call_user_func_array(array($controller,$metodo),$dados);
                }else{
                    $controller->$metodo();
                }
            }
        }catch(\Exception $erro){
            $view->error404($erro->getMessage());
        }
    }
    
    /**
     * Verifica se metodo requerido existe.
     * @param Object $obj Objeto que queremos checar a existencia de um método.
     * @param String $metodo Método que queremos checar.
     * @return Boolean TRUE em caso de verdadeiro e FALSE se não existir ou ocorrer algum erro.
     */
    public function existeMetodo($obj,$metodo){
        try{
            if(is_object($obj)){
                if(empty($metodo)){
                    throw new \Exception("Method not found !");
                    return false;
                }
                if(array_search($metodo,get_class_methods(get_class($obj)))){
                    return true;
                }
            }else{
                throw new \Exception("\$obj is not Object ! ");
                return false;
            }
        }catch(\Exception $erro){
            //$this->view->error404();
        }
        return false;
    }
    
    /**
     * Obtem um objeto do Controller requerido.
     * @param String $class
     * @return class Object Controller
     */
    private function load_object($controller_class){
        $config = $this->getConfig();
        $view = $this->getView();
        try{
            if(empty($controller_class)){
                throw new \Exception("Class Not Found!");
            }else{
                $namespace = $config->getPathProject().$config->getPathFramework().$config->getPathControllers();
                if(!file_exists($namespace.$controller_class.".php")){
                    throw new \Exception("Class Not Found!");
                }
                $namespace = implode("\\",explode("/",$config->getPathFramework().$config->getPathControllers()));
                $controller_class = $namespace.$controller_class;
                return new $controller_class;
            }
        }catch(\Exception $erro){
            $view->error404($erro->getMessage());
        }
    }
    
    /**
     * Valida todas as entradas possiveis ao sistema
     * @return void
     */
    private function validarRequest(){
        try{
            $this->setDadosDeEntrada($this->mergeInput(array(
                                                            $this->verificarQueryString(),
                                                            $this->verificarPost(),
                                                            $this->veriricarGet(),
                                                           )));      
        }catch(\Exception $erro){
            throw new \Exception("Validade Request");
        }
    }
    
    /**
     * Unifica todas as entradas em 
     * @param type $inputs
     * @return type 
     */
    private function mergeInput($inputs){
        //Obtem a Instancia do objeto Config
        $config = $this->getConfig();
        try{
            $input = array();
            for($i=0;$i<=sizeof($inputs);$i++){
                if(@is_array($inputs[$i])){
                    $input = @array_unique(array_merge($input,$inputs[$i]));
                }
            }
            unset($input[0]);
            if(empty($input[1])){
                $input[1]=$config->getControllerDefault();
                $input[2]="index";
            }
        }catch(\Exception $erro){
               $erro->getMessage();
        }
        return $input;        
    }
    
    /**
     * Obter e setas as informações para Controller e Metodo acessados.
     * @param String $input 
     */
    private function setDadosDeEntrada($input){
        $view = $this->getView();
        try{
            $this->setController(trim($input[1]));
            if(!empty($input[2])){
                if(!$this->existeMetodo($this->load_object(trim($input[1])), trim($input[2]))){
                    throw new \Exception("Method:".$input[2]." not exist. ");
                }
            }else{
                $input[2] = "index";
            }
            $this->setMetodo(trim($input[2]));

            unset($input[1]);
            unset($input[2]);

            $dados=array();

            foreach($input as $indice=>$conteudo){
                $dados[] = $conteudo;
            }
            $this->setDados($dados);
        }catch(\Exception $erro){
            $view->error404($erro->getMessage());
        }
    }
    
    /**
     * Seta e setas as informações para Controller e Metodo acessados.
     * @param type $input 
     */
    private function setController($controller){
        $this->controller = $controller;
    }
    
    /**
     * Obtem o nome do controller requerido.
     * @return String
     */
    public function getController(){
        return $this->controller;
    }
    
    /**
     * Seta o nome do controller requerido.
     * @return String
     */
    private function setMetodo($metodo){
        $this->metodo = $metodo;
    }
    
    /**
     * Obtem o nome do metodo requerido.
     * @return String
     */
    public function getMetodo(){
        return $this->metodo;
    }
    
    /**
     * Seta o nome do metodo requerido.
     * @return String
     */
    private function setDados($dados){
        $this->dados = $dados;
    }
    
    /**
     * Obtem a coleção de parametros enviados.
     * @return Array
     */
    public function getDados(){
        return $this->dados;
    }
    
    /**
     * Verifica o conteudo de $server['QUERY_STRING']
     * @return Array  Array em caso de sucesso e FALSE em caso de erro ou se $server['QUERY_STRING'] estiver vazia.
     */
    private function verificarQueryString(){
        $server = $this->getServer();
        try{
            $input = explode('/', $server['QUERY_STRING'] );
            if(!empty($input)){
                return $input;
            }else{
                return false;
            }
        }catch(\Exception $erro){
            throw new \Exception("Check QueryString");
        }
        
    }
    
    /**
     * Verifica o conteudo de $request
     * @return Array Array em caso de sucesso e FALSE em caso de erro ou se $request estiver vazio.
     */
    private function verificarRequest(){
        $request = $this->getRequest();
        try{
            if(!empty($request)){
                if(is_array($request)){
                    $request = key($request);
                    $input = explode('/',$request);
                    return $input;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch(\Exception $erro){
            throw new \Exception("Check Request");
        }
    }
    
    /**
     * Verifica o conteudo de $post
     * @return Array Array em caso de sucesso e FALSE em caso de erro ou se $post estiver vazio.
     */
    private function verificarPost(){
        $post = $this->getPost();
        try{
            if(!empty($post)){
                if(is_array($post)){
                    $post = key($post);
                    $input = explode('/',$post);
                    return $input;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch(\Exception $erro){
           throw new \Exception("Check POST");
        }
    }
    
    /**
     * Verifica o conteudo de $get
     * @return Array Array em caso de sucesso e FALSE em caso de erro ou se $get estiver vazio.
     */
    private function veriricarGet(){
        $get = $this->getGet();
        try{
            if(!empty($get)){
                if(is_array($get)){
                    $get = key($get);
                    $input = explode('/',$get);
                    return $input;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch(\Exception $erro){
            throw new \Exception("Check GET");
        }
    }       
}