<?php

$host    = "sql312.infinityfree.com";     
$usuario = "if0_42533317";      
$senha   = "jzUsfDJahNd";        
$banco   = "if0_42533317_newdent";

try {

    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);   
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>