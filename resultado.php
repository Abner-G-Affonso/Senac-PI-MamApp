<?php

require("database.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Exames</title>
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
    <h2>Resultados de Exames</h2>

    <?php if (!empty($resultado)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Exame</th>
                    <th>Tipo de Exame</th>
                    <th>Arquivo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $resultado): ?>
                    <tr>
                        <td><?= htmlspecialchars($resultado['id_exame']) ?></td>
                        <td><?= htmlspecialchars($resultado['tipo_exame']) ?></td>
                        <td>
                            <?php
                            if (!empty($resultado['arquivo_resultado'])) {
                                echo "<a href='uploads/" . htmlspecialchars($resultado['arquivo_resultado']) . "' target='_blank'>Visualizar</a>";
                            } else {
                                echo "Arquivo não disponível";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><strong>Não há resultados disponíveis.</strong></p>
    <?php endif; ?>

    <a href="home.php">Voltar para página inicial</a>
</div>
</body>
</html>
