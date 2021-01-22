<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
        crossorigin="anonymous"
    >
    <title><?= $results[0]->nome; ?></title>
    <style>
        .main {
            margin-top: 7%;
            background: white;
            padding: 2%;
            border-radius: 8px;
        }
        body {
            background: #e1e5e7;
        }
        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        h3 {
            color: #666;
            text-transform: uppercase;
            text-align: center;
            font-weight: 400;
        }
    </style>
</head>
<body>
    <div class="main col-md-6 offset-md-3">
        <h3><?= $evento->nome ?></h3>
        <img 
            id="icone-certificado" 
            src="/wp-content/plugins/congresso/img/certificado.png" 
            width="150px"
        ><b>Validação do certificado: <?= $results[0]->validation_code; ?></b>
        <ul>
            <li><b>Nome:</b> <?= $results[0]->nome; ?></li>
            <li><b>Data do evento:</b> <?= $eventoInfo->data_evento; ?></li>
            <li><b>Carga horária:</b> <?= $results[0]->carga_horaria; ?></li>
            <li><b>Categoria:</b> <?= $results[0]->categoria; ?></li>
            <li>
                <b>Autenticador:</b> Associação de Obstetrícia e
                Ginecologia do Rio Grande do Sul – Sogirgs
                – CNPJ: 91.336.198/0001-34
            </li>
        </ul>
    </div>
</body>
<script 
    src="https://code.jquery.com/jquery-3.4.1.js" 
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" 
    crossorigin="anonymous"
></script>
<script>
    $(document).ready(() => {
        if(window.location.hostname == "localhost"){
            $("#icone-certificado").attr(
                "src", 
                "/plugin/wp-content/plugins/congresso/img/certificado.png"
            );
        }
    });
</script>
</html>