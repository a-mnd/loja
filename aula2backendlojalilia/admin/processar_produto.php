<?php
$con = new PDO(dsn: "mysql:host=localhost;dbname=banco", username: 'root', password: '');
if(!$con){
    echo "Não foi dessa vez :(";
} 
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'];

    $insert = $con->prepare("INSERT INTO produtos (nome_produto, valor, descricao_produto) VALUES (:nome, :valor, :descr)");
    $insert->bindParam('nome', $nome);
    $insert->bindParam('valor', $valor);
    $insert->bindParam('descr', $descricao);
    if($insert->execute()){//retorna true | false
        //header('location: cadastrar_produto.php?msg=Cadastrado com sucesso!');
        echo "Cadastrado com sucesso!";
    } else {
        //header('location: cadatrar_produto.php?msg=Não foi possível cadastrar!');
        echo "Não foi possível cadastrar.";
    }

}