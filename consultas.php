<?php
// Conexão com banco de dados
$host = 'localhost';
$dbname = 'mamapp';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id_consulta, data_consulta, id_medico, local FROM consulta");
    $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro ao conectar ao banco: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Consulta</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #d6bbff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Visualizar Consulta</h2>

    <?php if (!empty($consultas)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Consulta</th>
                    <th>Data</th>
                    <th>ID Médico</th>
                    <th>Local</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta): ?>
                    <tr>
                        <td><?= htmlspecialchars($consulta['id_consulta']) ?></td>
                        <td><?= htmlspecialchars($consulta['data_consulta']) ?></td>
                        <td><?= htmlspecialchars($consulta['id_medico']) ?></td>
                        <td><?= htmlspecialchars($consulta['local']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><strong>Não há agendamento.</strong></p>
    <?php endif; ?>

    <a href="agendamento.php">Agendar sua consulta</a>
</div>
</body>
</html>
