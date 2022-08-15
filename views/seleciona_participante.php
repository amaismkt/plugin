
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
          <div class="card" onclick="selectParticipante(<?=$part->id?>)">
            <div><?= $part->mesa_redonda; ?></div>
            <div><?= $part->palestra; ?></div>
          </div>
        <?php endforeach; ?>
    </div>
</div>
