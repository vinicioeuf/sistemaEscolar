<?php
session_start();
require_once("conexao.php");

    $con = Conexao::getInstance();
    $prof =  $_SESSION['nome'];
    
    $sql = "SELECT * FROM turmas WHERE professor = '".$prof."'";
    $busca = $con->query($sql);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>- ITIF: Instituto de Tecnologia e Inovação FuturoTech</title>
    <link rel="stylesheet" href="styles/turmas.css">
</head>

<body>
    <?php include_once("main_top.php"); ?>

    <div class="main-turmas">
    <h1>Início > Minhas Turmas</h1>
    <div class="div-turmas">
        <?php while ($turma = $busca->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="turma-exemple">
                <h1><?php echo $turma["nome"]; ?></h1>
                <h2><?php echo $turma["turno"]; ?></h2>
                <a href="lancarNotas.php?id=<?php echo $turma['nome']; ?>"><button type="button" class="button-prof fs-5">Ver Alunos</button></a>
            </div>
        <?php } ?>
    </div>
</div>


    

</body>

</html>


