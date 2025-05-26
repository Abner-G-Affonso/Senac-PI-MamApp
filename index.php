<?php

require_once('database.php');

try {
    $db = new Database();
    $con = $db->getConexao();

    // Se conectou com sucesso, redireciona para home.php
    header("Location: login.php");
    exit;
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}
