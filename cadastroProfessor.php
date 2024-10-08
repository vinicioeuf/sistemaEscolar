



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