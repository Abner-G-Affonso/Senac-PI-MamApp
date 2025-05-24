<?php
require_once("database.php");

$db = new Database();
$conn = $db->getConexao();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
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

        .menu {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .logout {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="section">
        <h2>Próximo Exame</h2>
        <?php 
        $stmtExame = $conn->prepare("SELECT id_exame, data_exame, status FROM exame ORDER BY data_exame ASC LIMIT 1");
        $stmtExame->execute();
        $exame = $stmtExame->fetch(PDO::FETCH_ASSOC);

        if ($exame) {
            echo "<p>Exame #{$exame['id_exame']} em " . date("d/m", strtotime($exame['data_exame'])) . " - Status: {$exame['status']}</p>";
        } else {
            echo "<p>Sem agendamento</p>";
        } ?>
    </div>

    <div class="section">
        <h2>Próximas Consultas</h2>
        <?php 
        $stmtConsulta = $conn->prepare("SELECT id_consulta, id_horario, local, id_medico FROM consulta ORDER BY id_horario ASC LIMIT 1");
        $stmtConsulta->execute();
        $consulta = $stmtConsulta->fetch(PDO::FETCH_ASSOC);

        if ($consulta) {
            echo "<p>Consulta #{$consulta['id_consulta']} - Médico: {$consulta['id_medico']}, Local: {$consulta['local']}, Horário: {$consulta['id_horario']}</p>";
        } else {
            echo "<p>Sem agendamento</p>";
        } ?>
    </div>
    
    
    </div>
    <div class="menu">
        <a href="exames.php">Exames</a>
        <a href="consulta.php">Consultas</a>
        
        
    </div>

    </div>
    <div class="menu">
        
        <a href="usuario.php">Perfil</a>
        
    </div>

    <div class="logout">
        <a href="login.php">SAIR</a>
    </div>
</body>
</html>
