<?php

include "conexao.php";

try {
    // Cria uma instância de conexão
    $con = Conexao::getInstance();
    
    // Coleta os dados do formulário e aplica addslashes para evitar injeção de SQL
    $turma = addslashes($_POST['turma']);
    $disciplina = addslashes($_POST['disciplina']);
    $b1 = addslashes($_POST['b1']);
    $b2 = addslashes($_POST['b2']);
    $b3 = addslashes($_POST['b3']);
    $b4 = addslashes($_POST['b4']);
    $r1 = addslashes($_POST['r1']);
    $r2 = addslashes($_POST['r2']);
    $r3 = addslashes($_POST['r3']);
    $r4 = addslashes($_POST['r4']);
    $rf = addslashes($_POST['rf']);
    $mf = addslashes($_POST['mf']);
    $situacao = addslashes($_POST['situacao']);
    $id_aluno = addslashes($_POST['id_aluno']);
    
    // Cria a consulta SQL para inserir os dados na tabela "turmas"
    $query = "INSERT INTO notas (turma, disciplina, b1, b2, b3, b4, r1, r2, r3, r4, rf, mf, situacao, id_aluno) VALUES (:turma, :disciplina, :b1, :b2, :b3, :b4, :r1, :r2, :r3, :r4, :rf, :mf, :situacao, :id_aluno)";
    
    // Prepara a consulta
    $stmt = $con->prepare($query);
    
    // Vincula os parâmetros da consulta aos valores coletados do formulário
    $stmt->bindParam(':turma', $turma);
    $stmt->bindParam(':disciplina', $disciplina);
    $stmt->bindParam(':b1', $b1);
    $stmt->bindParam(':b2', $b2);
    $stmt->bindParam(':b3', $b3);
    $stmt->bindParam(':b4', $b4);
    $stmt->bindParam(':r1', $r1);
    $stmt->bindParam(':r2', $r2);
    $stmt->bindParam(':r3', $r3);
    $stmt->bindParam(':r4', $r4);
    $stmt->bindParam(':rf', $rf);
    $stmt->bindParam(':mf', $mf);
    $stmt->bindParam(':situacao', $situacao);
    $stmt->bindParam(':id_aluno', $id_aluno);
    
    // Executa a consulta
    $stmt->execute();
    
    // Exibe uma mensagem de sucesso
    echo "Turma criada com sucesso!";

    header("Location: boletim.php");
} catch (PDOException $e) {
    // Exibe uma mensagem de erro se a execução falhar
    echo 'Erro: ' . $e->getMessage();
}
?>
