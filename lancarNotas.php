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
        <h1>Início > Minhas Turmas > Alunos </h1>
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
                <?php
                $sqlDisc = "SELECT * FROM disciplinas";
                $buscaDisc = $con->query($sqlDisc);
                while ($i = $buscaDisc->fetch(PDO::FETCH_ASSOC)) {?>

                    <option value="<?php echo $i['nome']?>"><?php echo $i['nome']?></option>
                <?php } ?>
                    
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
                <input type="text" name="media_final" disabled id="media_final" class="form-control">
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
                document.getElementById('situacao').value = data.situacao || '';
                document.getElementById('faltas').value = data.faltas || '';
                calcularMediaFinal(); // Calcula a média final após carregar os dados
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
                document.getElementById('situacao').value = data.situacao || '';
                document.getElementById('faltas').value = data.faltas || '';
                calcularMediaFinal(); // Calcula a média final após carregar os dados
            })
            .catch(error => console.error('Erro:', error));
    }
});

// Função para calcular a média final e aplicar as regras de bloqueio/desbloqueio
function calcularMediaFinal() {
    const b1 = parseFloat(document.getElementById('b1').value) || 0;
    const b2 = parseFloat(document.getElementById('b2').value) || 0;
    const b3 = parseFloat(document.getElementById('b3').value) || 0;
    const b4 = parseFloat(document.getElementById('b4').value) || 0;
    const r1 = parseFloat(document.getElementById('r1').value) || 0;
    const r2 = parseFloat(document.getElementById('r2').value) || 0;
    const r3 = parseFloat(document.getElementById('r3').value) || 0;
    const r4 = parseFloat(document.getElementById('r4').value) || 0;
    const finalRecuperacao = parseFloat(document.getElementById('final').value) || 0;

    // Calcula a nota a ser considerada em cada bimestre
    const nota1 = b1 >= 6 ? b1 : Math.max(b1, r1);
    const nota2 = b2 >= 6 ? b2 : Math.max(b2, r2);
    const nota3 = b3 >= 6 ? b3 : Math.max(b3, r3);
    const nota4 = b4 >= 6 ? b4 : Math.max(b4, r4);

    // Calcula a média final
    let mediaFinal = (nota1 + nota2 + nota3 + nota4) / 4;

    // Se o valor do input final de recuperação estiver preenchido, substitui a média final
    if (finalRecuperacao > 0) {
        mediaFinal = finalRecuperacao;
    }

    // Atualiza o input da média final (sempre bloqueado)
    document.getElementById('media_final').value = mediaFinal.toFixed(2);

    // Bloqueia ou desbloqueia os inputs de recuperação conforme as notas
    document.getElementById('r1').disabled = b1 >= 6;
    document.getElementById('r2').disabled = b2 >= 6;
    document.getElementById('r3').disabled = b3 >= 6;
    document.getElementById('r4').disabled = b4 >= 6;

    // Desbloqueia o input da recuperação final se a média for menor que 6
    document.getElementById('final').disabled = mediaFinal >= 6;
}

// Monitora mudanças nas notas para recalcular a média
document.querySelectorAll('#b1, #b2, #b3, #b4, #r1, #r2, #r3, #r4, #final').forEach(input => {
    input.addEventListener('input', calcularMediaFinal);
});

</script>

    </div>
</body>

</html>
