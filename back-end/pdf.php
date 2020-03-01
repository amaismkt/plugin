<?php

if(!isset($wpdb)){
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

require_once "../plugins/dompdf/autoload.inc.php";
use Dompdf\Dompdf;

global $wpdb;
$results = $wpdb->get_results( 
    //$wpdb->prepare("SELECT * FROM {$wpdb->prefix}participantes WHERE nome='".$_REQUEST['nome']."' AND cpf='".$_REQUEST['cpf']."'", null) 
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}participantes WHERE cpf='".$_REQUEST['cpf']."'", null) 
);

$bloqueio = $wpdb->get_results(
     $wpdb->prepare("SELECT * FROM {$wpdb->prefix}bloqueio ORDER BY id DESC LIMIT 1", null) 
)[0];

if($bloqueio->bloqueio == 1){
    die("<h3 style='text-align:center; margin-top: 7%;'>".$bloqueio->frase_bloqueio."</h3>");
}

if(!$results){
    die("<h3 style='text-align:center; margin-top: 7%;'>Participante não encontrado!</h3>");
}

$background =  $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}congresso_images ORDER BY data DESC LIMIT 1", null) 
)[0];

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
header('Content-type: text/html; charset=UTF-8');
ob_start();

include_once "../views/pdf/index.php";

$html = ob_get_contents();
ob_end_clean();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('aaa', array("Attachment" => false));
exit(0);

