<?php
session_start();
require("conexao.php");

// Verificação da sessão
if ((!isset($_SESSION['num_matricula']) == true) && (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['num_matricula']);
    unset($_SESSION['senha']);
    header("Location: index.php");
}
$ids = $_SESSION['id'];
$logado = $_SESSION['num_matricula'];
$con = Conexao::getInstance();

// Consulta SQL
$sql = "SELECT 
            t.id AS codigo, 
            t.nome AS turma, 
            n.disciplina, 
            n.situacao, 
            t.totalaulas, 
            ROUND(((t.totalaulas - t.faltas) / t.totalaulas) * 100, 2) AS frequencia
        FROM 
            turmas t
        JOIN 
            notas n ON t.nome = n.turma_ref
        WHERE 
            n.aluno_ref = :aluno_id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':aluno_id', $ids, PDO::PARAM_INT);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>- ITIF: Instituto de Tecnologia e Inovação FuturoTech</title>
    <link rel="stylesheet" href="styles/faltas.css">
</head>

<body>
    <?php include_once("main_top.php"); ?>

    <div class="main-faltas">

        <h1>Início > Minhas Faltas</h1>
        <div class="main-actions">

            <div class="main-avisos">

                <div class="aviso">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>Caso conste <strong>REPROVADO</strong> e a frequência seja maior ou igual 75%, verifique se sua MF em <a href="boletim.php">Boletim</a> na disciplina em questão foi menor que 70.</span>
                </div>
                <div class="aviso">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>Caso obtiver frequência menor que 75%, está automaticamente <strong>REPROVADO</strong> na disciplina em questão.</span>
                </div>

            </div>

        </div>

    </div>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Turma</th>
                <th>Disciplina</th>
                <th>Situação</th>
                <th>Total De Aulas</th>
                <th>Frequência</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $row): ?>
                <tr>
                    <td data-label="Código"><?php echo $row['codigo']; ?></td>
                    <td data-label="Turma"><?php echo $row['turma']; ?></td>
                    <td data-label="Disciplina"><?php echo $row['disciplina']; ?></td>
                    <td data-label="Situação"><?php echo $row['situacao']; ?></td>
                    <td data-label="Total De Aulas"><?php echo $row['totalaulas']; ?></td>
                    <td data-label="Frequência"><?php echo $row['frequencia'] . '%'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="scripts/boletim.js"></script>
</body>

</html>
