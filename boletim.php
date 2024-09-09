<?php
session_start();
require("conexao.php");

// error_reporting(0);

  if((!isset($_SESSION['num_matricula']) == true) and (!isset($_SESSION['senha']) == true)){// Ele verifica se não há uma sessão com as credenciais num_matricula e senha, se não houver ele destrói a sessão.
      unset($_SESSION['num_matricula']);
      unset($_SESSION['senha']);
      header("Location: index.php");
  }
  $ids = $_SESSION['id'];
    $logado = $_SESSION['num_matricula'];// Caso haja uma sessão, o matricula do usuário é armazenado
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

                

                <div id="selectors">
                    <label for="discipline-select">Disciplina:</label>
                    <select id="discipline-select" onchange="showRow(this.value)">
                        <option value="001">Língua Portuguesa</option>
                        <option value="002">Matemática</option>
                        <option value="003">Geografia</option>
                    </select>
                </div>

            </div>

            

        </div>


    </div>

    <?php
        if($_SESSION['credencial'] == 0){
            
        $aprovacao2 = "SELECT * FROM notas WHERE aluno_ref='".$_SESSION['num_matricula']."'";
        $results2 = $con->query($aprovacao2);                                    
        
    ?>
    <table>
        <thead>
            <tr>
                <th>Código</th>
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
        <?php if ($results2->rowCount() > 0) { ?>
    <?php while ($ver2 = $results2->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr data-code="001">
            <td data-label="Código"><?php echo $ver2['id'] ?></td>
            <td data-label="Disciplina"><?php echo isset($ver2['disciplina']) ? $ver2['disciplina'] : '-'; ?></td>
            <td data-label="Situação"><?php echo isset($ver2['situacao']) ? $ver2['situacao'] : '-'; ?></td>
            <td data-label="AV1"><?php echo isset($ver2['b1']) ? $ver2['b1'] : '-'; ?></td>
            <td data-label="R1"><?php echo isset($ver2['r1']) ? $ver2['r1'] : '-'; ?></td>
            <td data-label="AV2"><?php echo isset($ver2['b2']) ? $ver2['b2'] : '-'; ?></td>
            <td data-label="R2"><?php echo isset($ver2['r2']) ? $ver2['r2'] : '-'; ?></td>
            <td data-label="AV3"><?php echo isset($ver2['b3']) ? $ver2['b3'] : '-'; ?></td>
            <td data-label="R3"><?php echo isset($ver2['r3']) ? $ver2['r3'] : '-'; ?></td>
            <td data-label="AV4"><?php echo isset($ver2['b4']) ? $ver2['b4'] : '-'; ?></td>
            <td data-label="R4"><?php echo isset($ver2['r4']) ? $ver2['r4'] : '-'; ?></td>
            <td data-label="RF"><?php echo isset($ver2['final']) ? $ver2['final'] : '-'; ?></td>
            <td data-label="MF"><?php echo isset($ver2['media_final']) ? $ver2['media_final'] : '-'; ?></td>
        </tr>
    <?php } ?>
<?php } 
?>


        </tbody>
    </table>
<?php }
    
    ?>
    
        
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta2/js/bootstrap.min.js"></script>

                </td>
            </tr>

        </tbody>
    </table>
    
    <script src="scripts/boletim.js"></script>
</body>

</html>