<?php
session_start();

// O login salva o usuário em usuario_id.
// Se não existir, o usuário realmente não está autenticado.
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.html?redirect=agend.html');
    exit;
}

require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = (int) $_SESSION['usuario_id'];
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

        echo "<script>alert('Agendamento realizado com sucesso!'); window.location.href='user_agend.php';</script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao realizar o agendamento: ' + " . json_encode($e->getMessage()) . "); window.history.back();</script>";
        exit;
    }
}
?>
