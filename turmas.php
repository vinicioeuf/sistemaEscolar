<?php
     require("conexao.php");

     $con = Conexao::getInstance();
     $sql = "SELECT * FROM turmas";
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
        <a class="button-all" href="criarTurma.php">Criar Turma</a>
        <div class="div-turmas">
        <?php  while($turma = $busca->fetch(PDO::FETCH_ASSOC)){$ano = date('Y', strtotime($turma['criacao']));?>
            <div class="turma-exemple">
                <h1>3º Ano A<?php  echo $turma["nome"];?></h1>
                <h2>Manhã <?php  echo $turma["turno"];?></h2>
                <ul>
                    <li><span>Ano:</span><span>2024<?php  echo $ano;?></span></li>
                    <li><span>N Alunos:</span><span>22<?php  echo $turma["qntalunos"];?></span></li>
                    <li><span>Professor :</span><span>Francenila<?php  echo $turma["professor"];?></span></li>
                    <?php  }?>
                </ul>
                <a href="">Detalhar</a>
            </div>
        </div>
    </div>
    
</body>

</html>
