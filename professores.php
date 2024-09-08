<?php
session_start();
require("conexao.php");
if((!isset($_SESSION['num_matricula']) == true) and (!isset($_SESSION['senha']) == true)){// Ele verifica se não há uma sessão com as credenciais num_matricula e senha, se não houver ele destrói a sessão.
    unset($_SESSION['num_matricula']);
    unset($_SESSION['senha']);
    header("Location: index.php");
}
$ids = $_SESSION['id'];
  $logado = $_SESSION['num_matricula'];// Caso haja uma sessão, o matricula do usuário é armazenado
  $con = Conexao::getInstance();

  $y = "SELECT * FROM professores";
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
        <h1>Início > Administração > Professores</h1>
        <button type="button" class=" button-prof" data-bs-toggle="modal" data-bs-target="#exampleModalNovoProfessor">Novo Professor</button>
        <div class="main-prof">
        <?php while($p = $o->fetch(PDO::FETCH_ASSOC)){?>
    <div class="prof-exemple">
        <img src="<?php echo $p["foto"]?>" alt="">
        <h2><?php echo $p["nome"]?></h2>
        <h5><?php echo $p["disciplina"]?></h5>
        <button 
            type="button" 
            class="button-det" 
            data-bs-toggle="modal" 
            data-bs-target="#exampleModal<?php echo $p["id"]; ?>"
            data-nome="<?php echo $p["nome"]; ?>"
            data-idade="<?php echo $p["idade"]; ?>"
            data-disciplina="<?php echo $p["disciplina"]; ?>"
            data-matricula="<?php echo $p["num_matricula"]; ?>"
        >
            Detalhar
        </button>
    </div>
    <div class="modal fade" id="exampleModal<?php echo $p["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $p["id"]; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Professor(a): </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><span>Nome Completo:</span> <span><?php echo $p["nome"]; ?></span></li>
                        <li><span>Idade:</span> <span> <?php echo $p["idade"]; ?></span></li>
                        <li><span>Disciplina:</span> <span ><?php echo $p["disciplina"]; ?></span></li>
                        <li><span>Número de matrícula:</span> <span><?php echo $p["num_matricula"]; ?></span></li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
<?php }?>
        </div>
    </div>



    <!-- Modal Detalhar -->
    



    <!-- Modal Criar Professor -->
    <div class="modal fade" id="exampleModalNovoProfessor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Professor(a)</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                



                <form method="POST" action="validaCadastroProfessor.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <div class="mb-3">
        <label for="disciplina" class="form-label">Disciplina</label>
        <select class="form-select" id="disciplina" name="disciplina" required>
            <option value="Lingua Portuguesa">Língua Portuguesa</option>
            <option value="Matematica">Matemática</option>
            <option value="Historia">História</option>
            <option value="Educacao Fisica">Educação Física</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="gerarmatricula" class="form-label">Gerar número da matrícula desse professor:</label>
        <button type="button" id="gerarmatricula" class="button-det" required>Gerar</button>
        <p id="matricula" name="nMatricula" class="mt-2"></p>
        <input type="hidden" name="nMatricula" id="hiddenMatricula" value="">
    </div>

    <div class="mb-3">
        <label for="ingresso" class="form-label">Ingresso</label>
        <input type="date" class="form-control" id="ingresso" name="ingresso" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="idade" class="form-label">Idade</label>
        <input type="number" class="form-control" id="idade" name="idade" required>
    </div>

    <div class="mb-3">
        <label for="imagem" class="form-label">Foto</label>
        <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" required>
    </div>
    
    
    <input type="hidden" class="form-control" id="senha" name="senha" required>



    <button type="submit" id="definirSenha" class="button-det">Salvar</button>

    <script>
        var gerarmatricula = document.getElementById("gerarmatricula");
        var matriculaElement = document.getElementById("matricula");
        var hiddenMatricula = document.getElementById("hiddenMatricula");

        gerarmatricula.addEventListener("click", function() {
            var prefixo = "01322";
            var sufixo = "";
            for (var i = 0; i < 5; i++) {
                sufixo += Math.floor(Math.random() * 10);
            }
            var matricula = prefixo + sufixo;
            matriculaElement.textContent = "Matrícula: " + matricula;
            hiddenMatricula.value = matricula;
        });

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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    
</script>
