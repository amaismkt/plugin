<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documento</title>
</head>
<style>
    body {
        padding: 0 !important;
        margin: 0 !important;
        font-family: 'Roboto', sans-serif;
    }

    .corpo-doc {
        text-align: center;
        padding-top: 266px;
        margin-left: 340px;
    }

    h1 {
        font-size: 40px;
    }

    .certificado {
        color: red;
    }

    .nome {
        color: black;
        padding-top: -30px;
    }

    .background {
        width: 1125px;
        position: absolute;
        left: -45px;
        top: -45px;
        z-index: -1;
    }
    h2 {
        padding-top: 40px;
    }
    .qrcodeimg {
        width: 100px;
        margin-top: 8px;
    }
    .qrcode_text {
        text-align: left !important;
        font-size: 10px;
        line-height: 11px !important;
    }
    .qrcode {
        position: fixed;
        text-align: left;
        width: 140px;
        left: 30px;
        top: 20px;
    }
    .codenumber {
        font-weight: bold;
        margin-top: 16px;
        text-align: left;
    }
    .verso {
        margin: -45px 0 0 -45px !important;
        padding: 0% !important;
        width: 100%;
    }
    .verso-container {
        width: 109%;
    }
</style>
<body>
    <div class="page_break">
        <?php
        // URL do arquivo em localhost
        $localUrl = "http://localhost/wordpress/wp-content/plugins/congresso/back-end/img/";
        // URL para produção ou ambiente externo
        $prodUrl = "https://sogirgs.org.br/wp-content/plugins/congresso/back-end/img/";

        // Verifica se está em localhost
        $isLocalhost = ($_SERVER['HTTP_HOST'] === 'localhost');

        // Define a URL base conforme o ambiente
        $baseUrl = $isLocalhost ? $localUrl : $prodUrl;
        ?>

        <!-- Exibe a imagem com a URL correspondente -->
        <img class="background" src="<?= $baseUrl . $background[0]->nome_arquivo; ?>">
    </div>
    <div class="corpo-doc">
        <h1 class="nome">
            <?= $participante->nome; ?>
        </h1>
        <h2><?= $certificado[0]->titulo; ?></h2>
        <br><span>Carga horária: <?= $participante->carga_horaria; ?></span>
        <br><span>Categoria: <?= $participante->categoria; ?></span>
        <br><span><?= $participante->mesa_redonda; ?></span>
        <br><span><?= $participante->palestra; ?></span>
        <?php if($certificado[0]->localidade && $certificado[0]->data_evento): ?>
            <br>
            <span><?= $certificado[0]->localidade; ?>.</span>
        <?php endif; ?>
        <div class="qrcode">
            <div class="qrcode_text"><?= $certificado[0]->qrcode_text; ?></div>
            <br>
            <img src="<?=$base64;?>" class="qrcodeimg"/>
            <span class="codenumber"><?= $participante->validation_code; ?></span>
        </div>
    </div>
    <div class="verso-container">
        <img class="verso" src="<?= $baseUrl . $backImg[0]->nome_arquivo; ?>" />
    </div>
</body>
</html>
