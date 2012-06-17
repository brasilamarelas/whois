<?php
$url = $_GET['url'];
$command = "whois ".$url;
exec($command, $resposta);

$resposta = clear($resposta);
var_dump(obterDados($resposta));


function clear($resposta){  
    foreach ($resposta as &$conteudo) {
        if(empty($conteudo)){
            unset($conteudo);
        }else{
            if(strstr($conteudo, '%')){
                if(strstr($conteudo, '% No match for domain')){
                    $return[] = $conteudo;
                }else{
                    unset($conteudo);
                }
            }else{
                $return[] = $conteudo;
            }
        }        
    }
    return $return;
}

function obterDados($resposta){
    foreach($resposta as $chave=>&$conteudo){
        if(strstr($conteudo, ":")){
            $dados[] = explode(":", $conteudo);
        }
    }
    return $dados;
}

