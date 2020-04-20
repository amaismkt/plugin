<?php

global $wpdb;

if(!isset($wpdb))
{
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

$id = $_POST['id'];
$wpdb->delete($wpdb->prefix.'eventos', array( 'id' => $id ));

if($wpdb->last_error != '') {
    http_response_code(500);
    $return =  array("error" => $wpdb->last_error);
    echo json_encode($return);
    return;
}

$retorno = array('status' => 200, 'mensagem' => 'Deletado com sucesso'); 
echo json_encode($retorno);