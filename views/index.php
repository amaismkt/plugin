<?php require 'partials/header.php'; ?>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="row menu">
    <div class="col-md-12">
        <button id="botao-participantes" class="button" disabled>Participantes</button>
        <button id="botao-certificado" class="button">Certificado</button>
        <button type="button" class="button" data-toggle="modal" data-target="#myModal">Gerar Link</button>
    </div>
    <div class="col-md-12" style="margin-top: 16px;">
        <input type="checkbox" name="desabilitar" id="desabilitar"> Desabilitar download de certificados.<br>
        <div id="frase-personalizada" class="row" style="text-align:left !important; display: none;">
            <div class="col-md-12">
                <label for="frase-desabilitar">Frase personalizada: </label>
            </div>
            <div class="col-md-6">
                <input type="text" name="frase-desabilitar" class="form-control" placeholder="Ex: O período de downloads expirou...">
            </div>
            <div class="col-md-2">
                <button id="desabilitar" class="btn btn-success">Salvar</button>
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
                <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="margin:15px; display: none;" id="config-loader"></i>
                <button id="salvar-configuracoes" class="col-md-12 button button-primary importar" type="button"><i class="fa fa-check"></i> Salvar</button>
            </div>
        </div>

    </form>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Link gerado com sucesso!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Para disponibilizar o link para os participantes em seu site, copie a URL abaixo:</p>
          <br>
          <a id="url"></a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
</div>
  


<script>
    $("#configuracoes").submit(() => {
        event.preventDefault();
    });
    $("#url").html("http://" + window.location.hostname + "/plugin/wp-content/plugins/congresso/download.php");
    $("#url").attr("href", "http://" + window.location.hostname + "/plugin/wp-content/plugins/congresso/download.php");
</script>
<?php require 'partials/footer.php'; ?>