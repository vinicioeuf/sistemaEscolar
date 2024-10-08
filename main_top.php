<?php
    session_start();
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
    <link rel="stylesheet" href="styles/main_top.css">
</head>
<body>
    <header>
        <div class="main-title">
            <i id="menuBtn" class="bi bi-list menu-btn"></i>
            <img class="imgLogo" src="images/logo.png" alt="">
        </div>
        
        <div class="main-profile">
            <img src="<?php echo $_SESSION['foto']?>" alt="">
            <h3><?php echo $_SESSION['nome']?></h3>
        </div>
        
    </header>

    <aside id="sidebar" class="sidebar">
        <ul>
            <li><a href="home.php"><i class="bi bi-house-door-fill"></i><span class="text">Início</span><i class="bi bi-arrow-right-short text"></i></a></li>
            <?php
                if($_SESSION['credencial'] == 0){?>
            <li><a href="aluno.php"><i class="bi bi-person-circle"></i><span class="text">Aluno</span><i class="bi bi-arrow-right-short text"></i></a></li>
            <li><a href="boletim.php"><i class="bi bi-journal-text"></i><span class="text">Meu boletim</span><i class="bi bi-arrow-right-short text"></i></a></li>
            
            <?php }else{?>
                <?php }?>
            <?php
                if($_SESSION['credencial'] == 1){?>
            <li><a href="turmas.php"><i class="bi bi-kanban"></i><span class="text">Minhas Turmas</span><i class="bi bi-arrow-right-short text"></i></a></li>
                    <?php }else{?>
                        <?php }?>
                        <?php
            if($_SESSION['credencial'] == 2){?>                 
            <li><a href="adm.php"><i class="bi bi-laptop"></i><span class="text">Administração</span><i class="bi bi-arrow-right-short text"></i></a></li>
            <?php }else{?>
                <?php }?> 
                
               
            <li><a href="logout.php"><i class="bi bi-box-arrow-right"></i><span class="text">Sair</span><i class="bi bi-arrow-right-short text"></i></a></li>

        </ul>
    </aside>

<script src="scripts/main.js"></script>
</body>
</html>