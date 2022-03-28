<?php
/*
Plugin Name: Congresso
Description: Gerenciamento de participantes e certificados.
Version: 0.1
Author: A+ (Lucas de Lima Monteiro)
Author URI: http://github.com/lucaslimaaz/
*/

add_action('admin_menu', 'my_admin_menu');

function edit()
{
    require 'views/evento.php';
}

function my_admin_menu()
{
    add_menu_page('Congresso', 'Congresso', 'manage_options', 'congresso', 'congresso', 'dashicons-admin-users', 6);
    add_submenu_page('edit', 'Evento', 'Evento', 'manage_options', 'evento', 'edit');
    //add_submenu_page('download', 'download', 'download', 'read', 'download', 'download');
}

function congresso()
{
    require 'views/index.php';
}


function download()
{
    require 'views/download.php';
}

function get_event($id)
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $event = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."eventos"." WHERE id=".$id);
    
    if($wpdb->last_error !== '') {
        http_response_code(500);
        return array("error" => $wpdb->last_error);
    }
    return $event;
}

function get_event_image($eventId)
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $imageInfos = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."congresso_images"." WHERE event_id=".$eventId." AND VERSO = 0 ORDER BY data DESC LIMIT 1");
    
    if($wpdb->last_error !== '') {
        http_response_code(500);
        return array("error" => $wpdb->last_error);
    }
    return $imageInfos;
}

function get_event_info($eventId)
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $imageInfos = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."congresso_info"." WHERE event_id=".$eventId." ORDER BY data DESC LIMIT 1");
    
    if($wpdb->last_error !== '') {
        http_response_code(500);
        return array("error" => $wpdb->last_error);
    }
    return $imageInfos;
}

function get_event_backimage($eventId)
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $imageInfos = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."congresso_images"." WHERE event_id=".$eventId." AND VERSO = 1 ORDER BY data DESC LIMIT 1");
    
    if($wpdb->last_error !== '') {
        http_response_code(500);
        return array("error" => $wpdb->last_error);
    }
    return $imageInfos;
}

function ver_participantes($id)
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $participantes = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."participantes"." WHERE event_id=".$id);
    require 'views/participantes.php';
}


function info_table()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if(count($wpdb->get_var('SHOW TABLES LIKE "'.$wpdb->prefix.'congresso_info"')) == 0){

        $sql = "
            CREATE TABLE `".$wpdb->prefix."congresso_info` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `event_id` int(11) NOT NULL,
                `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `titulo` varchar(255) NOT NULL,
                `qrcode_text` text NOT NULL,
                `localidade` varchar(255) NOT NULL,
                `data_evento` varchar(255) NOT NULL,
                `frase_bloqueio` varchar(255) NOT NULL,
                PRIMARY KEY(id)
            );
        ";

        dbDelta($sql);
    }
}

register_activation_hook(__FILE__, 'info_table');

function images_table()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if(count($wpdb->get_var('SHOW TABLES LIKE "'.$wpdb->prefix.'congresso_images"')) == 0){

        $sql = "
            CREATE TABLE `".$wpdb->prefix."congresso_images` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `event_id` int(11) NOT NULL,
                `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `nome_arquivo` varchar(255) NOT NULL,
                `verso` tinyint(1) DEFAULT 0,
                PRIMARY KEY(id)
            );
        ";

        dbDelta($sql);
    }
}

register_activation_hook(__FILE__, 'images_table');

function congresso_tables()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if(count($wpdb->get_var('SHOW TABLES LIKE "'.$wpdb->prefix.'participantes"')) == 0){

        $sql = "
            CREATE TABLE `".$wpdb->prefix."participantes` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `event_id` int(11) NOT NULL,
                `nome` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `cpf` varchar(255) NOT NULL,
                `carga_horaria` varchar(255) NOT NULL,
                `categoria` varchar(255) NOT NULL,
                `validation_code` varchar(255) NOT NULL,    
                PRIMARY KEY(id)
            );
        ";

        dbDelta($sql);

    }
}

register_activation_hook(__FILE__, 'congresso_tables');


function bloqueio_table()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if(count($wpdb->get_var('SHOW TABLES LIKE "'.$wpdb->prefix.'bloqueio"')) == 0){

        $sql = "
            CREATE TABLE `".$wpdb->prefix."bloqueio` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `event_id` int(11) NOT NULL,
                `frase_bloqueio` varchar(255) NOT NULL,
                `bloqueio` TINYINT (1) DEFAULT 0,
                PRIMARY KEY(id)
            );
        ";

        dbDelta($sql);

    }
}

register_activation_hook(__FILE__, 'bloqueio_table');

function events_table()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if(count($wpdb->get_var('SHOW TABLES LIKE "'.$wpdb->prefix.'eventos"')) == 0){

        $sql = "
            CREATE TABLE `".$wpdb->prefix."eventos` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `nome` varchar(255) NOT NULL,
                PRIMARY KEY(id)
            );
        ";

        dbDelta($sql);

    }
}

register_activation_hook(__FILE__, 'events_table');

?>