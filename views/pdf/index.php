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

    img {
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
        height: 100px;
        text-align: center;
    }
</style>
<body>
    <div class="teste">
        <img src="../back-end/img/<?= $background->nome;?>">
    </div>
    <div class="corpo-doc">
        <h1 class="nome">
            <?= $results[0]->nome; ?>
        </h1>
        <h2><?= $background->titulo; ?></h2>
        <br><span>Carga horária: <?= $results[0]->carga_horaria; ?></span>
        <br><span>Categoria: <?= $results[0]->categoria; ?></span>
        <br><span>Código: <?= $results[0]->validation_code; ?></span>
        <br><span><img src="<?=$base64;?>" class="qrcodeimg"/></span> 
    </div>
</body>
</html>
