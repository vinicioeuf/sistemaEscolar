<?php
session_start();
require("conexao.php");
if ((!isset($_SESSION['num_matricula']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['num_matricula']);
    unset($_SESSION['senha']);
    header("Location: index.php");
}
$ids = $_SESSION['id'];
$logado = $_SESSION['num_matricula'];
$con = Conexao::getInstance();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITIF: Instituto de Tecnologia e Inovação FuturoTech</title>
    <link rel="stylesheet" href="styles/professores.css">
</head>

<body class="bg-light">
    <?php include_once("main_top.php"); ?>

    <div class="main-adm">
        <h1>Início > Administração > Cadastrar Aluno</h1>
        <h2>Cadastre um novo aluno</h2>

        <form style="width: 80%; margin-bottom: 30px;" action="validaCadastro.php" method="post" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-white">
            <div class="mb-3">
                <label for="Nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="Nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <button style=" width: 400px; border-radius: 10px;" type="button" id="gerarmatricula" class="button-det">Gerar número de matrícula</button>
                    <input type="hidden" name="nMatricula" id="hiddenMatricula">
                </div>
                <p id="matricula" class="form-text mt-2"></p>
            </div>

            <script>
                var gerarmatricula = document.getElementById("gerarmatricula");
                var matriculaElement = document.getElementById("matricula");
                var hiddenMatricula = document.getElementById("hiddenMatricula");

                gerarmatricula.addEventListener("click", function() {
                    var prefixo = "20242";
                    var sufixo = "";
                    for (var i = 0; i < 5; i++) {
                        sufixo += Math.floor(Math.random() * 10);
                    }
                    var matricula = prefixo + sufixo;
                    matriculaElement.textContent = "Matrícula: " + matricula;
                    hiddenMatricula.value = matricula;
                });
            </script>

            <div class="mb-3">
                <label for="Ingresso" class="form-label">Ingresso:</label>
                <input type="date" name="ingresso" id="Ingresso" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="E-mail" class="form-label">E-mail:</label>
                <input type="email" name="email" id="E-mail" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Turma" class="form-label">Turma:</label>
                <select name="turma" id="Turma" class="form-select" required>
                    <option value="none" selected disabled>Escolher turma</option>
                    <?php 
                    $t = "SELECT * FROM turmas";
                    $query = $con->query($t);
                    while($turma = $query->fetch(PDO::FETCH_ASSOC)){ ?>
                        <option value="<?php echo $turma["id"]; ?>"><?php echo $turma["nome"]; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="Idade" class="form-label">Idade:</label>
                <input type="number" name="idade" id="Idade" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Foto" class="form-label">Foto:</label>
                <input type="file" name="imagem" id="Foto" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="CPF" class="form-label">CPF:</label>
                <input type="text" name="cpf" id="cpf" class="form-control" required>
                <input type="hidden" name="senha" id="senha">
            </div>
            <button type="submit" id="definirSenha" name="submit" class=" button-det">Matricular</button>

            <script>
                var definirSenha = document.getElementById("definirSenha");
                var cpfField = document.getElementById("cpf");
                var senhaField = document.getElementById("senha");
                var form = document.querySelector("form");

                definirSenha.addEventListener("click", function(event) {
                    var cpf = cpfField.value;
                    if (cpf) {
                        senhaField.value = "it." + cpf;
                    }
                    form.submit();
                });
            </script>
        </form>
    </div>
</body>

</html>
