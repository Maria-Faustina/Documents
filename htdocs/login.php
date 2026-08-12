<?php
session_start();
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $redirect = $_POST['redirect'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT id, password, email FROM cadastro WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if ($senha === $usuario['password']) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_email'] = $usuario['email'];

                if ($redirect === 'agend.php') {
                    header("Location: agend.html");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                echo "<script>alert('A Senha está incorreta!'); window.location.href='login.html';</script>";
            }
        } else {
            echo "<script>alert('Este email não está registado!'); window.location.href='login.html';</script>";
        }
    } catch (PDOException $e) {
        echo "Erro no login: " . $e->getMessage();
    }
}
?>
