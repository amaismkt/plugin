
<style>
  * {
    font-family: Georgia, 'Times New Roman', Times, serif;
  }

  body {
    background-color: #f1f1f1;
  }

  .card {
    border: 1px solid #e1e1e1;
    border-radius: 8px;
    padding: 25px;
    margin: 35px;
    background-color: white;
    cursor: pointer;
  }

  .card:hover {
    transition: 0.2s;
    box-shadow: 2px 2px 15px 2px #e1e1e1;
  }

  .display-1 {
    margin: 35px;
  }
</style>

<script>
  let currentUrl = window.location.href;

  function selectParticipante(id) {
    window.location.replace(`${currentUrl}&participante_selecionado=${id}`);
  }
</script>

<div class="row">
    <div class="col-md-8 offset-md-2" style="margin-top:5%;">
        <h1 class="display-1">Múltiplos participantes encontrados: </h1>
        <?php foreach($participante as $part): ?>
          <div class="card" onclick="selectParticipante(<?=$part->id?>)">
            <div><?= $part->nome; ?></div>
            <div><?= $part->mesa_redonda; ?></div>
            <div><?= $part->palestra; ?></div>
          </div>
        <?php endforeach; ?>
    </div>
</div>
