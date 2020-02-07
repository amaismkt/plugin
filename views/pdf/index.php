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
        background-image: url("../assets/images/benjamin-voros-yrwpJwDNSHE-unsplash.jpg");
        background-color: red;
        padding: 0;
        margin: 0;
        border: 1px solid black;
        font-family: 'Roboto', sans-serif;
    }

    .corpo-doc {
        text-align: center;
        margin-top: 160px;
        margin-left: 150px;
    }

    h1 {
        font-size: 40px;
    }

    .certificado {
        color: red;
    }

    .nome {
        color: black;
    }

</style>
<body>
    <div class="corpo-doc">
        <h1 class="certificado">
            Certificado
        </h1>
        <span>Certificamos que </span>
        <h1 class="nome">
            <?php echo $results[0]->nome; ?>
        </h1>
        <span> participou satisfatoriamente da</span>
        <h2>3ª Reunião do Núcleo de Uroginecologia 2019</h2>
        <span> na sede da Associação de Obstetrícia e Ginecologia do Rio Grande do Sul, com carga horária de 03h.</span>
        <br>
        <br>
        <br>
        <span>
            Porto Alegre,
            <?php
                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                echo strftime('%d de %B de %Y', strtotime('today'));
            ?>
        </span>
    </div>
</body>
</html>