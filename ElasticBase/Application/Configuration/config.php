<?php
/*
| -------------------------------------------------------------------
|  Seta as configurações de Ambiente
| -------------------------------------------------------------------
| Comecei a escreve as funções para setar as configurações de ambiente e percebi que podeiram
| surgir varias dessas funções, então acredito que gerar elas dinamicamente dentro de um loop
| seja uma melhor opção ao contrario de ter que escrever um função parecida para todas as configurações
| que eu deseja-se setar.
|
|   Exemplo: 
|
|   if(function_exists("date_default_timezone_set") == TRUE AND ini_get("safe_mode") == 0){
|       @date_default_timezone_set('America/Sao_Paulo');
|   }
|
|   Agora basta utilizar um Array, simples não ?!
|   ps: add no array ( setConfiguracoesDeAmbiente ) 
|   função => parametros
|   $setConfiguracoesDeAmbiente = array("date_default_timezone_set"=>"America/Sao_Paulo");
 */
$setConfiguracoesDeAmbiente["date_default_timezone_set"] = "America/Sao_Paulo";
$setConfiguracoesDeAmbiente["set_time_limit"] = 300;

foreach($setConfiguracoesDeAmbiente as $key=>$value){
    if(function_exists($key) == TRUE AND ini_get("safe_mode") == 0){
        @$key($value);
    }
}

/*
| -------------------------------------------------------------------
|  Seta as configurações do Servidor
| -------------------------------------------------------------------
*/
$server = array();
$server['ip']               = @$_SERVER['ADDR'];
$server['local']            = @$_SERVER['NAME'];
$server['porta']            = @$_SERVER['PORT'];
$server['raiz']             = @$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR;
$server['data']             = date('d-m-Y H:i:s');
$server['phpversion']       = PHP_VERSION;

/*
| -------------------------------------------------------------------
|  Seta as configurações dos Diretorios do Projeto
| -------------------------------------------------------------------
*/
$path = array();
$path['root']               = getEnv("DOCUMENT_ROOT").DIRECTORY_SEPARATOR;
$path['project']            = $path['root'].end(explode("/",dirname(dirname(dirname(__DIR__))))).DIRECTORY_SEPARATOR;
$path['framework']          = 'ElasticBase'.DIRECTORY_SEPARATOR;
$path['system']             = "System".DIRECTORY_SEPARATOR;
$path['application']        = "Application".DIRECTORY_SEPARATOR;
$path['controllers']        = $path['application']."Controllers".DIRECTORY_SEPARATOR;
$path['models']             = $path['application']."Models".DIRECTORY_SEPARATOR;
$path['views']              = $path['application']."Views".DIRECTORY_SEPARATOR;
$path['modules']            = $path['application']."Modules".DIRECTORY_SEPARATOR;
$path['libraries']          = $path['application']."Libraries".DIRECTORY_SEPARATOR;
$path['logs']               = $path['project']."Logs".DIRECTORY_SEPARATOR;
$path['assets']             = $path['project']."Assets".DIRECTORY_SEPARATOR;

/*
| -------------------------------------------------------------------
|  Seta as configurações principais para acessar o banco de dados
| -------------------------------------------------------------------
| $database = array();
| $database['type']       =   null; Tipo de Banco de Dados
| $database['local']      =   null; Host - Endereço do Servidor de Banco de Dados
| $database['dbname']     =   null; Nome do Banco de Dados
| $database['username']   =   null; Usuario de Acesso ao Banco de Dados
| $database['password']   =   null; Senha de Acesso ao Banco de Dados 
*/
$database = array();
$database['driver']     = 'pdo_mysql';// se estiver usando Doctrine usar pdo_+sgbd se estiver usando pdo direto usar só sgbd
$database['host']       = 'localhost';
$database['dbname']     = 'mydb';
$database['user']       = 'root';
$database['password']   = '123456789';

/*
| -------------------------------------------------------------------
|  Seta as configurações do Controller Default requerido
| -------------------------------------------------------------------
*/
$default  = array();
$default['controller_default'] = "BemVindo";


/*
| -------------------------------------------------------------------
|  Seta as configurações do DOCTYPE necessarias para renderização
| -------------------------------------------------------------------
*/
$doctypes = array();
$doctypes['xhtml11']        = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'; 
$doctypes['xhtml1-strict']  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
$doctypes['xhtml1-trans']   = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$doctypes['xhtml1-frame']   = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">'; 
$doctypes['html5']          = '<!DOCTYPE html>';
$doctypes['html4-strict']   = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">';
$doctypes['html4-trans']    = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
$doctypes['html4-frame']    = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">';

