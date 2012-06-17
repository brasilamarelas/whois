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

/*
| -------------------------------------------------------------------
|  Obtem a Instancia do Objeto Config
| -------------------------------------------------------------------
*/
require_once 'ElasticBase/Application/Configuration/config.php';
require_once 'ElasticBase/System/Core/Configuration/Config.php';
$config = ElasticBase\System\Core\Configuration\Config::obterInstancia();

/*
| -------------------------------------------------------------------
|  Setas as configurações encontradas em 'Application/Configuration/config.php'
|  no Objeto Config
| -------------------------------------------------------------------
*/
$config->setServer($server);
$config->setPath($path);
$config->setDatabase($database);
$config->setDocTypes($doctypes);
$config->setMimeTypes($mimes);
$config->setDefault($default);

/*
| -------------------------------------------------------------------
|  Boot ..... iniciando o sistema.
| -------------------------------------------------------------------
*/
require_once 'ElasticBase/Bootstrap.php';
ElasticBase\Bootstrap::iniciar($config);

/*
| -------------------------------------------------------------------
|  Obtendo Manager, o responsavel por gerenciar requisições.
| -------------------------------------------------------------------
*/
$manager = new \ElasticBase\System\Core\Manager($config);
/*
| -------------------------------------------------------------------
|  Acessa o método que da início a interpretação da requisição.
| -------------------------------------------------------------------
*/
$manager->index();