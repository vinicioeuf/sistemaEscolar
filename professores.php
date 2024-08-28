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
            data-bs-target="#exampleModal"
            data-nome="<?php echo $p["nome"]; ?>"
            data-idade="<?php echo $p["idade"]; ?>"
            data-disciplina="<?php echo $p["disciplina"]; ?>"
            data-matricula="<?php echo $p["num_matricula"]; ?>"
        >
            Detalhar
        </button>
    </div>
<?php }?>
        </div>
    </div>



    <!-- Modal Detalhar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Professor(a): </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><span>Nome Completo:</span> <span id="detalhe-nome"></span></li>
                        <li><span>Idade:</span> <span id="detalhe-idade"></span></li>
                        <li><span>Disciplina:</span> <span id="detalhe-disciplina"></span></li>
                        <li><span>Número de matrícula:</span> <span id="detalhe-matricula"></span></li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Criar Professor -->
    <div class="modal fade" id="exampleModalNovoProfessor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Professor(a)</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                



<form action="validaCadastroProfessor.php" method="post" enctype="multipart/form-data">
    <label for="Nome">Nome:</label>
    <input type="text" name="nome" id="" required>
    <br>
    <select name="disciplina" id="">
        <option value="Lingua Portuguesa">Língua Portuguesa</option>
        <option value="Matematica">Matemática</option>
        <option value="Historia">História</option>
        <option value="Educacao Fisica">Educação Fisica</option>
    </select>
    <br>
    <label for="">Gerar número da matrícula desse professor:</label>
    <input type="button" id="gerarmatricula" value="Gerar" required/>
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
    <label for="Ingresso">Ingresso:</label>
    <input type="date" name="ingresso" id="" required>
    <br>
    <label for="E-mail">E-mail:</label>
    <input type="text" name="email" id="" required>
    <br>
    
    <label for="Idade">Idade:</label>
    <input type="number" name="idade" id="" required>

    <br>
    <label for="">Foto:</label>
    <input type="file" name="imagem" id="" required>
    <br>
    <input type="hidden" name="senha" id="senha">
    <label for="">CPF</label>
    <input type="text" name="cpf" id="cpf" required>
    <br>
    
    <button type="submit" id="definirSenha" name="submit" class="submit">Cadastrar professor</button>
    <script>
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
    document.addEventListener('DOMContentLoaded', function() {
        var detailButtons = document.querySelectorAll('.button-det');
        
        detailButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var nome = this.getAttribute('data-nome');
                var idade = this.getAttribute('data-idade');
                var disciplina = this.getAttribute('data-disciplina');
                var matricula = this.getAttribute('data-matricula');

                document.getElementById('detalhe-nome').textContent = nome;
                document.getElementById('detalhe-idade').textContent = idade;
                document.getElementById('detalhe-disciplina').textContent = disciplina;
                document.getElementById('detalhe-matricula').textContent = matricula;
            });
        });
    });
</script>
