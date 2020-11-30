<?php

$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú', ' ');

$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U', '_');


global $wpdb;

if(!isset($wpdb))
{
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

$dados = $_POST["data"];
$table = $wpdb->prefix."participantes";
// Recebe o nome das colunas

$columns = array_merge(explode(',',$dados[0][0]), explode(',',$dados[0][1]));

foreach ($columns as $key => &$value) {
    $value = strtolower(str_replace($comAcentos, $semAcentos, $value));
}

// Deleta essa linha dos dados
unset($dados[0]);

foreach($dados as $dado){
    $linhas = explode(',', $dado[0]);
    $novaLinha = [];    
    if(!empty($dado)) {
        // Monta o array para o sql
        foreach ($linhas as $key => $linha) {
            // Validação de CPF
            if($key == 1){
                $linha = str_replace(".", "", $linha);
                $linha = str_replace(".", "", $linha);
                $linha = str_replace("-", "", $linha);
                $linha = str_replace("-", "", $linha);
                $linha = str_replace("-", "", $linha);
                $linha = str_replace("-", "", $linha);
                //$linha = substr($linha, 0, 10);
                $novaLinha[$columns[$key]] = substr(str_replace("-", "", $linha), 0, 11);
            }else{
                $novaLinha[$columns[$key]] = $linha;
            }
           
        }
        var_dump($novaLinha);

        // Insere os dados
        $novaLinha["validation_code"] = mt_rand(10000000, 99999999);
        $wpdb->insert($table, $novaLinha);
        
        if($wpdb->last_error !== '') {
            http_response_code(500);
            echo $wpdb->last_error;
            return;
        }
    }


}
