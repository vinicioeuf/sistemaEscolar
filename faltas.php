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
            <div class="main-selecters">

                <div>
                    <label for="ano-select">Ano:</label>
                    <select id="ano-select">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                    </select>
                </div>

                <div id="selectors">
                    <label for="discipline-select">Disciplina:</label>
                    <select id="discipline-select" onchange="showRow(this.value)">
                        <option value="001">Língua Portuguesa</option>
                        <option value="002">Matemática</option>
                        <option value="003">Geografia</option>
                    </select>
                </div>

            </div>

            <div class="main-avisos">

                <div class="aviso">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>Caso conste <strong>REPROVADO</strong> e a frequência seja maior ou igual  75%, verifique se sua MF em <a href="boletim.php">Boletim</a> na disciplina em questão foi menor que 70. </span>
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
                <th>B1</th>
                <th>B2</th>
                <th>B3</th>
                <th>B4</th>
                <th>Frequência</th>
            </tr>
        </thead>
        <tbody>
            <tr data-code="001">
                <td data-label="Código">001</td>
                <td data-label="Turma">3 ANO, A</td>
                <td data-label="Disciplina">Língua Portuguesa</td>
                <td data-label="Situação">Em andamento</td>
                <td data-label="Total De Aulas">180</td>
                <td data-label="B1">7</td>
                <td data-label="B2">9</td>
                <td data-label="B3">7</td>
                <td data-label="B4">9</td>
                <td data-label="Frequência">90%</td>
            </tr>
            <tr data-code="002">
                <td data-label="Código">002</td>
                <td data-label="Turma">3 ANO, A</td>
                <td data-label="Disciplina">Matemática</td>
                <td data-label="Situação">Em andamento</td>
                <td data-label="Total De Aulas">180</td>
                <td data-label="B1">7</td>
                <td data-label="B2">9</td>
                <td data-label="B3">7</td>
                <td data-label="B4">9</td>
                <td data-label="Frequência">90%</td>
                
            </tr>
            <tr data-code="003">
                <td data-label="Código">003</td>
                <td data-label="Turma">3 ANO, A</td>
                <td data-label="Disciplina">Geografia</td>
                <td data-label="Situação">Em andamento</td>
                <td data-label="Total De Aulas">180</td>
                <td data-label="B1">7</td>
                <td data-label="B2">9</td>
                <td data-label="B3">7</td>
                <td data-label="B4">9</td>
                <td data-label="Frequência">90%</td>
                
            </tr>
        </tbody>
    </table>

    <script src="scripts/boletim.js"></script>
</body>

</html>