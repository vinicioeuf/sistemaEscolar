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

$y = "SELECT * FROM disciplinas";
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
        <h1>Início > Administração > Disciplinas</h1>
        <button type="button" class=" button-prof" data-bs-toggle="modal" data-bs-target="#exampleModalNovoTurma">Nova Disciplina</button>
        <div class="main-prof">
            <?php
            while ($p = $o->fetch(PDO::FETCH_ASSOC)) {
                $turmaRef = $p['turma_ref'];
                $z = "SELECT * FROM turmas WHERE id= $turmaRef LIMIT 1";
                $a = $con->query($z);
            ?>

                <div class="prof-exemple">
                    <h1><?php echo $p["nome"] ?></h1>
                    <h2><?php echo $p["ano"] ?></h2>
                    <?php
                    while ($quer = $a->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <h2><?php echo $quer["nome"] ?></h2>
                    <?php } ?>

                </div>

            <?php } ?>
        </div>

    </div>
    </div>
    <!-- Modal Criar Turma -->
    <div class="modal fade" id="exampleModalNovoTurma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Disciplina</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    require_once("conexao.php");

                    $sqlProf = "SELECT * FROM turmas";
                    $buscaTurma = $con->query($sqlProf);

                    ?>
                    <form method="POST" action="validaDisciplina.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="turmaRef" class="form-label">Nome:</label>
                            <select name="turmaRef" class="form-select" id="turmaRef" required>
                                <option value="" selected disabled>Escolher Turma:</option>
                                <?php
                                while ($turma = $buscaTurma->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?php echo $turma["id"]; ?>"><?php echo $turma["nome"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <select name="nome" class="form-select" id="nome" required>
                                <option value="Língua Portugesa">Língua Portuguesa</option>
                                <option value="Matemática">Matemática</option>
                                <option value="Espanhol">Espanhol</option>
                                <option value="História">História</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="totalAulas" class="form-label">Total de aulas:</label>
                            <input type="number" class="form-control" id="totalAulas" name="totalAulas" required>
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