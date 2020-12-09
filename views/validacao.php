<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
        crossorigin="anonymous"
    >
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
            <div 
                class="col-md-6 offset-md-3" 
                style="background-color:white; padding: 2%; border-radius: 10px;"
            > 
                <form 
                    action="/wp-content/plugins/congresso/back-end/validation.php" 
                    id="dados" 
                    method="GET"
                >
                    <div id="nomeEvento"></div>
                    <h3 style="text-align:center;">
                        <img 
                            id="icone-certificado" 
                            src="/wp-content/plugins/congresso/img/certificado.png" 
                            width="150px"
                        > 
                        Validar certificado:
                    </h3>
                    <input 
                        type="text" 
                        name="validation_code" 
                        class="form-control" 
                        placeholder="Digite aqui o código de validação." 
                        id="validation_code" 
                        style="margin-top:16px" 
                        required
                    >
                    <button 
                        class="btn btn-primary" 
                        id="baixar" 
                        style="margin-top:16px"
                    >
                        Validar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
<script 
    src="https://code.jquery.com/jquery-3.4.1.js" 
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" 
    crossorigin="anonymous"
></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const code = urlParams.get('code');

    $(document).ready(() => {
        if(window.location.hostname == "localhost"){
            $("#icone-certificado").attr("src", "/plugin/wp-content/plugins/congresso/img/certificado.png");
            $("#dados").attr("action", "/plugin/wp-content/plugins/congresso/back-end/validation.php");
        }

        if(code) {
            $("#validation_code").val(code);
        }
    });
</script>
</html>