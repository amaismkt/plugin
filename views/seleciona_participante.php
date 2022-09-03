<?php
if(!isset($wpdb)){
    //the '../' is the number of folders to go up from the current file to the root-map.
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

global $wpdb;
$certificado =  $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}congresso_info WHERE event_id=".$_REQUEST['event_id']." ORDER BY data DESC LIMIT 1", null) 
)[0];

?>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/seleciona_participante.css">

<script>
  let currentUrl = window.location.href;

  function selectParticipante(id) {
    window.open(`${currentUrl}&participante_selecionado=${id}`, '_blank');
  }
</script>

<div class="row">
    <div class="outside-card" style="margin-top:5%;">
        <h1 class="display-1"><?= $evento->nome; ?></h1>
        <div class="subtitle">
          <img 
            id="icone-certificado" 
            src="../img/certificado.png" 
            width="150px"
          > 
          <h2>Certificados de <b><?= $participante[0]->nome; ?></b>:</h2>
        </div>
        <?php foreach($participante as $part): ?>
          <div class="card" style="background-color: <?=$certificado->primary_color;?> !important;" onclick="selectParticipante(<?=$part->id?>)">
            <div><?= $part->mesa_redonda; ?></div>
            <div><?= $part->palestra; ?></div>
          </div>
        <?php endforeach; ?>
    </div>
</div>
