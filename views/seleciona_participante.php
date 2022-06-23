
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
<style>
  * {
    font-family: 'Nunito', 'Times New Roman', Times, serif;
  }

  body {
    background-color: #f1f1f1;
  }

  .outside-card {
    border-radius: 8px;
    padding: 25px;
    margin: 35px;
    background-color: white;
    box-shadow: 2px 2px 15px 2px #e1e1e1;
    margin: 0 25% 0 25%;
  }

  .card {
    border-radius: 8px;
    padding: 25px;
    margin: 35px;
    background-color: #E6007E;
    color: white;
    font-weight: 600;
    cursor: pointer;
  }

  .card:hover {
    transition: 0.2s;
    box-shadow: 2px 2px 15px 2px #e1e1e1;
  }

  .display-1 {
    margin: 35px;
    text-align: center;
  }

  .subtitle {
    display: flex;
    justify-content: center;
  }

  #icone-certificado {
    margin-right: 30px;
  }
</style>

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
