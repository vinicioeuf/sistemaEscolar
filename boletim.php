<?php
session_start();
require("conexao.php");

// error_reporting(0);

  if((!isset($_SESSION['matricula']) == true) and (!isset($_SESSION['senha']) == true)){// Ele verifica se não há uma sessão com as credenciais matricula e senha, se não houver ele destrói a sessão.
      unset($_SESSION['matricula']);
      unset($_SESSION['senha']);
      header("Location: index.php");
  }
  $ids = $_SESSION['id'];
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
            
        $aprovacao2 = "SELECT * FROM notas WHERE id_aluno='".$_SESSION['id']."'";
        $results2 = $con->query($aprovacao2);                                    
        $ver2 = $results2->fetch(PDO::FETCH_ASSOC);
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
                <td data-label="Código"><?php echo $ids;?></td>
                <td data-label="Turma"><?php echo $ver2['turma'];?></td>
                <td data-label="Disciplina"><?php echo $ver2['disciplina'];?></td>
                <td data-label="Situação"><?php echo $ver2['situacao'];?></td>
                <td data-label="AV1"><?php echo $ver2['b1'];?></td>
                <td data-label="R1"><?php echo $ver2['r1'];?></td>
                <td data-label="AV2"><?php echo $ver2['b2'];?></td>
                <td data-label="R2"><?php echo $ver2['r2'];?></td>
                <td data-label="AV3"><?php echo $ver2['b3'];?></td>
                <td data-label="R3"><?php echo $ver2['r3'];?></td>
                <td data-label="AV4"><?php echo $ver2['b4'];?></td>
                <td data-label="R4"><?php echo $ver2['r4'];?></td>
                <td data-label="RF"><?php echo $ver2['rf'];?></td>
                <td data-label="MF"><?php echo $ver2['mf'];?></td>
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
                    <p><strong>Situação:</strong> <span id="modalSituacao"></span></p>
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
                <td data-label="Situação"><?php echo $dados['situacao']; ?></td>
                <td data-label="Turma"><?php echo $dados['turma']; ?></td>
                <td data-label="Nº Matricula"><?php echo $dados['matricula']; ?></td>
                <td data-label="Data de ingresso"><?php echo $dados['ingresso']; ?></td>
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
                                $aprovacao = "SELECT * FROM notas WHERE id_aluno='".$dados['id']."'";
                                $results = $con->query($aprovacao);                                    
                                $ver = $results->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <img src="<?php echo $dados['imagem']?>" alt="" style="width: 300px; height: 300px;">
                                <?php 
                                echo "<br>Turma: ". $ver['turma'];
                                echo "<br>Disciplina: ". $ver['disciplina'];
                                echo "<br>Nota 1: " . $ver['b1'];
                                echo "<br>Nota 2: " . $ver['b2'];
                                echo "<br>Nota 3: " . $ver['b3'];
                                echo "<br>Nota 4: " . $ver['b4'];
                                echo "<br>Recuperação 1: " . $ver['r1'];
                                echo "<br>Recuperação 2: " . $ver['r2'];
                                echo "<br>Recuperação 3: " . $ver['r3'];
                                echo "<br>Recuperação 4: " . $ver['r4'];
                                echo "<br>Recuperação Final: " . $ver['rf'];
                                echo "<br>Média final: " . $ver['mf'];
                                echo "<br>Situação: " . $ver['situacao'];
                                echo "<hr>";
                                ?>
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