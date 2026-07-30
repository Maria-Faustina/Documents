<?php

// Configurações do banco
$host    = "sql312.infinityfree.com";     
$usuario = "if0_42533317";      
$senha   = "jzUsfDJahNd";        
$banco   = "if0_42533317_newdent";     

// Conexão MySQLi
$conexao = mysqli_connect($host, $usuario, $senha, $banco);

try {
    // 2. Prepara a consulta SQL de forma segura
    $stmt = $pdo->prepare("SELECT id, nome, email FROM usuarios");
    
    // 3. Executa a consulta
    $stmt->execute();
    
    // 4. Busca todos os resultados
    $usuarios = $stmt->fetchAll();
    
    // 5. Exibe os dados (exemplo simples)
    foreach ($usuarios as $usuario) {
        echo "ID: " . $usuario['id'] . " - Nome: " . $usuario['nome'] . "<br>";
    }

} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
}
?>

<?php
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

echo "Conexão realizada com sucesso!";
?>