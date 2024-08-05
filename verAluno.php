<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>- ITIF: Instituto de Tecnologia e Inovação FuturoTech</title>
    <link rel="stylesheet" href="styles/aluno.css">
    
</head>

<body>
    <?php include_once("main_top.php"); ?>

    <div class="main-aluno">
        <h1>Início > Aluno</h1>
        <div class="aluno-profile">
            <div class="aluno-foto">
                <img src="images/avatar.png" alt="">
                <h1>Brenda Barbosa</h1>
                <h2>3º ANO A</h2>
            </div>
            <div class="aluno-info">
                <ul>
                    <li><strong>Nome Completo: </strong><span>Brenda Barbosa De Oliveira</span></li>
                    <li><strong>Turma: </strong><span>3º Ano A, Manhã</span></li>
                    <li><strong>Idade: </strong><span>17</span></li>
                    <li><strong>Nº Matrícula: </strong><span>20240100045</span></li>
                    <li><strong>Situação: </strong><span>Matriculada</span></li>
                    <li><strong>E-mail: </strong><span>brenda.barbosa12@gmail.com</span></li>
                    <li><strong>Ingresso: </strong><span>2021</span></li>
                </ul>
            </div>
        </div>
        <div class="aluno-actions">
            <button type="button" class="button-prof" data-bs-toggle="modal" data-bs-target="#exampleModalEditar"><i class="bi bi-journal-text"></i> Editar</button>
        </div>
    </div>


    <div class="modal fade" id="exampleModalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Aluno</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
