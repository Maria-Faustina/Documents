<?php
session_start();
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $c_senha = $_POST['c_senha'];

    if ($senha !== $c_senha) {
        echo "<script>alert('As senhas não coincidem!'); window.history.back();</script>";
        exit;
    }

    try {
        $checkEmail = $pdo->prepare("SELECT id FROM cadastro WHERE email = :email");
        $checkEmail->bindParam(':email', $email);
        $checkEmail->execute();

        if ($checkEmail->rowCount() > 0) {
            echo "<script>alert('Este e-mail já está em uso!'); window.history.back();</script>";
            exit;
        }
        $stmt = $pdo->prepare("INSERT INTO cadastro (email, password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $senha);
        
        if ($stmt->execute()) {
            echo "<script>alert('Conta criada com sucesso! Por favor, faça login.'); window.location.href='login.html';</script>";
            exit;
        } else {
            echo "<script>alert('Erro ao criar a conta. Tente novamente.'); window.history.back();</script>";
        }

    } catch (PDOException $e) {
        echo "Erro no registo: " . $e->getMessage();
    }
}
?>