<?php require 'partials/header.php'; ?>

<div class="row menu">
    <div class="col-md-12">
        <button id="botao-participantes" class="button" disabled>Participantes</button>
        <button id="botao-certificado" class="button">Certificado</button>
    </div>
</div>

<div class="col-md-8 offset-md-2 canvas" id="campo-participantes">

    <h3><i class="fa fa-users"></i> Importar tabela de participantes</h3>

    <form id="importar" class="form-arquivo" enctype="multipart/form-data">

        <input type="file" id="input_file" name="csv" />
        <button id="botao-importar" class="button button-primary importar" type="button"><i class="fa fa-upload"></i> Importar</button>
        <i class="fa fa-spinner fa-spin" id="loading" aria-hidden="true"></i>

    </form>

</div>

<div class="col-md-8 offset-md-2 canvas" id="campo-certificado" style="display:none;">

    <h3><i class="fa fa-image"></i> Imagem de fundo do certificado</h3>

    <form id="importar" class="form-arquivo" enctype="multipart/form-data">

        <input type="file" id="input_file" name="csv" />
        <button id="botao-importar" class="button button-primary importar" type="button"><i class="fa fa-upload"></i> Salvar</button>
        <i class="fa fa-spinner fa-spin" id="loading" aria-hidden="true"></i>

    </form>

</div>


<?php require 'partials/footer.php'; ?>