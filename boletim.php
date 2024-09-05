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
            
        $aprovacao2 = "SELECT * FROM notas WHERE aluno_ref='".$_SESSION['id']."'";
        $results2 = $con->query($aprovacao2);                                    
        
    ?>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <!-- <th>Turma</th> -->
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
            <td data-label="Código"><?php echo isset($ids) ? $ids : '-'; ?></td>
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
<?php } else { ?>
    <tr data-code="001">
        <td data-label="Código">-</td>
        <td data-label="Disciplina">-</td>
        <td data-label="Situação">-</td>
        <td data-label="AV1">-</td>
        <td data-label="R1">-</td>
        <td data-label="AV2">-</td>
        <td data-label="R2">-</td>
        <td data-label="AV3">-</td>
        <td data-label="R3">-</td>
        <td data-label="AV4">-</td>
        <td data-label="R4">-</td>
        <td data-label="RF">-</td>
        <td data-label="MF">-</td>
    </tr>
<?php } ?>


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
                <!-- <th>Situação</th> -->
                <th>Turma</th>
                <th>Nº Matricula</th>
                <th>Data de ingresso</th>
                <th>Idade</th>
                <th>Ver mais</th>
            </tr>
        </thead>
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Informações do Aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Código:</strong> <span id="modalCodigo"></span></p>
                    <p><strong>Nome:</strong> <span id="modalNome"></span></p>
                    <p><strong>E-mail:</strong> <span id="modalEmail"></span></p>
                    
                    <p><strong>Turma:</strong> <span id="modalTurma"></span></p>
                    <p><strong>Nº Matricula:</strong> <span id="modalMatricula"></span></p>
                    <p><strong>Data de Ingresso:</strong> <span id="modalDataIngresso"></span></p>
                    <p><strong>Idade:</strong> <span id="modalIdade"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

        <tbody>
        <?php
            while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr data-code="<?php echo $dados['id']; ?>">
                <td data-label="Código"><?php echo "00" + $dados['id']; ?></td>
                <td data-label="Nome"><?php echo $dados['nome']; ?></td>
                <td data-label="E-mail"><?php echo $dados['email']; ?></td>
                
                <td data-label="Turma"><?php echo $dados['turma']; ?></td>
                <td data-label="Nº Matricula"><?php echo $dados['num_matricula']; ?></td>
                <td data-label="Data de ingresso"><?php echo $dados['data_ingresso']; ?></td>
                <td data-label="Idade"><?php echo $dados['idade']; ?></td>
                <td data-label="Ver mais">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#verificar<?php echo $dados['id'];?>" data-bs-whatever="<?php echo $dados['nome'];?>">
                    <i class="bi bi-search"></i>
                </button>
                <div class="modal fade" id="verificar<?php echo $dados['id'];?>" tabindex="-1" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalCentralizado"><?php echo "Aluno: ".$dados['nome'];?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <div class="modal-body">
                            <?php 
                                $aprovacao = "SELECT * FROM notas WHERE aluno_ref='".$dados['id']."'";
                                $results = $con->query($aprovacao);                                    
                                
                                ?>
                                <img src="<?php echo isset($dados['foto']) ? $dados['foto'] : 'default.png'; ?>" alt="" style="width: 300px; height: 300px;">
                                <?php 
                                while ($ver = $results->fetch(PDO::FETCH_ASSOC)){

                                
                                echo "<br>Turma: ". (isset($dados['turma']) ? $dados['turma'] : '-');
                                echo "<br>Disciplina: ". (isset($ver['disciplina']) ? $ver['disciplina'] : '-');
                                echo "<br>Nota 1: " . (isset($ver['b1']) ? $ver['b1'] : '-');
                                echo "<br>Nota 2: " . (isset($ver['b2']) ? $ver['b2'] : '-');
                                echo "<br>Nota 3: " . (isset($ver['b3']) ? $ver['b3'] : '-');
                                echo "<br>Nota 4: " . (isset($ver['b4']) ? $ver['b4'] : '-');
                                echo "<br>Recuperação 1: " . (isset($ver['r1']) ? $ver['r1'] : '-');
                                echo "<br>Recuperação 2: " . (isset($ver['r2']) ? $ver['r2'] : '-');
                                echo "<br>Recuperação 3: " . (isset($ver['r3']) ? $ver['r3'] : '-');
                                echo "<br>Recuperação 4: " . (isset($ver['r4']) ? $ver['r4'] : '-');
                                echo "<br>Recuperação Final: " . (isset($ver['final']) ? $ver['final'] : '-');
                                echo "<br>Média final: " . (isset($ver['media_final']) ? $ver['media_final'] : '-');
                                echo "<br>Situação: " . (isset($ver['situacao']) ? $ver['situacao'] : '-');
                                echo "<hr>";
                            }?>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta2/js/bootstrap.min.js"></script>

                </td>
            </tr>

        </tbody>
    </table>
    <?php }}?>
    <script src="scripts/boletim.js"></script>
</body>

</html>