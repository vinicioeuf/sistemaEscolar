<?php
session_start();
include "conexao.php";


try {
    $con = Conexao::getInstance();
    $nome = addslashes($_POST['nome']);
    $turno = addslashes($_POST['turno']);
    $professor = addslashes($_POST['professor']);
    $totalAulas = addslashes($_POST['totalAulas']);
    $situacao = "Em andamento";
    $query = "INSERT INTO turmas (nome, turno, professor, totalAulas, situacao) VALUES (:nome, :turno, :professor, :totalAulas, :situacao)";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':turno', $turno);
    $stmt->bindParam(':professor', $professor);
    $stmt->bindParam(':totalAulas', $totalAulas);
    $stmt->bindParam(':situacao', $situacao);
    $stmt->execute();



    header('Location: turmasAdm.php');
    exit();
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}
