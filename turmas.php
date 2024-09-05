<?php
session_start();
require_once("conexao.php");



$con = Conexao::getInstance();
$qr = "SELECT * FROM professores WHERE id='".$_SESSION['id']."'";
$or = $con->query($qr);                                    
$pd = $or->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM turmas WHERE professor = '".$pd['nome']."'";
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
        <button type="button" class="button-prof" data-bs-toggle="modal" data-bs-target="#exampleModalNovaTurma">Criar Turma</button>
        <div class="div-turmas">
            <?php while ($turma = $busca->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="turma-exemple">
                    <h1><?php echo $turma["nome"]; ?></h1>
                    <h2><?php echo $turma["turno"]; ?></h2>
                    <ul>
                        <li><span>N Alunos:</span><span><?php echo $turma["qntalunos"]; ?></span></li>
                    </ul>
                    <button type="button" class="button-prof" data-bs-toggle="modal" data-bs-target="#exampleModalDetalhar-<?php echo $turma['id']; ?>">Detalhar</button>
                </div>

                <!-- Modal Detalhar -->
                <div class="modal fade" id="exampleModalDetalhar-<?php echo $turma['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhes</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Professor(a)</h4>
                                <?php
                                    $y = "SELECT * FROM professores WHERE id='".$_SESSION['id']."'";
                                    $o = $con->query($y);                                    
                                    $p = $o->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <ul class="list-group">
                                    <li style="border: 0;" class="list-group-item d-flex align-items-center">
                                        <img src="<?php echo $p['foto']; ?>" alt="Foto do professor" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1"><?php echo $p['nome']; ?></h5>
                                        </div>
                                    </li>
                                </ul>
                                <br>
                                <h5>Alunos:</h5>
                                <ul class="list-group">
                                    <?php
                                    $turmaID = $turma['id'];
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="modal fade" id="exampleModalNovaTurma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Turma</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to create a new class -->
                    <?php
                    require_once("conexao.php");

                    $sqlProf = "SELECT * FROM professores";
                    $buscaProf = $con->query($sqlProf);
                    ?>

                    <form action="criadorTurma.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="Nome" class="form-label">Nome da turma:</label>
                            <input type="text" name="nome" class="form-control" id="nome" required>
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
                            <label for="qntalunos" class="form-label">Quantidade de alunos:</label>
                            <input type="number" name="qntalunos" class="form-control" id="qntalunos" required>
                        </div>

                        <div class="mb-3">
                            <label for="totalaulas" class="form-label">Carga horária total:</label>
                            <input type="number" name="totalaulas" class="form-control" id="qntalunos" required>
                        </div>

                        <button type="submit" class="btn button-all">Salvar</button>
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
