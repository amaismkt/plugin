<?php

global $wpdb;

if(!isset($wpdb))
{
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

$dados = $_POST["data"];

$table = $wpdb->prefix."eventos";

$wpdb->insert($table, ["nome" => $dados["nome"]]);
die(var_dump($_POST));