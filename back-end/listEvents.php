<?php

if(!isset($wpdb)){
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

$eventos = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}eventos", null));

die(json_encode($eventos));