<?php
session_start();
require 'conexao.php';

// Somente usuários logados podem realizar agendamentos.
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.html?redirect=agend.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $nome = trim($_POST['nome'] ?? '');
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $servico = trim($_POST['servico'] ?? '');
    $horario = trim($_POST['horario'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $CPF = trim($_POST['CPF'] ?? '');

    try {
        $sql = "INSERT INTO agendamento
                (usuario_id, nome, sobrenome, telefone, horario, CPF, servico)
                VALUES
                (:usuario_id, :nome, :sobrenome, :telefone, :horario, :CPF, :servico)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':nome' => $nome,
            ':sobrenome' => $sobrenome,
            ':telefone' => $telefone,
            ':horario' => $horario,
            ':CPF' => $CPF,
            ':servico' => $servico
        ]);

        // Mantém o usuário logado e volta para a página inicial.
        echo "<script>alert('Agendamento realizado com sucesso!'); window.location.href='index.php';</script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao realizar o agendamento. Tente novamente.'); window.history.back();</script>";
        exit;
    }
}
?>
