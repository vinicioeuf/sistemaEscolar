<?php
include "conexao.php";

try {
    // Cria uma instância de conexão
    $con = Conexao::getInstance();
    
    // Coleta os dados do formulário e aplica addslashes para evitar injeção de SQL
    $turma_ref = !empty($_POST['turma_ref']) ? addslashes($_POST['turma_ref']) : null;
    $disciplina = !empty($_POST['disciplina']) ? addslashes($_POST['disciplina']) : null;
    $b1 = !empty($_POST['b1']) ? addslashes($_POST['b1']) : null;
    $b2 = !empty($_POST['b2']) ? addslashes($_POST['b2']) : null;
    $b3 = !empty($_POST['b3']) ? addslashes($_POST['b3']) : null;
    $b4 = !empty($_POST['b4']) ? addslashes($_POST['b4']) : null;
    $r1 = !empty($_POST['r1']) ? addslashes($_POST['r1']) : null;
    $r2 = !empty($_POST['r2']) ? addslashes($_POST['r2']) : null;
    $r3 = !empty($_POST['r3']) ? addslashes($_POST['r3']) : null;
    $r4 = !empty($_POST['r4']) ? addslashes($_POST['r4']) : null;
    $final = !empty($_POST['final']) ? addslashes($_POST['final']) : null;
    $media_final = !empty($_POST['media_final']) ? addslashes($_POST['media_final']) : null;
    $situacao = !empty($_POST['situacao']) ? addslashes($_POST['situacao']) : null;
    $aluno_ref = !empty($_POST['aluno_ref']) ? addslashes($_POST['aluno_ref']) : null;
    $faltas = !empty($_POST['faltas']) ? addslashes($_POST['faltas']) : null;
    
    // Cria a consulta SQL para atualizar os dados na tabela "notas"
    $query = "UPDATE notas 
              SET turma_ref = :turma_ref,  
                  b1 = :b1, 
                  b2 = :b2, 
                  b3 = :b3, 
                  b4 = :b4, 
                  r1 = :r1, 
                  r2 = :r2, 
                  r3 = :r3, 
                  r4 = :r4, 
                  final = :final, 
                  media_final = :media_final, 
                  situacao = :situacao
              WHERE aluno_ref = :aluno_ref AND disciplina = :disciplina";
    
    // Prepara a consulta
    $stmt = $con->prepare($query);
    
    // Vincula os parâmetros da consulta aos valores coletados do formulário
    $stmt->bindParam(':turma_ref', $turma_ref);
    $stmt->bindParam(':disciplina', $disciplina);
    $stmt->bindParam(':b1', $b1);
    $stmt->bindParam(':b2', $b2);
    $stmt->bindParam(':b3', $b3);
    $stmt->bindParam(':b4', $b4);
    $stmt->bindParam(':r1', $r1);
    $stmt->bindParam(':r2', $r2);
    $stmt->bindParam(':r3', $r3);
    $stmt->bindParam(':r4', $r4);
    $stmt->bindParam(':final', $final);
    $stmt->bindParam(':media_final', $media_final);
    $stmt->bindParam(':situacao', $situacao);
    $stmt->bindParam(':aluno_ref', $aluno_ref);
    
    // Executa a consulta
    $stmt->execute();
    
    
    // Redireciona de volta para a página anterior
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} catch (PDOException $e) {
    // Exibe uma mensagem de erro se a execução falhar
    echo 'Erro: ' . $e->getMessage();
}
?>
