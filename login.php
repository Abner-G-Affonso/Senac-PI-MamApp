<?php
require_once "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    try {
        $db = new Database();
        $conn = $db->getConexao();

        $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha); 

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION["usuario"] = $stmt->fetch(PDO::FETCH_ASSOC);
            header("Location: home.php");
            exit();
        } else {
            $erro = "E-mail ou senha inválidos.";
        }
    } catch (PDOException $e) {
        $erro = "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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

        .erro {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body class="login-body">
    <div class="container">
        <h1>Login</h1>

        <?php if (!empty($erro)) echo "<p class='erro'>$erro</p>"; ?>

        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="e-mail" required>
            <input type="password" name="senha" placeholder="senha" required>
            <button type="submit">ENTRAR</button>
        </form>

        <a href="usuario.php">Novo Cadastro</a>
    </div>
</body>
</html>

