<?php
if(!isset($wpdb)){
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/class-wpdb.php');
}

$participante_selecionado = isset($_GET["participante_selecionado"]) ? $_GET["participante_selecionado"] : null;

require_once "../vendor/autoload.php";
use Dompdf\Dompdf;

global $wpdb;

// Verificar se os parâmetros 'cpf' e 'event_id' estão definidos
if(isset($_REQUEST['cpf']) && isset($_REQUEST['event_id'])){
    $participante = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM {$wpdb->prefix}participantes WHERE cpf = %s AND event_id = %d", $_REQUEST['cpf'], $_REQUEST['event_id'])
    );

    if(count($participante) == 0) {
        die("Participante não encontrado.");
    }

    $participante = $participante[0]; // Garantir que estamos acessando o primeiro item da consulta
} else {
    die("Parâmetros de CPF ou event_id ausentes.");
}

$bloqueio = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}bloqueio ORDER BY id DESC LIMIT %d", 1) // Placeholder para o LIMIT 1
);

$background = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}congresso_images WHERE event_id = %d AND VERSO = 0 ORDER BY data DESC LIMIT %d", $_REQUEST['event_id'], 1) // Placeholder para LIMIT 1
);

$backImg = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}congresso_images WHERE event_id = %d AND VERSO = 1 ORDER BY data DESC LIMIT %d", $_REQUEST['event_id'], 1) // Placeholder para LIMIT 1
);

$certificado = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}congresso_info WHERE event_id = %d ORDER BY data DESC LIMIT %d", $_REQUEST['event_id'], 1) // Placeholder para LIMIT 1
);

$evento = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}eventos WHERE id = %d LIMIT %d", $_REQUEST['event_id'], 1) // Placeholder para LIMIT 1
);


if($_SERVER["HTTP_HOST"] == "localhost") {
    $path = "http://api.qrserver.com/v1/create-qr-code/?size=150x150&data=localhost/plugin/wp-content/plugins/congresso/views/validacao%2Ephp?code="
    . $participante->validation_code;
} else {
    $path = "http://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://".$_SERVER['SERVER_NAME']."/wp-content/plugins/congresso/views/validacao%2Ephp?code="
    . $participante->validation_code;
}

// Verificação para selecionar participante
if (is_array($participante) && count($participante) > 1) {
    include_once "../views/seleciona_participante.php";
} else {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = @file_get_contents($path, false); // Usar @ para evitar warnings se o arquivo não puder ser carregado
    $base64 = $data ? 'data:image/' . $type . ';base64,' . base64_encode($data) : '';

    // Definir os cabeçalhos antes de qualquer saída
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    header('Content-type: text/html; charset=UTF-8');
    
    ob_start(); // Começar o buffer de saída
    
    include_once "../views/pdf/index.php"; // Incluindo o HTML para o PDF
    
    $html = ob_get_contents(); // Captura o HTML gerado
    ob_end_clean(); // Limpar o buffer de saída
    
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('certificado.pdf', array("Attachment" => false)); // Corrigir nome do arquivo
    exit(0);
}
?>
