<?php

// Certifique-se de que o WordPress está carregado corretamente
if (!defined('ABSPATH')) {
    require_once('../../../../wp-load.php'); // Carrega o WordPress se ainda não estiver carregado
}

// Verifica se o $wpdb está disponível
global $wpdb;

// Obtém os eventos da tabela personalizada
$eventos = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}eventos", ARRAY_A);

// Define o cabeçalho como JSON
header('Content-Type: application/json');

// Retorna os dados como JSON
echo json_encode($eventos);
