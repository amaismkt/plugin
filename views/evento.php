<?php require 'partials/header.php'; ?>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="row menu">
    <div class="col-md-12">
        <h2 style="margin-bottom: 20px;">
            <i class="fa fa-edit"></i> 
            Você está editando o evento <?php echo get_event($_GET['evento'])[0]->nome; ?>
        </h2>
        <button id="botao-editar" class="button" disabled>Evento</button>
        <button id="botao-participantes" class="button" >Participantes</button>
        <button id="botao-certificado" class="button">Certificado</button>
        <button 
            type="button" 
            class="button" 
            data-toggle="modal" 
            data-target="#myModal"
        >
            Gerar Link
        </button>
        <a href="#" id="validacao"><button class="button">URL de Validação</button></a>
    </div>
    <div class="col-md-12" style="margin-top: 16px;">
        <input type="checkbox" name="desabilitar" id="desabilitar"> 
        Desabilitar download de certificados.<br>
        <div 
            id="frase-personalizada" 
            class="row" 
            style="text-align:left !important; display: none;"
        >
            <div class="col-md-12">
                <label for="frase-desabilitar">Frase personalizada: </label>
            </div>
            <div class="col-md-6">
                <input 
                    type="text" 
                    name="frase-bloqueio" 
                    id="frase-bloqueio" 
                    class="form-control" 
                    placeholder="Ex: O período de downloads expirou..."
                >
            </div>
            <div class="col-md-2">
                <button id="salvar-frase" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 offset-md-4 canvas" id="campo-editar">
    <input 
        type="text" 
        id="nome-evento" 
        value="<?php echo get_event($_GET['evento'])[0]->nome ?>" hidden 
    />
    <form id="evento" class="form-arquivo">
        <h3><i class="fa fa-calendar"></i> Nome do evento</h3>
        <input 
            type="text" 
            style="width: 80%;" 
            name="nome" 
            value="<?php echo get_event($_GET['evento'])[0]->nome; ?>"
        >
        <input type="number" name="id" value="<?php echo $_GET['evento']; ?>" hidden>
        <button 
            id="botao-edicao" 
            class="button button-primary" 
            type="button" 
            value=""
        >
            Salvar
        </button>
        <i class="fa fa-spinner fa-spin" id="loading" aria-hidden="true"></i>
    </form>
</div>

<div class="col-md-8 offset-md-2 canvas" id="campo-participantes" style="display:none;">

    <h3><i class="fa fa-users"></i> Importar tabela de participantes</h3>

    <form id="importar" class="form-arquivo" enctype="multipart/form-data">
        <input type="file" id="input_file" name="csv" />
        <button 
            id="botao-importar" 
            class="button button-primary importar" 
            type="button"
        >
            <i class="fa fa-upload"></i> Importar
        </button>
        <i class="fa fa-spinner fa-spin" id="loading" aria-hidden="true"></i>
    </form>
    <?php ver_participantes($_GET['evento']) ?>

</div>

<div class="col-md-8 offset-md-2 canvas" id="campo-certificado" style="display:none;">

    <h3><i class="fa fa-cog"></i> Configurações do certificado</h3>

    <form id="configuracoes" class="form-arquivo" enctype="multipart/form-data">

        <div class="row" style="margin-top: 26px;">
            <label class="col-md-4" for="background_image">
                <b><i class="fa fa-image"></i> Imagem de fundo: </b>
            </label>
            <input 
                type="file" 
                class="col-md-8" 
                id="background_image" 
                name="background_image" 
            />
        </div>
        <div class="row">
            <img 
                src="<?php 
                        echo plugin_dir_url( dirname( __FILE__ ) ); 
                    ?>/back-end/img/<?php 
                        echo get_event_image($_GET['evento'])[0]->nome; 
                    ?>" 
                alt="" 
                srcset=""
            >
        </div>
        
        <div class="row" style="margin-top: 26px;">
            <label class="col-md-4" for="title">
                <b><i class="fa fa-tag"></i> Título: </b>
            </label>
            <input 
                class="col-md-8" 
                type="text" 
                id="title" 
                class="form-control" 
                name="title" 
                required 
                value="<?php echo get_event_image($_GET['evento'])[0]->titulo; ?>"
            >
        </div>
        
        <div class="row" style="margin-top: 26px;">
            <label class="col-md-4" for="locale">
                <b><i class="fa fa-map-marker"></i> Localidade: </b>
            </label>
            <input 
                class="col-md-8" 
                type="text" 
                id="locale" 
                class="form-control" 
                name="locale" 
                required 
                value="<?php echo get_event_image($_GET['evento'])[0]->localidade; ?>"
            >
        </div>

        <div class="row" style="margin-top: 26px;">
            <label class="col-md-4" for="data_evento">
                <b><i class="fa fa-calendar"></i> Data do Evento: </b>
            </label>
            <input 
                class="col-md-8" 
                type="text" 
                id="data_evento" 
                class="form-control" 
                name="data_evento" 
                required 
                value="<?php echo get_event_image($_GET['evento'])[0]->data_evento; ?>"
            >
        </div>

        <div class="row" style="margin-top: 26px;">
            <label class="col-md-4" for="qrcode_text">
                <b><i class="fa fa-qrcode"></i> Legenda QR Code: </b>
            </label>
            <input 
                class="col-md-8" 
                type="text" 
                id="qrcode_text" 
                class="form-control" 
                name="qrcode_text" 
                required 
                value="<?php echo get_event_image($_GET['evento'])[0]->qrcode_text; ?>"
            >
        </div>

        <div class="row" style="margin-top: 46px;">
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <i 
                    class="fa fa-spinner fa-pulse fa-3x fa-fw" 
                    style="margin:15px; display: none;" 
                    id="config-loader"
                ></i>
                <button 
                    id="salvar-configuracoes" 
                    class="col-md-12 button button-primary importar" 
                    type="button"
                >
                    <i class="fa fa-check"></i> Salvar
                </button>
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
          <a id="url" target="_blank"></a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
</div>

<script>
if(window.location.hostname == "localhost"){
    $("#validacao").attr(
        "href",
        "http://" + window.location.hostname + "/plugin/wp-content/plugins/congresso/views/validacao.php"
    );
}
else {
    $("#validacao").attr(
        "href",
        "http://" + window.location.hostname + "/wp-content/plugins/congresso/views/validacao.php"
    );
}
$("#url").html("Clique aqui");
localStorage.setItem("nomeDoEvento", $("#nome-evento").val());
</script>
<?php require 'partials/footer.php'; ?>