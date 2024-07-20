<?php

include "conexao.php";

try {
    $con = Conexao::getInstance();

    if (isset($_POST['matricula']) && isset($_POST['senha'])) {
        $matricula = trim($_POST['matricula']);
        $senha = trim($_POST['senha']);

        function verificarLogin($con, $matricula, $senha, $tabela) {
            $query = "SELECT senha FROM $tabela WHERE matricula = :matricula";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $senhaArmazenada = $resultado['senha'];

                echo "Senha Inserida: " . htmlspecialchars($senha) . "<br>";
                echo "Senha Armazenada: " . htmlspecialchars($senhaArmazenada) . "<br>";

                if (password_verify($senha, $senhaArmazenada)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        $loginValido = verificarLogin($con, $matricula, $senha, 'alunos');

        if (!$loginValido) {
            $loginValido = verificarLogin($con, $matricula, $senha, 'professores');
        }

        if ($loginValido) {
            Header("Location: boletim.php");
            exit();
        } else {
            echo "matricula ou senha incorretos.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}

?>
