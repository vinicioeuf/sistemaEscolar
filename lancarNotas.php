<?php
    require "conexao.php";
?>

<?php
    

    $con = Conexao::getInstance();
    $sql = "SELECT * FROM turmas";
    $busca = $con->query($sql);

    $sql_aluno = "SELECT * FROM alunos";
    $injet = $con->query($sql_aluno);
?>

<form action="validaNota.php" method="post">
    <select name="turma_ref" id="">
        <option value="" selected disabled>Nome da turma</option>
        <?php
             while ($turmas = $busca->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <option value="<?php echo $turmas["nome"]; ?>"><?php echo $turmas["nome"]; ?></option>
        <?php } ?>
    </select>
    <br>
    <select name="disciplina" id="">
        <option value="Lingua Portuguesa">Língua Portuguesa</option>
        <option value="Matematica">Matemática</option>
        <option value="Historia">História</option>
        <option value="Educacao Fisica">Educação Fisica</option>
    </select>

    
    <br>
    <label for="">Nota do 1º bimestre:</label>
    <input type="text" name="b1" id="">
    <br>
    <label for="">Nota do 2º bimestre:</label>
    <input type="text" name="b2" id="">
    <br>
    <label for="">Nota do 3º bimestre:</label>
    <input type="text" name="b3" id="">
    <br>
    <label for="">Nota do 4º bimestre:</label>
    <input type="text" name="b4" id="">
    <br>
    <label for="">Nota da 1ª recuperação:</label>
    <input type="text" name="r1" id="">
    <br>
    <label for="">Nota da 2ª recuperação:</label>
    <input type="text" name="r2" id="">
    <br>
    <label for="">Nota da 3ª recuperação:</label>
    <input type="text" name="r3" id="">
    <br>
    <label for="">Nota da 4ª recuperação:</label>
    <input type="text" name="r4" id="">
    <br>
    <label for="">Nota da recuperação final:</label>
    <input type="text" name="final" id="">
    <br>
    <label for="">Média final:</label>
    <input type="text" name="media_final" id="">
    <br>
    <select name="situacao" id="">
        <option value="Em andamento">Em andamento</option>
        <option value="Curso concluido">Curso concluido</option>
        <option value="Aprovado">Aprovado</option>
        <option value="Reprovado">Reprovado</option>
    </select>
    <br>

    <?php 
        $getDados = "SELECT * FROM alunos";
        $setDados = $con->query($getDados);

    ?>
    <select name="aluno_ref" id="">
        <option value="none" disabled selected>Id do aluno:</option>
        <?php while($infor = $setDados->fetch(PDO::FETCH_ASSOC)){ ?>
        <option value="<?php echo $infor["id"];?>"><?php echo $infor["nome"] . ", ID: " .$infor["id"];?></option>
        <?php } ?>
    </select>
<br>
<label for="">Faltas:</label>
    <input type="number" name="faltas" id="">
    
    <br>
    <button type="submit">Lançar nota</button>
</form>
