<?php require 'partials/header.php'; ?>
<script>
    $("#configuracoes").submit(() => {
        event.preventDefault();
    });
</script>
<div class="row menu">
    <div class="col-md-12">
        <button id="botao-participantes" class="button" disabled>Participantes</button>
        <button id="botao-certificado" class="button">Certificado</button>
        <a href="/plugin/wp-content/plugins/congresso/download.php"><button class="button button-success">Link Certificado</button></a>
    </div>
    <div class="col-md-12" style="margin-top: 16px;">
        <input onclick="mostrarFrase();" type="checkbox" name="desabilitar" id="desabilitar"> Desabilitar download de certificados.<br>
        <div id="frase-personalizada" class="row" style="text-align:left !important; display: none;">
            <div class="col-md-12">
                <label for="frase-desabilitar">Frase personalizada: </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="frase-desabilitar" class="form-control" placeholder="Ex: O período de downloads expirou...">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success">Salvar</button>
            </div>
        </div>
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

    <h3><i class="fa fa-cog"></i> Configurações do certificado</h3>

    <form id="configuracoes" class="form-arquivo" enctype="multipart/form-data">

        <div class="row" style="margin-top: 26px;">
            <label class="col-md-4" for="background_image"><b><i class="fa fa-image"></i> Imagem de fundo: </b></label>
            <input type="file" class="col-md-8" id="background_image" name="background_image" />
        </div>
        
        <div class="row" style="margin-top: 26px;">
            <label class="col-md-4" for="title"><b><i class="fa fa-tag"></i> Título: </b></label>
            <input class="col-md-8" type="text" id="title" class="form-control" name="title" required>
        </div>

        <div class="row" style="margin-top: 46px;">
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <button id="salvar-configuracoes" class="col-md-12 button button-primary importar" type="button"><i class="fa fa-check"></i> Salvar</button>
                <i class="fa fa-spinner fa-spin" id="loading" aria-hidden="true"></i>
            </div>
        </div>

    </form>

</div>
<script>
    $("#configuracoes").submit(() => {
        event.preventDefault();
    });
    function mostrarFrase()
    {
        $("#frase-personalizada").fadeToggle(300);
    }
</script>
<?php require 'partials/footer.php'; ?>