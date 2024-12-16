<?php
//editar_produto_ok.php
// $con = new PDO(dsn: "mysql:host=localhost;dbname=banco", username: 'root', password: '');
// if (!$con) {
//     echo "Problema de conexão!";
// }

// $id_produto = $_POST['id_produto'];
// $nome_produto = $_POST['nome_produto'];
// $valor_produto = $_POST['valor'];
// $descricao_produto = $_POST['descricao_produto'];

// $update = $con->prepare("UPDATE produtos set nome_produto = :novo_produto', valor = '$valor_produto', descricao_produto = '$descricao_produto' where id_produto = $id_produto");
// $update->bindParam('id_produto', $id_produto);
// $update->bindParam('nome_produto', $nome_produto);
// $update->bindParam('valor', $valor_produto);
// $update->bindParam('descricao_produto', $descricao_produto);
// $update->execute();
try {
    // Conexão com o banco de dados
    $con = new PDO("mysql:host=localhost;dbname=banco", 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Problema com a conexão: " . $e->getMessage();
    exit;
}

// Dados do formulário
$id_produto = $_POST["id_produto"];
$nome_produto = $_POST["nome_produto"];
$valor_produto = $_POST["valor"];
$descricao_produto = $_POST["descricao_produto"];
$imagem = $_FILES["imagem"];
// Verificar se a imagem foi enviada
if ($imagem['error'] == UPLOAD_ERR_OK) {
    // Ler o conteúdo do arquivo de imagem
    $conteudo_imagem = file_get_contents($imagem['tmp_name']);

    // Array de dados para o update
    $novo = [
        'id_produto' => $id_produto,
        'nome_produto' => $nome_produto,
        'valor_produto' => $valor_produto,
        'descricao_produto' => $descricao_produto,
        'imagem' => $conteudo_imagem
    ];

    // Query de update
    $update = $con->prepare("UPDATE produtos SET nome_produto = :nome_produto, valor = :valor_produto, descricao_produto = :descricao_produto, imagem = :imagem WHERE id_produto = :id_produto");

    // Definir o tipo de dado para o campo imagem
    $update->bindParam(':imagem', $conteudo_imagem, PDO::PARAM_LOB);

    // Executa a query e verifica o resultado
    if ($update->execute($novo)) {
        header('location: listar_produtos.php?msg=Alterado com sucesso!');
    } else {
        header('location: listar_produtos.php?msg=Não foi possível alterar!');
    }
} else {
    echo "Erro no upload da imagem!";
}