/*
| -------------------------------------------------------------------
| MIME TYPES
| -------------------------------------------------------------------
| Seta todos os tipos se arquivos permitidos.
|
*/
$mimes = array();
$mimes['hqx']   = 'application/mac-binhex40';
$mimes['cpt']   = 'application/mac-compactpro';
$mimes['csv']   = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel');
$mimes['bin']   = 'application/macbinary';
$mimes['dms']   = 'application/octet-stream';
$mimes['lha']   = 'application/octet-stream';
$mimes['lzh']   = 'application/octet-stream';
$mimes['exe']   = array('application/octet-stream', 'application/x-msdownload');
$mimes['class'] = 'application/octet-stream';
$mimes['psd']   = 'application/x-photoshop';
$mimes['so']    = 'application/octet-stream';
$mimes['sea']   = 'application/octet-stream';
$mimes['dll']   = 'application/octet-stream';
$mimes['oda']   = 'application/oda';
$mimes['pdf']   = array('application/pdf', 'application/x-download');
$mimes['ai']    = 'application/postscript';
$mimes['eps']   = 'application/postscript';
$mimes['ps']    = 'application/postscript';
$mimes['smi']   = 'application/smil';
$mimes['smil']  = 'application/smil';
$mimes['mif']   = 'application/vnd.mif';
$mimes['xls']   = array('application/excel', 'application/vnd.ms-excel', 'application/msexcel');
$mimes['ppt']   = array('application/powerpoint', 'application/vnd.ms-powerpoint');
$mimes['wbxml'] = 'application/wbxml';
$mimes['wmlc']  = 'application/wmlc';
$mimes['dcr']   = 'application/x-director';
$mimes['dir']   = 'application/x-director';
$mimes['dxr']   = 'application/x-director';
$mimes['dvi']   = 'application/x-dvi';
$mimes['gtar']  = 'application/x-gtar';
$mimes['gz']    = 'application/x-gzip';
$mimes['php']   = 'application/x-httpd-php';
$mimes['php4']  = 'application/x-httpd-php';
$mimes['php3']  = 'application/x-httpd-php';
$mimes['phtml'] = 'application/x-httpd-php';
$mimes['phps']  = 'application/x-httpd-php-source';
$mimes['js']    = 'application/x-javascript';
$mimes['swf']   = 'application/x-shockwave-flash';
$mimes['sit']   = 'application/x-stuffit';
$mimes['tar']   = 'application/x-tar';
$mimes['tgz']   = array('application/x-tar', 'application/x-gzip-compressed');
$mimes['xhtml'] = 'application/xhtml+xml';
$mimes['xht']   = 'application/xhtml+xml';
$mimes['zip']   = array('application/x-zip', 'application/zip', 'application/x-zip-compressed');
$mimes['mid']   = 'audio/midi';
$mimes['midi']  = 'audio/midi';
$mimes['mpga']  = 'audio/mpeg';
$mimes['mp2']   = 'audio/mpeg';
$mimes['mp3']   = array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3');
$mimes['aif']   = 'audio/x-aiff';
$mimes['aiff']  = 'audio/x-aiff';
$mimes['aifc']  = 'audio/x-aiff';
$mimes['ram']   = 'audio/x-pn-realaudio';
$mimes['rm']    = 'audio/x-pn-realaudio';
$mimes['rpm']   = 'audio/x-pn-realaudio-plugin';
$mimes['ra']    = 'audio/x-realaudio';
$mimes['rv']    = 'video/vnd.rn-realvideo';
$mimes['wav']   = 'audio/x-wav';
$mimes['bmp']   = 'image/bmp';
$mimes['gif']   = 'image/gif';
$mimes['jpeg']  = array('image/jpeg', 'image/pjpeg');
$mimes['jpg']   = array('image/jpeg', 'image/pjpeg');
$mimes['jpe']   = array('image/jpeg', 'image/pjpeg');
$mimes['png']   = array('image/png',  'image/x-png');
$mimes['tiff']  = 'image/tiff';
$mimes['tif']   = 'image/tiff';
$mimes['css']   = 'text/css';
$mimes['html']  = 'text/html';
$mimes['htm']   = 'text/html';
$mimes['shtml'] = 'text/html';
$mimes['txt']   = 'text/plain';
$mimes['text']  = 'text/plain';
$mimes['log']   = array('text/plain', 'text/x-log');
$mimes['rtx']   = 'text/richtext';
$mimes['rtf']   = 'text/rtf';
$mimes['xml']   = 'text/xml';
$mimes['xsl']   = 'text/xml';
$mimes['mpeg']  = 'video/mpeg';
$mimes['mpg']   = 'video/mpeg';
$mimes['mpe']   = 'video/mpeg';
$mimes['qt']    = 'video/quicktime';
$mimes['mov']   = 'video/quicktime';
$mimes['avi']   = 'video/x-msvideo';
$mimes['movie'] = 'video/x-sgi-movie';
$mimes['doc']   = 'application/msword';
$mimes['docx']  = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
$mimes['xlsx']  = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
$mimes['word']  = array('application/msword', 'application/octet-stream');
$mimes['xl']    = 'application/excel';
$mimes['xls']   = array('application/msexcel', 'application/excel');
$mimes['eml']   = 'message/rfc822';
$mimes['json']  = array('application/json', 'text/json');