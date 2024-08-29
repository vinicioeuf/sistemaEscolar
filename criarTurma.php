<?php
    require("conexao.php");

    $con = Conexao::getInstance();
    $sql = "SELECT * FROM professores";
    $busca = $con->query($sql);
?>

<form action="criadorTurma.php" method="post" enctype="multipart/form-data">
    <label for="Nome">Nome da turma:</label>
    <input type="text" name="nome" id="" required>
    <br>
    <select name="professor" id="">
        <option value="" selected disabled>Escolher professor</option>
        <?php
             while ($professores = $busca->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <option value="<?php echo $professores["nome"]; ?>"><?php echo $professores["nome"]; ?></option>
        <?php } ?>
    </select>
    <br>
    <select name="turno" id="">
        <option value="Matutino">Matutino</option>
        <option value="Vespertino">Vespertino</option>
        <option value="Noturno">Noturno</option>
    </select>
    <br>
    <label for="">Quantidade de alunos:</label>
    <input type="number" name="qntalunos" id="">
    <br>
    <label for="">Quantidade de aulas:</label>
    <input type="number" name="totalaulas" id="">
    <br>
    
    <button type="submit">Criar turma</button>
</form>
