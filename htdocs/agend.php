<?php
session_start();
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = ($_POST['nome']);
    $sobrenome = ($_POST['sobrenome']);
    $servico = ($_POST['servico']);
    $horario = ($_POST['horario']);
    $telefone = $_POST['telefone'];
    $CPF = trim($_POST['CPF'] ?? '');
    ;
try{
    $sql = "INSERT INTO agendamento (nome, sobrenome, telefone, horario, CPF, servico) 
    VALUES (:nome, :sobrenome, :servico, :horario, :telefone, :CPF)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([ ':nome' => $nome, 
                ':sobrenome' => $sobrenome, 
                ':servico' => $servico, 
                ':horario' => $horario, 
                ':telefone' => $telefone, 
                ':CPF' => $CPF ]);

    if ($stmt->execute()) {
            echo "<script>alert('Agendamento Realizado com sucesso!'); window.location.href='index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Erro no agedamento! Tente novamente.'); window.history.back();</script>";
        }

    } catch (PDOException $e) {
        echo "Erro no registo: " . $e->getMessage();
    }
    }
?>