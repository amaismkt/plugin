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
    }
</style>
<body>
    <div class="corpo-doc">
        <h1> Documento oficial </h1>
        <ul>
            <?php
            foreach ($results[0] as $key => $value) {
                echo "<li>".$value."</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>