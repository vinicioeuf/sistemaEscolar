<?php
session_start();
require("conexao.php");
if ((!isset($_SESSION['num_matricula']) == true) and (!isset($_SESSION['senha']) == true)) { // Ele verifica se não há uma sessão com as credenciais num_matricula e senha, se não houver ele destrói a sessão.
    unset($_SESSION['num_matricula']);
    unset($_SESSION['senha']);
    header("Location: index.php");
}
$ids = $_SESSION['id'];
$logado = $_SESSION['num_matricula']; // Caso haja uma sessão, o matricula do usuário é armazenado
$con = Conexao::getInstance();

$y = "SELECT * FROM turmas";
$o = $con->query($y);

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
    <link rel="stylesheet" href="styles/professores.css">

</head>

<body>
    <?php include_once("main_top.php"); ?>

    <div class="main-adm">
        <h1>Início > Administração > Turmas</h1>
        <button type="button" class=" button-prof" data-bs-toggle="modal" data-bs-target="#exampleModalNovoProfessor">Nova Turma</button>
        <div class="main-prof">
            <?php
            while ($p = $o->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="prof-exemple">
                    <h1><?php echo $p["nome"] ?></h1>
                    <h2><?php echo $p["professor"] ?></h2>
                    <h5><?php echo $p["turno"] ?></h5>
                    <button type="button" class=" button-det" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $p["id"] ?>">Detalhar</button>
                </div>

                <!-- Modal Detalhar -->
                <div class="modal fade" id="exampleModal<?php echo $p["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $p["id"] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel<?php echo $p["id"] ?>">Turma:<?php echo $p["nome"] ?> </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Professor(a):<?php echo $p["professor"] ?></h4>
                                <br>
                                
                                <h5>Alunos:</h5>
                                <ul class="list-group">
                                    <?php
                                    $turmaID = $p['id'];
                                    $sqlAlunos = "SELECT * FROM alunos WHERE turma_id = :turmaID";
                                    $stmt = $con->prepare($sqlAlunos);
                                    $stmt->bindParam(':turmaID', $turmaID, PDO::PARAM_INT);
                                    $stmt->execute();

                                    while ($aluno = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <li style="border: 0;" class="list-group-item d-flex align-items-center">
                                            <img src="<?php echo $aluno['foto']; ?>" alt="Foto de <?php echo $aluno['nome']; ?>" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1"><?php echo $aluno['nome']; ?></h5>
                                                <small class="text-muted"><?php echo $aluno['idade']; ?></small>
                                            </div>
                                            <a style="color: orangered;" href="lancarNotas.php" class="btn btn-link">Ver Perfil</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>
   
    </div>
    </div>
    <!-- Modal Criar Turma -->
    <div class="modal fade" id="exampleModalNovoProfessor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Turma</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
                    require_once("conexao.php");

                    $sqlProf = "SELECT * FROM professores";
                    $buscaProf = $con->query($sqlProf);
                    ?>
                    <form method="POST" action="validaTurma.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="professor" class="form-label">Escolher professor:</label>
                            <select name="professor" class="form-select" id="professor" required>
                                <option value="" selected disabled>Escolher professor</option>
                                <?php
                                while ($professores = $buscaProf->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?php echo $professores["nome"]; ?>"><?php echo $professores["nome"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="turno" class="form-label">Turno:</label>
                            <select name="turno" class="form-select" id="turno" required>
                                <option value="Matutino">Matutino</option>
                                <option value="Vespertino">Vespertino</option>
                                <option value="Noturno">Noturno</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="totalAulas" class="form-label">Total de aulas:</label>
                            <input type="number" class="form-control" id="idade" name="totalAulas" required>
                        </div>
                        <button type="submit" class="button-det">Salvar</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>