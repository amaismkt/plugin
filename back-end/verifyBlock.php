<?php

if(!isset($wpdb)){
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

$bloqueio = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}bloqueio ORDER BY id DESC LIMIT 1", null) 
)[0];

die(json_encode($bloqueio));