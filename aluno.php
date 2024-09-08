<?php
session_start();
require("conexao.php");

if((!isset($_SESSION['num_matricula']) == true) and (!isset($_SESSION['senha']) == true)) {
    // Se não houver sessão ativa, redireciona para a página de login
    unset($_SESSION['num_matricula']);
    unset($_SESSION['senha']);
    header("Location: index.php");
    exit(); // Importante para evitar que o script continue executando após o redirecionamento
}

$ids = $_SESSION['id'];
$logado = $_SESSION['num_matricula'];

$con = Conexao::getInstance();

// Verifica se o usuário é um professor
$queryProfessor = "SELECT * FROM professores WHERE id = :id";
$stmtProfessor = $con->prepare($queryProfessor);
$stmtProfessor->bindParam(':id', $ids, PDO::PARAM_INT);
$stmtProfessor->execute();

if($stmtProfessor->rowCount() > 0) {
    // O usuário é um professor
    $usuario = $stmtProfessor->fetch(PDO::FETCH_ASSOC);
    $tipoUsuario = 'professor';
} else {
    // Se não encontrou na tabela de professores, verifica na tabela de alunos
    $queryAluno = "SELECT * FROM alunos WHERE id = :id";
    $stmtAluno = $con->prepare($queryAluno);
    $stmtAluno->bindParam(':id', $ids, PDO::PARAM_INT);
    $stmtAluno->execute();

    if($stmtAluno->rowCount() > 0) {
        // O usuário é um aluno
        $usuario = $stmtAluno->fetch(PDO::FETCH_ASSOC);
        $tipoUsuario = 'aluno';
    } else {
        // Se não encontrou em nenhuma tabela, redireciona para a página de login
        unset($_SESSION['num_matricula']);
        unset($_SESSION['senha']);
        header("Location: index.php");
        exit();
    }
}

// Agora, $usuario contém os dados do usuário logado e $tipoUsuario indica se é 'professor' ou 'aluno'
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
    <link rel="stylesheet" href="styles/aluno.css">
</head>
<body>
    <?php include_once("main_top.php"); ?>

    <div class="main-aluno">
        <h1>Início > <?php echo ucfirst($tipoUsuario); ?></h1>
        <div class="aluno-profile">
            <div class="aluno-foto">
                <img src="<?php echo $usuario['foto']; ?>" alt="">
                <h1><?php echo $usuario['nome']; ?></h1>
                <!-- Adicione outras informações do perfil aqui -->
            </div>
            <div class="aluno-info">
                <ul>
                    <li><strong>Nome Completo: </strong><span><?php echo $usuario['nome']; ?></span></li>
                    <li><strong>Turma: </strong><span><?php echo $usuario['turma']; ?></span></li>
                    <li><strong>Idade: </strong><span><?php echo $usuario['idade']; ?></span></li>
                    <li><strong>Nº Matrícula: </strong><span><?php echo $usuario['num_matricula']; ?></span></li>
                    <li><strong>E-mail: </strong><span><?php echo $usuario['email']; ?></span></li>
                    <li><strong>Ingresso: </strong><span><?php echo $usuario['data_ingresso']; ?></span></li>
                </ul>
            </div>
        </div>
        <div class="aluno-actions">
            <a href="boletim.php"><button><i class="bi bi-journal-text"></i> Boletim</button></a>
        </div>
    </div>
    
</body>
</html>
