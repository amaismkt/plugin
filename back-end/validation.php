<?php
if(!isset($wpdb)){
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

global $wpdb;
$results = $wpdb->get_results( 
    $wpdb->prepare(
        "SELECT * 
        FROM {$wpdb->prefix}participantes 
        WHERE validation_code='".$_REQUEST['validation_code']."'"
    , null) 
);

$eventoId = $results[0]->event_id;

$eventoInfo = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * 
        FROM {$wpdb->prefix}congresso_images 
        WHERE event_id='".$eventoId."'"
    , null) 
)[0];

$evento = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * 
        FROM {$wpdb->prefix}eventos 
        WHERE id='".$eventoId."'"
    , null) 
)[0];

if($results){
    return include '../views/participante_info.php';
    die();
}
else {
    die("<h3 style='text-align:center; margin-top: 7%;'>Participante não encontrado!</h3>");
}