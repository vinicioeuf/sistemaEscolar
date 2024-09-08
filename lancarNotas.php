<?php
require "conexao.php";
$con = Conexao::getInstance();
$turmaref = $_GET['id'];
    $sql = "SELECT * FROM alunos WHERE turma= '$turmaref' ";
    $busca = $con->query($sql);
    

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
        <h1>Início > Administração </h1>
        <h2>Altere as notas dos alunos da turma</h2>

        <form style="width: 400px;" action="validaNota.php" method="post">
            <div class="mb-2">
                <label for="aluno_ref" class="form-label">Id do aluno:</label>
                <select name="aluno_ref" id="aluno_ref" class="form-select">
                    <option value="none" disabled selected>Selecione o aluno</option>
                    <?php while ($infor = $busca->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $infor["num_matricula"]; ?>"><?php echo $infor["nome"] . ", ID: " . $infor["id"]; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-2">
                <label for="disciplina" class="form-label">Disciplina:</label>
                <select name="disciplina" id="disciplina" class="form-select">
                    <option value="Lingua Portuguesa">Língua Portuguesa</option>
                    <option value="Matematica">Matemática</option>
                    <option value="Historia">História</option>
                    <option value="Educacao Fisica">Educação Física</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="b1" class="form-label">Nota do 1º bimestre:</label>
                <input type="text" name="b1" id="b1" class="form-control">
            </div>

            <div class="mb-2">
                <label for="b2" class="form-label">Nota do 2º bimestre:</label>
                <input type="text" name="b2" id="b2" class="form-control">
            </div>

            <div class="mb-2">
                <label for="b3" class="form-label">Nota do 3º bimestre:</label>
                <input type="text" name="b3" id="b3" class="form-control">
            </div>

            <div class="mb-2">
                <label for="b4" class="form-label">Nota do 4º bimestre:</label>
                <input type="text" name="b4" id="b4" class="form-control">
            </div>

            <div class="mb-2">
                <label for="r1" class="form-label">Nota da 1ª recuperação:</label>
                <input type="text" name="r1" id="r1" class="form-control">
            </div>

            <div class="mb-2">
                <label for="r2" class="form-label">Nota da 2ª recuperação:</label>
                <input type="text" name="r2" id="r2" class="form-control">
            </div>

            <div class="mb-2">
                <label for="r3" class="form-label">Nota da 3ª recuperação:</label>
                <input type="text" name="r3" id="r3" class="form-control">
            </div>

            <div class="mb-2">
                <label for="r4" class="form-label">Nota da 4ª recuperação:</label>
                <input type="text" name="r4" id="r4" class="form-control">
            </div>

            <div class="mb-2">
                <label for="final" class="form-label">Nota da recuperação final:</label>
                <input type="text" name="final" id="final" class="form-control">
            </div>

            <div class="mb-2">
                <label for="media_final" class="form-label">Média final:</label>
                <input type="text" name="media_final" id="media_final" class="form-control">
            </div>

            <div class="mb-2">
                <label for="situacao" class="form-label">Situação:</label>
                <select name="situacao" id="situacao" class="form-select">
                    <option value="Em andamento">Em andamento</option>
                    <option value="Curso concluido">Curso concluído</option>
                    <option value="Aprovado">Aprovado</option>
                    <option value="Reprovado">Reprovado</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="button-det">Lançar nota</button>
            </div>
            <br>
        </form>

        <script>
document.getElementById('aluno_ref').addEventListener('change', function() {
    const alunoId = this.value;
    const disciplina = document.getElementById('disciplina').value;

    if (alunoId !== 'none' && disciplina) {
        fetch('get_aluno.php?id=' + alunoId + '&disciplina=' + encodeURIComponent(disciplina))
            .then(response => response.json())
            .then(data => {
                document.getElementById('b1').value = data.b1 || '';
                document.getElementById('b2').value = data.b2 || '';
                document.getElementById('b3').value = data.b3 || '';
                document.getElementById('b4').value = data.b4 || '';
                document.getElementById('r1').value = data.r1 || '';
                document.getElementById('r2').value = data.r2 || '';
                document.getElementById('r3').value = data.r3 || '';
                document.getElementById('r4').value = data.r4 || '';
                document.getElementById('final').value = data.final || '';
                document.getElementById('media_final').value = data.media_final || '';
                document.getElementById('situacao').value = data.situacao || '';
                document.getElementById('faltas').value = data.faltas || '';
            })
            .catch(error => console.error('Erro:', error));
    }
});

// Atualiza quando a disciplina é alterada
document.getElementById('disciplina').addEventListener('change', function() {
    const alunoId = document.getElementById('aluno_ref').value;
    const disciplina = this.value;

    if (alunoId !== 'none' && disciplina) {
        fetch('get_aluno.php?id=' + alunoId + '&disciplina=' + encodeURIComponent(disciplina))
            .then(response => response.json())
            .then(data => {
                document.getElementById('b1').value = data.b1 || '';
                document.getElementById('b2').value = data.b2 || '';
                document.getElementById('b3').value = data.b3 || '';
                document.getElementById('b4').value = data.b4 || '';
                document.getElementById('r1').value = data.r1 || '';
                document.getElementById('r2').value = data.r2 || '';
                document.getElementById('r3').value = data.r3 || '';
                document.getElementById('r4').value = data.r4 || '';
                document.getElementById('final').value = data.final || '';
                document.getElementById('media_final').value = data.media_final || '';
                document.getElementById('situacao').value = data.situacao || '';
                document.getElementById('faltas').value = data.faltas || '';
            })
            .catch(error => console.error('Erro:', error));
    }
});
</script>

    </div>
</body>

</html>
