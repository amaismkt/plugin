<?php

global $wpdb;

if(!isset($wpdb))
{
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/class-wpdb.php');
}

$id = $_POST['id'];
$wpdb->delete($wpdb->prefix.'participantes', array( 'id' => $id ));