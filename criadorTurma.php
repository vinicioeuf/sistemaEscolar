<?php

include "conexao.php";

try {
    // Cria uma instância de conexão
    $con = Conexao::getInstance();
    
    // Coleta os dados do formulário e aplica addslashes para evitar injeção de SQL
    $nome = addslashes($_POST['nome']);
    $professor = addslashes($_POST['professor']);
    $qntAlunos = addslashes($_POST['qntalunos']);
    $turno = addslashes($_POST['turno']);
    $qntAprovados = addslashes($_POST['qntaprovados']);
    $qntReprovados = addslashes($_POST['qntreprovados']);
    
    // Cria a consulta SQL para inserir os dados na tabela "turmas"
    $query = "INSERT INTO turmas (nome, professor, qntalunos, qntaprovados, qntreprovados, turno, criacao) VALUES (:nome, :professor, :qntalunos, :qntaprovados, :qntreprovados, :turno, NOW())";
    
    // Prepara a consulta
    $stmt = $con->prepare($query);
    
    // Vincula os parâmetros da consulta aos valores coletados do formulário
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':professor', $professor);
    $stmt->bindParam(':qntalunos', $qntAlunos);
    $stmt->bindParam(':qntaprovados', $qntAprovados);
    $stmt->bindParam(':qntreprovados', $qntReprovados);
    $stmt->bindParam(':turno', $turno);
    
    // Executa a consulta
    $stmt->execute();
    
    // Exibe uma mensagem de sucesso
    echo "Turma criada com sucesso!";

    header("Location: turmas.php");
} catch (PDOException $e) {
    // Exibe uma mensagem de erro se a execução falhar
    echo 'Erro: ' . $e->getMessage();
}
?>
