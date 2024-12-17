<?php

global $wpdb;

if(!isset($wpdb))
{
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/class-wpdb.php');
}

$table = $wpdb->prefix."eventos";
$dados = $_POST;

// Upadate data
$wpdb->update($table, array(
        'nome' => $dados['nome'],
    ), array(
        'id' => $dados['id']
    )
);

if($wpdb->last_error !== '') {
    http_response_code(500);
    echo json_encode(array("error" => $wpdb->last_error));
}

echo json_encode($event);