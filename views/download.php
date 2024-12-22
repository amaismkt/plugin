<?php
if(!isset($wpdb)){
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/class-wpdb.php');
}

global $wpdb;
$evento_id = isset($_REQUEST['evento']) ? $_REQUEST['evento'] : 0;  // Certifique-se de que o parâmetro 'evento' existe.
$certificado =  $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}congresso_info WHERE event_id = %d ORDER BY data DESC LIMIT 1", 
        $evento_id
    )
);

if ($certificado) {
    $certificado = $certificado[0]; // Pegando o primeiro resultado da consulta
} else {
    $certificado = null; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Baixar Certificado</title>
    <link rel="stylesheet" href="../css/download.css">
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top: 4%;">
            <div class="col-md-6 offset-md-3" style="background-color:white; padding: 2%; border-radius: 10px;"> 
                <form action="/wp-content/plugins/congresso/back-end/pdf.php" id="dados" method="GET">
                    <div id="nomeEvento"></div>
                    <h3 style="text-align:center;">
                        <img id="icone-certificado" src="/wp-content/plugins/congresso/img/certificado.png" width="150px"> 
                        Baixe seu certificado:
                    </h3>
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome completo..." required>
                    <input type="text" name="cpf" class="form-control" placeholder="Seu CPF" id="cpf" style="margin-top:16px" required>
                    <input type="number" id="event_id" name="event_id" class="form-control" hidden>
                    <button class="btn btn-primary" id="baixar" style="margin-top:16px; border-color: <?=$certificado ? $certificado->primary_color : '#000000';?> !important; background-color: <?=$certificado ? $certificado->primary_color : '#000000';?> !important;">Baixar</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const eventId = urlParams.get('evento');
    const nomeEvento = urlParams.get('nomeEvento');

    $("#event_id").val(eventId);
    $("#nomeEvento").html(nomeEvento);
    $("#cpf").mask("000.000.000-00");

    $("#dados").submit(() => {
        let cpf = $("#cpf").val();
        cpf = cpf.replace('.', '');
        cpf = cpf.replace('.', '');
        cpf = cpf.replace('-', '');
        $("#cpf").val(cpf);
    });

    $(document).ready(() => {
        if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
            // substituir por caminho local correto caso a pasta não se chame 'wordpress'
            $("#dados").attr("action", "http://localhost/wordpress/wp-content/plugins/congresso/back-end/pdf.php");
        } 
    });
</script>
</html>
