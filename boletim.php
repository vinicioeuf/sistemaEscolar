<?php
session_start();
require("conexao.php");

// error_reporting(0);

  if((!isset($_SESSION['matricula']) == true) and (!isset($_SESSION['senha']) == true)){// Ele verifica se não há uma sessão com as credenciais matricula e senha, se não houver ele destrói a sessão.
      unset($_SESSION['matricula']);
      unset($_SESSION['senha']);
      header("Location: index.php");
  }
    $logado = $_SESSION['matricula'];// Caso haja uma sessão, o matricula do usuário é armazenado
    $con = Conexao::getInstance();
?>

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

    <?php
        if($_SESSION['credencial'] == 0){
    ?>
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
<?php }else{
    $sql = "SELECT * FROM alunos";
    $stmt = $con->query($sql);
    
    ?>
    <table>
        <thead>
            <tr>
                <th>Cód. Aluno</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Situação</th>
                <th>Turma</th>
                <th>Nº Matricula</th>
                <th>Data de ingresso</th>
                <th>Idade</th>
                <th>Ver mais</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr data-code="<?php echo $dados['id']; ?>">
                <td data-label="Código"><?php echo $dados['id']; ?></td>
                <td data-label="Nome"><?php echo $dados['nome']; ?></td>
                <td data-label="E-mail"><?php echo $dados['email']; ?></td>
                <td data-label="Situação"><?php echo $dados['situacao']; ?></td>
                <td data-label="Turma"><?php echo $dados['turma']; ?></td>
                <td data-label="Nº Matricula"><?php echo $dados['matricula']; ?></td>
                <td data-label="Data de ingresso"><?php echo $dados['ingresso']; ?></td>
                <td data-label="Idade"><?php echo $dados['idade']; ?></td>
                <td data-label="Ver mais">
                    <button type="button" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                </td>
            </tr>

        </tbody>
    </table>
    <?php }}?>
    <script src="scripts/boletim.js"></script>
</body>

</html>