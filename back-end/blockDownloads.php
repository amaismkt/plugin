<?php

global $wpdb;

if(!isset($wpdb))
{
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

$frase = $_POST["frase"];
$table = $wpdb->prefix."bloqueio";

$wpdb->insert($table, array(
    'frase-bloqueio' => $frase,
    'bloqueio' => 1
));