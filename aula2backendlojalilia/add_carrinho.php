<?php
//conexão com o banco 
include_once "admin/conexaodois.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    // $data = date();
    $id_produto = $_POST['id_produto'];
    $quantidade =  $_POST['quantidade'];
    $valor = $_POST['valor'];

    // Verificar se já existe uma compra (carrinho) para o usuário
    $sql = "SELECT id_usuario FROM compra WHERE id_usuario = :id_usuario";
    $stmt = $conexaodois->prepare($sql);
    $stmt->execute([':id_usuario' => $id_usuario]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se o usuário não possui compra, inserir nova compra
    if (!$usuario) {
        $sql_insert = "INSERT INTO compra (id_usuario, data_compra) VALUES (:id_usuario, CURRENT_DATE)";
        $insert = $conexaodois->prepare($sql_insert);
        $insert->execute([':id_usuario' => $id_usuario]);
    }

    // Buscar o id_compra associado ao usuário
    $sql = "SELECT id_compra FROM compra WHERE id_usuario = :id_usuario ORDER BY id_compra DESC LIMIT 1";
    $stmt2 = $conexaodois->prepare($sql);
    $stmt2->execute([':id_usuario' => $id_usuario]);

    $compra = $stmt2->fetch(PDO::FETCH_ASSOC);
    $id_compra = $compra['id_compra'];

    // Inserir produto no carrinho (tabela de itens de compra)
    $sql_insert_produto = "INSERT INTO compra_itens (id_compra, id_produto, quantidade, valor)
                       VALUES (:id_compra, :id_produto, :quantidade, :valor)";
    $stmt_produto = $conexaodois->prepare($sql_insert_produto);
    $stmt_produto->execute([
        ':id_compra' => $id_compra,
        ':id_produto' => $id_produto,
        ':quantidade' => $quantidade,
        ':valor' => $valor
    ]);
}

header('location: index.php');
// precisamos checar se já existe carrinho (tabela compra)
// se não existir, procedemos o include.

// $novo1 = [
//     'id_usuario' => $id_usuario
//     // 'id_produto' => $id_produto,
//     // 'quantidade' => $quantidade,
//     // 'valor' => $valor
// ];

// $sql = "SELECT * FROM compra WHERE id_usuario = $id_usuario";
// $stmt = $conexaodois->prepare($sql);
// $stmt->execute();
// $usuario = 0;
// while($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     $usuario = $array['id_usuario'];
// }
// if($usuario == 0) {
//     //Agora inclui
//     $insert = $conexaodois->prepare("INSERT INTO compra (id_usuario, data_compra) VALUES (:id_usuario, CURRENT_DATE)");
//     $insert->execute($novo1);
// }
