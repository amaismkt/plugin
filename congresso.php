<?php
/*
Plugin Name: Congresso
Description: Gerenciamento de participantes e certificados.
Version: 0.1
Author: A+
Author URI: http://amaismkt.com.br
*/

add_action('admin_menu', 'my_admin_menu');

function my_admin_menu()
{
    add_menu_page('Congresso', 'Congresso', 'manage_options', 'congresso', 'congresso', 'dashicons-admin-users', 6);
    add_submenu_page('congresso', 'Participantes', 'Participantes', 'manage_options', 'participantes', 'ver_participantes');
}

function congresso()
{
    require 'views/index.php';
}

function ver_participantes()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $participantes = $wpdb->get_results( "SELECT * FROM wp_participantes");
    
    require 'views/participantes.php';
}


function images_tables()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if(count($wpdb->get_var('SHOW TABLES LIKE "wp_congresso_images"')) == 0){

        $sql = "
            CREATE TABLE `wp_congresso_images` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `nome` varchar(255) NOT NULL,
                `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id)
            );
        ";

        dbDelta($sql);
    }
}

register_activation_hook(__FILE__, 'images_tables');

function congresso_tables()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if(count($wpdb->get_var('SHOW TABLES LIKE "wp_partipantes"')) == 0){

        $sql = "
            CREATE TABLE `wp_participantes` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `nome` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                PRIMARY KEY(id)
            );
        ";

        dbDelta($sql);

    }
}

register_activation_hook(__FILE__, 'congresso_tables');


?>