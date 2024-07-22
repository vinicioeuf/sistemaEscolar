<?php

include "conexao.php";

try {
    $con = Conexao::getInstance();

    if (isset($_POST['matricula']) && isset($_POST['senha'])) {
        $matricula = trim($_POST['matricula']);
        $senha = trim($_POST['senha']);

        function verificarLogin($con, $matricula, $senha, $tabela) {
            $query = "SELECT id, senha FROM $tabela WHERE matricula = :matricula";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $idUsuario = $resultado['id'];
                $senhaArmazenada = $resultado['senha'];

                echo "Senha Inserida: " . htmlspecialchars($senha) . "<br>";
                echo "Senha Armazenada: " . htmlspecialchars($senhaArmazenada) . "<br>";

                if (password_verify($senha, $senhaArmazenada)) {
                    return ['id' => $idUsuario, 'credencial' => $tabela == 'alunos' ? 0 : 1];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        $loginValido = verificarLogin($con, $matricula, $senha, 'alunos');

        if ($loginValido === false) {
            $loginValido = verificarLogin($con, $matricula, $senha, 'professores');
        }

        if ($loginValido !== false) {
            session_start();

            $_SESSION['matricula'] = $matricula;
            $_SESSION['senha'] = $senha;
            $_SESSION['credencial'] = $loginValido['credencial'];
            $_SESSION['id'] = $loginValido['id'];

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
