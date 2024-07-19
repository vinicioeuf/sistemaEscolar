<?php

include "conexao.php";

try {
    $con = Conexao::getInstance();

    if (isset($_POST['matricula']) && isset($_POST['senha'])) {
        $matricula = trim($_POST['matricula']);
        $senha = trim($_POST['senha']);

        // Consulta o banco de dados para obter a senha armazenada
        $query = "SELECT senha FROM alunos WHERE matricula = :matricula";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $senhaArmazenada = $resultado['senha'];

            // Debug
            echo "Senha Inserida: " . htmlspecialchars($senha) . "<br>";
            echo "Senha Armazenada: " . htmlspecialchars($senhaArmazenada) . "<br>";

            if (password_verify($senha, $senhaArmazenada)) {
                // Senha correta, usuário autenticado
                Header("Location: boletim.php");
                exit();
            } else {
                // Senha incorreta
                echo "matricula ou senha incorretos.";
            }
        } else {
            // Usuário não encontrado
            echo "matricula ou senha incorretos.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}

?>
