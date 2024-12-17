<?php

global $wpdb;

if(!isset($wpdb))
{
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/class-wpdb.php');
}

$frase = $_POST["frase"];
$table = $wpdb->prefix."bloqueio";

if(isset($_POST["bloqueio"])){
    $wpdb->insert($table, array(
        'frase_bloqueio' => $frase,
        'bloqueio' => 0
    ));
}else{
    $wpdb->insert($table, array(
        'frase_bloqueio' => $frase,
        'bloqueio' => 1
    ));
}