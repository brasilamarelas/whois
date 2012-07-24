<?php

$dominio=$_GET['dominio'];

exec("whois ".$dominio."",$output);

extrair($dominio,$output);


/**
 * Verifica qual dominio ele é, se ele é ".com.br", ".gov.br", ".net", ".com". 
 * @param string $dominio
 * @param array $output
 */
function extrair($dominio,$output) {
    if (validaDominio($output)){
        
        if(strpos($dominio,".com.br")==true){
            $resultado=mostrarResultadoBR($output,$dominio);         
            extrairExplode($resultado);             
        }elseif(strpos($dominio,".gov.br")==true){
            $resultado=mostrarResultadoBR($output,$dominio);
            extrairExplode($resultado);
        }elseif(strpos($dominio,".net")==true){
            $resultado=mostrarResultadoNET($output,$dominio);
             extrairExplode($resultado);
        }elseif(strpos($dominio,".com")==true){
            $resultado=mostrarResultadoCOM($output,$dominio);
            extrairExplode($resultado);
        }else{
            echo "nao combina com nenhum dominio cadastrado. Sorry!!!";
        }
        
    
    }else{
        echo "No match for domain ".$dominio;
   }
   
    
}

/**
 * Ele valida se o dominio está registrado
 * Se o dominio não estiver registrado ele returna false senão ele retorna true
 * @param array $output
 * @return booleano 
 */
function validaDominio(array $output){
    foreach ($output as $conteudo){
        if(strstr($conteudo,'No match ')){
            return false; 
        }
    }
    return true;
}

/**
 * Classifica quais os conteudos serão mostrados nos registros .br
 * @param array $output
 * @return array
 */
function mostrarResultadoBR($output) {
   //   $findme=array('%','nsstat:','nslastaa:','ownerid:','country:','owner-c:','admin-c:','tech-c:','billing-c:','nic-hdl-br:','e-mail:','created:','changed:','owner:','person:');
   
    foreach ($output as $conteudo) {
       if(
               (strstr($conteudo, 'domain:'))||
               (strstr($conteudo, 'owner:'))||
               (strstr($conteudo, 'responsible:'))||
               (strstr($conteudo, 'nserver:'))||
               (strstr($conteudo, 'created:'))||
               (strstr($conteudo, 'expires:'))||
               (strstr($conteudo, 'changed:'))||
               (strstr($conteudo, 'status:'))){
                $mostrar[]=$conteudo;  
       }
                       
    }
   
    return $mostrar;
}

/**
 * Classifica quais os conteudos serão mostrados nos registros .com
 * @param type $output
 * @return array
 */
function mostrarResultadoCOM(array $output) { 
        foreach ($output as $conteudo) {
           if(
                   (strstr($conteudo, 'Domain Name:'))||
                   (strstr($conteudo, 'Name Server:'))||
                   (strstr($conteudo, 'Status:'))||
                   (strstr($conteudo, 'Updated Date:'))||
                   (strstr($conteudo, 'Creation Date:'))||
                   (strstr($conteudo, 'Expiration Date:'))){
                $mostrar[]=$conteudo;  
            }
        }
    return $mostrar;
}

/**
 * Classifica quais os conteudos serão mostrados nos registros .net
 * @param array $output
 * @return array
 */
function mostrarResultadoNET(array $output) {
    foreach ($output as $conteudo) {
           if(
                   (strstr($conteudo, 'Domain Name:'))||
                   (strstr($conteudo, 'Name Server:'))||
                   (strstr($conteudo, 'Status:'))||
                   (strstr($conteudo, 'Updated Date:'))||
                   (strstr($conteudo, 'Creation Date:'))||
                   (strstr($conteudo, 'Expiration Date:'))
            ){
                $mostrar[]=$conteudo;  
            }
    }
    
    return $mostrar;
}

/**
 * Divide o array em dois, um contendo as chaves e o outro o conteudo.
 * @param array $mostrar
 */
function extrairExplode(array $mostrar) {
    $replica=array("Name Server" ,"nserver");
    foreach($mostrar as $nome_arquivo){
       $arquivo=  explode(":", $nome_arquivo);
       $key[]=$arquivo[0];
       $conteudo[]=$arquivo[1];
    }
    extrairInformacao($key, $conteudo, $replica);
}

/**
 * Ele coloca no array $resultado o array $key que não são repetidas a não ser que estejam no array $replica. 
 * Então no final o array $resultados irá conter o array $keys e os seus respectivos $conteudos
 * @param array $key
 * @param array $conteudo
 * @param array $replica
 * @return array 
 */
function extrairInformacao(array $key,array $conteudo,array $replica){
    $temp=array();
    $resultado = array();
    
    for($i=0;$i<sizeof($key);$i++){
        if(in_array(trim($key[$i]),$temp)){
            if(in_array(trim($key[$i]), $replica)){
                $resultado[$i]=array(0=>$key[$i],1=>$conteudo[$i]);
            }
        }
        else{
                $resultado[$i]=array(0=>$key[$i],1=>$conteudo[$i]);
        }
      $temp[]=trim($key[$i]);
    }
   
   listarResultado($resultado);
   return $resultado;
    
}

function listarResultado($resultado) {
    if(!empty($resultado)){
    foreach ($resultado as $x){
        foreach ($x as $chave => $valor) {
            print_r($valor);
            echo "<br/>";
        } 
    }
    }else{
        echo "Voce digitou o dominio errado, por favor verificar!!!";
    }    
}

