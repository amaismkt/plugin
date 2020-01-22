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

foreach($dados as $dado){

    if($dado[0] != ''){

        $atual = explode(',', $dado[0], 4);

        $nome = $atual[0];
        $cpf = $atual[1];
        $categoria = $atual[2];
        $carga_horaria = $atual[3];

        $wpdb->insert($table, array(
            'nome' => $nome,
            'cpf' => $cpf,
            'categoria' => $categoria,
            'carga_horaria' => $carga_horaria
        ));
        
    }

}