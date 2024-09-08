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

  $y = "SELECT * FROM adms";
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
        <h1>Início > Administração > Administradores</h1>
        <button type="button" class=" button-prof" data-bs-toggle="modal" data-bs-target="#exampleModalNovoProfessor">Novo Administrador</button>
        <div class="main-prof">
        <?php while($p = $o->fetch(PDO::FETCH_ASSOC)){?>
            <div class="prof-exemple">
                <img src="<?php echo $p["foto"]?>" alt="">
                <h2><?php echo $p["nome"]?></h2>
                <h5><?php echo $p["funcao"]?></h5>
                <button type="button" class=" button-det" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $p["id"]?>">Detalhar</button>
            </div>
            <!-- Modal Detalhar -->
    <div class="modal fade" id="exampleModal<?php echo $p["id"]?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $p["id"]?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel<?php echo $p["id"]?>">Administradora: Julia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><span>Nome Completo:</span><span><?php echo $p["nome"]?></span></li>
                        <li><span>Idade:</span><span><?php echo $p["idade"]?></span></li>
                        <li><span>CPF:</span><span></span><?php echo $p["cpf"]?></li>

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



    
    



    <!-- Modal Criar Adm -->
    <div class="modal fade" id="exampleModalNovoProfessor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Administrador(a)</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="validaCadastroAdm.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <label for="">Gerar número da matrícula desse professor:</label>
                        <input type="button" id="gerarmatricula" value="Gerar" required />
                        <p id="matricula" name="nMatricula"></p>
                        <input type="hidden" name="nMatricula" id="hiddenMatricula" value="">
                        <script>
                            var gerarmatricula = document.getElementById("gerarmatricula");
                            var matriculaElement = document.getElementById("matricula");
                            var hiddenMatricula = document.getElementById("hiddenMatricula");

                            gerarmatricula.addEventListener("click", function() {
                                // Prefixo fixo
                                var prefixo = "01322";

                                // Gerar 5 dígitos aleatórios
                                var sufixo = "";
                                for (var i = 0; i < 5; i++) {
                                    sufixo += Math.floor(Math.random() * 10); // Gera um dígito aleatório de 0 a 9
                                }

                                // Concatenar prefixo e sufixo para formar a matrícula
                                var matricula = prefixo + sufixo;

                                // Exibir a matrícula gerada
                                matriculaElement.textContent = "Matrícula: " + matricula;

                                // Definir o valor do campo hidden com a matrícula gerada
                                hiddenMatricula.value = matricula;
                            });
                        </script>
                        <br>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="idade" class="form-label">Idade</label>
                            <input type="number" class="form-control" id="idade" name="idade" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" required>
                        </div>
                        <div class="mb-3">
                            <label for="funcao" class="form-label">Função</label>
                            <input type="text" class="form-control" id="funcao" name="funcao" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                        <div class="mb-3">
                            <label for="imagem" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
                        </div>
                        <button type="submit" class="button-det">Salvar</button>
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