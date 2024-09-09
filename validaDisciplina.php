<?php
session_start();
include "conexao.php";


try {
    $con = Conexao::getInstance();
    $nome = addslashes($_POST['nome']);
    
    $query = "INSERT INTO disciplinas (nome) VALUES (:nome)";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->execute();



    header('Location: disciplinas.php');
    exit();
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}
