<?php
/**
 * ElasticBase
 * @author      Andre Vitor - andrevitor@jsmart.com.br
 * @copyright   Copyright (c) 2011 - 2012 Jsmart Inc.
 * @link            http://dev.jsmart.com.br/opensource
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     1.2
 * @package     ElasticBase
 * @subpackage  ElasticBase\Application\Controller
 */

/**
 * @package ElasticBase\Application\Controllers
 */
namespace ElasticBase\Application\Controllers;

/**
 * Classe Usada
 */
use ElasticBase\System\Core\Controller as Controller;

/**
 * Classe Controller Bem Vindo
 */
class BemVindo extends Controller{
    
    public function BemVindo() {
        parent::Controller();
    }
    
    public function index(){
        $view = $this->getView();
        $view->renderizar('bemvindo');
    }
    public function hello(){
        echo "Hello World !!!!";
    }
    
    public function soma($p1,$p2){
        echo $p1+$p2;        
    }
}