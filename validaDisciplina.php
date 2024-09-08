<?php
session_start();
include "conexao.php";


try {
    $con = Conexao::getInstance();
    $nome = addslashes($_POST['nome']);
    $turma_ref = addslashes($_POST['turmaRef']);
    $totalAulas = addslashes($_POST['totalAulas']);
    $ano = date("Y");
    $query = "INSERT INTO disciplinas (nome, turma_ref, totalAulas, ano) VALUES (:nome, :turma_ref,  :totalAulas, :ano)";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':turma_ref', $turma_ref);
    $stmt->bindParam(':totalAulas', $totalAulas);
    $stmt->bindParam(':ano', $ano);
    $stmt->execute();



    header('Location: disciplinas.php');
    exit();
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}
