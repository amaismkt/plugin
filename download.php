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
                <form action="/plugin/wp-content/plugins/congresso/back-end/pdf.php" method="GET">
                    <h3 style="text-align:center;"><img src="img/certificado.png" alt="certificado" width="150px">Baixe seu certificado:</h3>
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome completo..." required>
                    <input type="text" name="cpf" class="form-control" placeholder="Seu CPF" style="margin-top:16px" required>
                    <button class="btn btn-primary" style="margin-top:16px">Baixar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>