<?php

// Certifique-se de que o WordPress está carregado corretamente
if (!defined('ABSPATH')) {
    require_once('../../../../wp-load.php'); // Carrega o WordPress se ainda não estiver carregado
}

// Verifica se o $wpdb está disponível
global $wpdb;

// Obtém o registro mais recente da tabela 'bloqueio'
$bloqueio = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}bloqueio ORDER BY id DESC LIMIT 1", ARRAY_A);

// Define o cabeçalho como JSON
header('Content-Type: application/json');

// Retorna os dados como JSON
echo json_encode($bloqueio ?: []);
