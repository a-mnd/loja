<?php
try {
    // Conexão com o banco de dados
    $con = new PDO("mysql:host=localhost;dbname=banco", 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Problema com a conexão: " . $e->getMessage();
    exit;
}

// Dados do formulário
$id_categoria = $_POST["id_categoria"];
$nome_categoria = $_POST["nome_categoria"];

// $imagem = $_FILES["imagem"];
// // Verificar se a imagem foi enviada
// if ($imagem['error'] == UPLOAD_ERR_OK) {
//     // Ler o conteúdo do arquivo de imagem
//     $conteudo_imagem = file_get_contents($imagem['tmp_name']);

    // Array de dados para o update
    $novo = [
        'id_categoria' => $id_categoria,
        'nome_categoria' => $nome_categoria
        // 'imagem' => $conteudo_imagem
    ];

    // Query de update
    $update = $con->prepare("UPDATE categorias SET nome_categoria = :nome_categoria  WHERE id_categoria = :id_categoria");

    // Definir o tipo de dado para o campo imagem
    // $update->bindParam(':imagem', $conteudo_imagem, PDO::PARAM_LOB);

    // Executa a query e verifica o resultado
    if ($update->execute($novo)) {
        header('location: listar_categorias.php?msg=Alterado com sucesso!');
    } else {
        header('location: listar_categorias.php?msg=Não foi possível alterar!');
    }
// } else {
//     echo "Erro no upload da imagem!";
// }