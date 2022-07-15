<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Baixar Certificado</title>
    <style>
        body{
            background-color: #e1e5e7;
        }
        #nomeEvento{
            width: 100% !important;
            font-size: 32px;
            margin-bottom: 32px;
            text-align: center !important;
            text-transform: uppercase;
        }
        button{
            background-color: #E6007E !important;
            border-color: #E6007E !important;
        }
        button:hover{
            background-color: #E6007E !important;
            border-color: #E6007E !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top: 4%;">
            <div class="col-md-6 offset-md-3" style="background-color:white; padding: 2%; border-radius: 10px;"> 
                <form action="/wp-content/plugins/congresso/back-end/pdf.php" id="dados" method="GET">
                    <div id="nomeEvento"></div>
                    <h3 style="text-align:center;"><img id="icone-certificado" src="/wp-content/plugins/congresso/img/certificado.png" width="150px"> Baixe seu certificado:</h3>
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome completo..." required>
                    <input type="text" name="cpf" class="form-control" placeholder="Seu CPF" id="cpf" style="margin-top:16px" required>
                    <input type="number" id="event_id" name="event_id" class="form-control" hidden>
                    <button class="btn btn-primary" id="baixar" style="margin-top:16px">Baixar</button>
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

    function getFolderName() {
        let fullUri = window.location.pathname;
        let folderName = fullUri.split("/")[1];
        return folderName;
    }

    $(document).ready(() => {
        if(window.location.hostname == "localhost"){
            $("#icone-certificado").attr("src", "/"+getFolderName()+"/wp-content/plugins/congresso/img/certificado.png");
            $("#dados").attr("action", "/"+getFolderName()+"/wp-content/plugins/congresso/back-end/pdf.php");
        }
    });
</script>
</html>