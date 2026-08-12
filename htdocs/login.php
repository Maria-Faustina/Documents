<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$redirect = $_POST['redirect'] ?? '';

try {
    $stmt = $pdo->prepare("SELECT id, password, email FROM cadastro WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario || $senha !== $usuario['password']) {
        echo "<script>alert('Email ou senha incorretos!'); window.location.href='login.html';</script>";
        exit;
    }

    // Cria uma nova sessão somente depois de validar o usuário.
    session_regenerate_id(true);
    $_SESSION['usuario_id'] = (int) $usuario['id'];
    $_SESSION['usuario_email'] = $usuario['email'];

    // Confirma que a sessão foi criada antes de redirecionar.
    session_write_close();

    // Se o usuário veio do botão Agendar, volta para o formulário.
    if ($redirect === 'agend.html' || $redirect === 'agend.php') {
        header('Location: agend.html');
    } else {
        header('Location: index.php');
    }
    exit;
} catch (PDOException $e) {
    echo "Erro no login: " . htmlspecialchars($e->getMessage());
    exit;
}
?>
