<?php

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
$columns = explode(",",$dados[0][0]);
// Deleta essa linha dos dados
unset($dados[0][0]);

foreach($dados as $dado){
    $linhas = explode(',', $dado[0]);
    $novaLinha = [];

    if(!empty($dado)) {
        // Monta o array para o sql
        foreach ($linhas as $key => $linha) {
            $novaLinha[$columns[$key]] = $linha;
        }
    
        // Insere os dados
        $wpdb->insert($table, $novaLinha);
    
        if($wpdb->last_error !== '') {
            http_response_code(500);
            echo $wpdb->last_error;
            return;
        }
    }
}