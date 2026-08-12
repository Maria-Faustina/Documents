<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.html');
    exit;
}

require 'conexao.php';

try {
    $stmt = $pdo->prepare("SELECT id, nome, sobrenome, telefone, horario, CPF, servico
                           FROM agendamento
                           WHERE usuario_id = :usuario_id
                           ORDER BY horario ASC");
    $stmt->execute([':usuario_id' => $_SESSION['usuario_id']]);
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erro ao carregar os agendamentos.');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Agendamentos - NewDent</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inde.css">
</head>
<body>
    <header class="container-cabecalho">
        <div class="container-logo">
            <img src="img/logo.png" alt="Logo" class="logo">
            <img src="img/nome_loja.png" alt="NewDent" class="logo-texto">
        </div>
        <ul class="container-nav">
            <li><a href="index.php">Início</a></li>
            <li><a href="agend.html" class="btn-nav">Novo Agendamento</a></li>
            <li><a href="sair.php" class="btn-nav btn-sair">Sair</a></li>
        </ul>
    </header>

    <main class="container-section">
        <div class="conteudo">
            <h1>Meus Agendamentos</h1>

            <?php if (empty($agendamentos)): ?>
                <p>Você ainda não possui agendamentos.</p>
                <p><a href="agend.html" class="btn-agendar">Fazer um Agendamento</a></p>
            <?php else: ?>
                <?php foreach ($agendamentos as $agendamento): ?>
                    <article class="artigo">
                        <h3><?= htmlspecialchars($agendamento['servico']) ?></h3>
                        <p><strong>Data e horário:</strong> <?= htmlspecialchars($agendamento['horario']) ?></p>
                        <p><strong>Paciente:</strong> <?= htmlspecialchars($agendamento['nome'] . ' ' . $agendamento['sobrenome']) ?></p>
                        <p><strong>Telefone:</strong> <?= htmlspecialchars($agendamento['telefone']) ?></p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
