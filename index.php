<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>- ITIF: Instituto de Tecnologia e Inovação FuturoTech</title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <header>
        <div>
            <img class="imgLogo" src="images/logo.png" alt="">
            <img class="imgNome" src="images/nomeEscola.png" alt="">
        </div>
    </header>

    <main>
        <form action="validaLogin.php" method="POST">
            <div class="login-title">
                <i width="50" class="bi bi-lock-fill"></i>
                <h2>Login</h2>
            </div>

            <div class="user-main">
                <h6>Matrícula:</h6>
                <input type="number" name="num_matricula">
            </div>

            <div class="password-main position-relative">
                <h6>Senha:</h6>
                <input id="password" type="password" name="senha">
                <i id="togglePassword" class="bi bi-eye-slash-fill position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
            </div>

            <button type="submit">Entrar</button>
            <a href="">Esqueceu sua senha?</a>
        </form>

        <div class="main-image">
            <img src="images/loginImage.png" alt="">
        </div>
    </main>

    <footer>
        <h6>Copyright <i class="bi bi-c-circle"></i> 2024, DEVS ICON &reg;</h6>
    </footer>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('bi-eye-fill');
            this.classList.toggle('bi-eye-slash-fill');
        });
    </script>
</body>
</html>
