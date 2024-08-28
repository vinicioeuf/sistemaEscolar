<?php
session_start(); // Inicie a sessão

require("conexao.php");
$con = Conexao::getInstance(); // Supondo que isso retorne uma instância PDO

// Receba os dados do formulário
$num_matricula = $_POST['num_matricula'];
$senha = addslashes($_POST['senha']);

try {
    // Prepare a consulta para buscar o usuário pelo número de matrícula
    $sql = "SELECT id, credencial, senha FROM professores WHERE num_matricula = :num_matricula";
    $stmt = $con->prepare($sql);
    
    // Bind do parâmetro
    $stmt->bindParam(':num_matricula', $num_matricula, PDO::PARAM_STR);
    
    // Execute a consulta
    $stmt->execute();
    
    // Verifique se algum usuário foi encontrado
    if ($stmt->rowCount() > 0) {
        // Usuário encontrado
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifique a senha
        if (password_verify($senha, $user['senha'])) {
            // Senha correta, armazene as informações na sessão
            $_SESSION['id'] = $user['id'];
            $_SESSION['credencial'] = $user['credencial'];
            $_SESSION['num_matricula'] = $num_matricula;
            $_SESSION['nome'] = $user['nome'];
            // Redirecione para a página boletim.php
            header("Location: boletim.php");
            exit();
        } else {
            // Senha incorreta
            echo "Senha incorreta.";
        }
    } else {
        // Usuário não encontrado na tabela professores
        echo "Usuário não encontrado na tabela professores.";
        
        // Consulta à tabela alunos
        $sql2 = "SELECT id, credencial, senha FROM alunos WHERE num_matricula = :num_matricula";
        $stmt2 = $con->prepare($sql2);
        
        // Bind do parâmetro
        $stmt2->bindParam(':num_matricula', $num_matricula, PDO::PARAM_STR);
        
        // Execute a consulta
        $stmt2->execute();
        if ($stmt2->rowCount() > 0) {
            // Usuário encontrado
            $user2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            
            // Verifique a senha
            if (password_verify($senha, $user2['senha'])) {
                // Senha correta, armazene as informações na sessão
                $_SESSION['id'] = $user2['id'];
                $_SESSION['credencial'] = $user2['credencial'];
                $_SESSION['num_matricula'] = $num_matricula;
                $_SESSION['nome'] = $user2['nome'];
                // Redirecione para a página boletim.php
                header("Location: boletim.php");
                
                exit();
            } else {
                // Senha incorreta
                echo "Senha incorreta.";
            }
        } else {
            echo "<br>Usuário não encontrado na tabela alunos.";
        }
    }
} catch (PDOException $e) {
    // Exiba erro em caso de falha na conexão ou consulta
    echo "Erro: " . $e->getMessage();
}

// Feche a conexão
$con = null;
?>
