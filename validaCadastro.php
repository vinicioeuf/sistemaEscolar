<?php

include "conexao.php";
include "vendor/autoload.php";
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance([
    'cloud' => [
      'cloud_name' => 'dz72cg2eq', 
      'api_key' => '754459251157767', 
      'api_secret' => 'hk-nUc2tBVp43LoKz4A7USOzk4o'],
    'url' => [
      'secure' => true]]);

try {
    $con = Conexao::getInstance();

    if (isset($_FILES['imagem'])) {
        $imagem = $_FILES['imagem'];
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $nMatricula = addslashes($_POST['nMatricula']);
        $ingresso = addslashes($_POST['ingresso']);
        $turma = addslashes($_POST['turma']);
        $idade = addslashes($_POST['idade']);
        $situacao = addslashes($_POST['situacao']);
        $senha = addslashes($_POST['senha']);
        $cpf = addslashes($_POST['cpf']);
        // Verifica se não houve erro no upload
        if ($imagem['error'] == UPLOAD_ERR_OK) {
            // Move o arquivo para a pasta desejada
            $nomeArquivo = $imagem['name'];
            $caminhoArquivo = 'perfil/' . $nomeArquivo;

            // Obtém a extensão do arquivo
            $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

            // Verifica se a extensão é jpg ou png
            if ($extensao == 'jpg' || $extensao == 'jpeg' || $extensao == 'png') {
                
                // Define o novo nome do arquivo
                $novoNomeArquivo = uniqid() . '.' . $extensao;
                $caminhoArquivo = 'perfil/' . $novoNomeArquivo;

                // Move o arquivo para a pasta desejada com o novo nome
                move_uploaded_file($imagem['tmp_name'], $caminhoArquivo);

                // Faz o upload da imagem para o Cloudinary com o limite de tamanho de arquivo
                $cloudinary = new UploadApi();
                $nome = trim($nome);

                $response = $cloudinary->upload($caminhoArquivo, [
                    "public_id" => $nome,
                    "max_file_size" => 5000000
                ]);
                
                $caminhoArquivo = $response['secure_url'];

                // Insere o produto no banco de dados
                $query = "INSERT INTO alunos (nome, email, matricula, cpf, ingresso, turma, idade, situacao, senha, imagem, NOW())) VALUES (:nome, :email, :matricula, :cpf, :ingresso, :turma, :idade, :situacao, :senha, :imagem, NOW())";
                $stmt = $con->prepare($query);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':matricula', $nMatricula);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':ingresso', $ingresso);
                $stmt->bindParam(':turma', $turma);
                $stmt->bindParam(':idade', $idade);
                $stmt->bindParam(':situacao', $situacao);
                $stmt->bindParam(':senha', $senha);
                $stmt->bindParam(':imagem', $caminhoArquivo);
                $stmt->execute();
            } else {
                echo 'Somente arquivos JPG e PNG são permitidos.';
            }

        }
    }
    header('Location: index.php');
    exit();
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}
?>
