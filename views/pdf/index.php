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
        padding: 0;
        margin: 0;
        font-family: 'Roboto', sans-serif;
        background-color: red;
    }

    .corpo-doc {
        text-align: center;
        padding-top: 300px;
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
</style>
<body>
    <div>
        <img class="background" src="../back-end/img/<?= $background->nome;?>">
    </div>
    <div class="corpo-doc">
        <h1 class="nome">
            <?= $results[0]->nome; ?>
        </h1>
        <h2><?= $background->titulo; ?></h2>
        <br><span>Carga horária: <?= $results[0]->carga_horaria; ?></span>
        <br><span>Categoria: <?= $results[0]->categoria; ?></span>
        <?php if($background->localidade && $background->data_evento): ?>
            <br>
            <br>
            <br>
            <span><?= $background->localidade; ?>, <?= $background->data_evento; ?>.</span>
        <?php endif; ?>
        <div class="qrcode">
            <div class="qrcode_text"><?= $background->qrcode_text; ?></div>
            <br>
            <img src="<?=$base64;?>" class="qrcodeimg"/>
            <span class="codenumber"><?= $results[0]->validation_code; ?></span>
        </div>
    </div>
</body>
</html>
