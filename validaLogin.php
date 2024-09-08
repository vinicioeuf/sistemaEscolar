<?php
session_start(); // Inicie a sessão

require("conexao.php");
$con = Conexao::getInstance(); // Supondo que isso retorne uma instância PDO

// Receba os dados do formulário
$num_matricula = $_POST['num_matricula'];
$senha = addslashes($_POST['senha']);

try {
    // Prepare uma consulta para buscar o usuário nas tabelas correspondentes
    $sql = "SELECT id, credencial, senha, nome, foto FROM professores WHERE num_matricula = :num_matricula
            UNION
            SELECT id, credencial, senha, nome, foto FROM alunos WHERE num_matricula = :num_matricula
            UNION
            SELECT id, credencial, senha, nome, foto FROM adms WHERE num_matricula = :num_matricula";
    
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
            $_SESSION['foto'] = $user['foto'];
            // Redirecione para a página home.php
            header("Location: home.php");
            exit();
        } else {
            // Senha incorreta
            echo "Senha incorreta.";
        }
    } else {
        // Nenhum usuário encontrado
        echo "Número de matrícula não encontrado.";
    }
} catch (PDOException $e) {
    // Exiba erro em caso de falha na conexão ou consulta
    echo "Erro: " . $e->getMessage();
}

// Feche a conexão
$con = null;
?>
