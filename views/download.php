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
    </style>
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top: 4%;">
            <div class="col-md-6 offset-md-3" style="background-color:white; padding: 2%; border-radius: 10px;"> 
                <form action="/wp-content/plugins/congresso/back-end/pdf.php" id="dados" method="GET">
                    <h3 style="text-align:center;"><img src="img/certificado.png" alt="certificado" width="150px">Baixe seu certificado:</h3>
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome completo..." required>
                    <input type="text" name="cpf" class="form-control" placeholder="Seu CPF" id="cpf" style="margin-top:16px" required>
                    <input type="number" name="event_id" class="form-control" value="<?php echo $_GET['evento']?>" hidden>
                    <button class="btn btn-primary" id="baixar" style="margin-top:16px">Baixar</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script>
    $("#cpf").mask("000.000.000-00");

    $("#dados").submit(() => {

        let cpf = $("#cpf").val();
        cpf = cpf.replace('.', '');
        cpf = cpf.replace('.', '');
        cpf = cpf.replace('-', '');
        $("#cpf").val(cpf);

    });
</script>
</html>