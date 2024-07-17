<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>- ITIF: Instituto de Tecnologia e Inovação FuturoTech</title>
    <link rel="stylesheet" href="styles/boletim.css">
</head>

<body>
    <?php include_once("main_top.php"); ?>

    <div class="main-boletim">

        <h1>Início > Meu boletim</h1>
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
                    <span>Verifique a porcentagem de faltas em cada disciplina. Caso obtiver frequência menor que 75%, está automaticamente <strong>REPROVADO </strong></span>
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
                <th>AV1</th>
                <th>R1</th>
                <th>AV2</th>
                <th>R2</th>
                <th>AV3</th>
                <th>R3</th>
                <th>AV4</th>
                <th>R4</th>
                <th>RF</th>
                <th>MF</th>
            </tr>
        </thead>
        <tbody>
            <tr data-code="001">
                <td data-label="Código">001</td>
                <td data-label="Turma">3 ANO, A</td>
                <td data-label="Disciplina">Língua Portuguesa</td>
                <td data-label="Situação">Em andamento</td>
                <td data-label="AV1">7.0</td>
                <td data-label="R1">9.0</td>
                <td data-label="AV2">7.0</td>
                <td data-label="R2">9.0</td>
                <td data-label="AV3">7.0</td>
                <td data-label="R3">9.0</td>
                <td data-label="AV4">7.0</td>
                <td data-label="R4">9.0</td>
                <td data-label="RF">8.0</td>
                <td data-label="MF">7.8</td>
            </tr>
            <tr data-code="002">
                <td data-label="Código">002</td>
                <td data-label="Turma">3 ANO, A</td>
                <td data-label="Disciplina">Matemática</td>
                <td data-label="Situação">Em andamento</td>
                <td data-label="AV1">7.0</td>
                <td data-label="R1">9.0</td>
                <td data-label="AV2">7.0</td>
                <td data-label="R2">9.0</td>
                <td data-label="AV3">7.0</td>
                <td data-label="R3">9.0</td>
                <td data-label="AV4">7.0</td>
                <td data-label="R4">9.0</td>
                <td data-label="RF">8.0</td>
                <td data-label="MF">7.8</td>
            </tr>
            <tr data-code="003">
                <td data-label="Código">003</td>
                <td data-label="Turma">3 ANO, A</td>
                <td data-label="Disciplina">Geografia</td>
                <td data-label="Situação">Em andamento</td>
                <td data-label="AV1">7.0</td>
                <td data-label="R1">9.0</td>
                <td data-label="AV2">7.0</td>
                <td data-label="R2">9.0</td>
                <td data-label="AV3">7.0</td>
                <td data-label="R3">9.0</td>
                <td data-label="AV4">7.0</td>
                <td data-label="R4">9.0</td>
                <td data-label="RF">8.0</td>
                <td data-label="MF">7.8</td>
            </tr>
        </tbody>
    </table>

    <script src="scripts/boletim.js"></script>
</body>

</html>