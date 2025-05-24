<?php
require("database.php");


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exames</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: sans-serif;
            background: #f5eaff;
            color: #6a0dad;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container, .section, .perfil-form {
            background: #e3d4ff;
            border-radius: 20px;
            padding: 20px;
            margin: 20px;
        }

        input, button, a {
            display: block;
            width: 80%;
            margin: 10px auto;
            padding: 10px;
            border: none;
            border-radius: 10px;
        }

        button {
            background: #9f4dff;
            color: white;
            font-weight: bold;
        }

        a {
            background: #b586ff;
            color: white;
            text-decoration: none;
            padding: 10px;
        }

        .perfil-header {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Exames</h2>

    <a href="agendamento.php">Agendar sua consulta</a>
    <a href="consulta.php">Consultas</a>
    <a href="resultado.php">Resultado de Exames</a>
    
</div>

</body>
</html>
