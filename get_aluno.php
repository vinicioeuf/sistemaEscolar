<?php
require "conexao.php";

if (isset($_GET['id']) && isset($_GET['disciplina'])) {
    $id = $_GET['id'];
    $disciplina = $_GET['disciplina'];
    
    $con = Conexao::getInstance();
    $sql = "SELECT * FROM notas WHERE aluno_ref = :id AND disciplina = :disciplina";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':disciplina', $disciplina);
    $stmt->execute();
    
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Retorna os dados em formato JSON
    echo json_encode($aluno);
} else {
    echo json_encode([]);
}
?>
