<?php
require_once("database.php");
session_start();

$db = new Database();
$conn = $db->getConexao();

$usuario = [
    "nome" => "",
    "rg" => "",
    "cpf" => "",
    "data_nascimento" => "",
    "telefone" => "",
    "email" => "",
    "endereco" => "",
    "senha" => ""
];

// Se o usuário estiver logado
if (isset($_SESSION['usuario_id'])) {
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $rg = $_POST["rg"];
    $cpf = $_POST["cpf"];
    $data_nascimento = $_POST["data_nascimento"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    if (isset($_SESSION['usuario_id'])) {
        // Atualiza dados do usuário logado
        $sql = "UPDATE usuario SET nome=?, rg=?, cpf=?, data_nascimento=?, telefone=?, email=?, endereco=?, senha=? WHERE id_usuario=?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$nome, $rg, $cpf, $data_nascimento, $telefone, $email, $endereco, $senha, $_SESSION['usuario_id']])) {
            echo "<p style='color: green;'>Dados atualizados com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>Erro ao atualizar dados.</p>";
        }
    } else {
        // Insere novo usuário
        $sql = "INSERT INTO usuario (nome, rg, cpf, data_nascimento, telefone, email, endereco, senha)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$nome, $rg, $cpf, $data_nascimento, $telefone, $email, $endereco, $senha])) {
            echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>Erro ao cadastrar usuário.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f5eaff;
            color: #6a0dad;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            background: #e3d4ff;
            border-radius: 20px;
            padding: 20px;
            margin: 20px auto;
            max-width: 500px;
        }
        input, button {
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
    </style>
</head>
<body>
<div class="container">
    
    
    <h2>Perfil</h2>
    <form method="POST" action="">
        <input type="text" name="nome" placeholder="Nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
        <input type="text" name="rg" placeholder="RG" value="<?= htmlspecialchars($usuario['rg']) ?>" required>
        <input type="text" name="cpf" placeholder="CPF" value="<?= htmlspecialchars($usuario['cpf']) ?>" required>
        <input type="date" name="data_nascimento" value="<?= htmlspecialchars($usuario['data_nascimento']) ?>" required>
        <input type="text" name="telefone" placeholder="Telefone" value="<?= htmlspecialchars($usuario['telefone']) ?>" required>
        <input type="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($usuario['email']) ?>" required>
        <input type="text" name="endereco" placeholder="Endereço" value="<?= htmlspecialchars($usuario['endereco']) ?>" required>
        <input type="password" name="senha" placeholder="Senha" required>

        <button type="submit" name="salvar">Salvar cadastro</button>
        <button type="submit" name="alterar">Alterar cadastro</button>
    </form>
    
    
    <button>
        <a href='home.php'>Página inicial</a>
    </button>
    
</div>
</body>
</html>
