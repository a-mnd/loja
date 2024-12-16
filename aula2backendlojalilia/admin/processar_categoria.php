<?php
$con = new PDO(dsn: "mysql:host=localhost;dbname=banco", username: 'root', password: '');
if(!$con){
    echo "Não foi dessa vez :(";
} 
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome_categoria = $_POST['nome'];

    $insert = $con->prepare("INSERT INTO categorias (nome_categoria) VALUES (:nome)");
    $insert->bindParam('nome', $nome_categoria);
    if($insert->execute()){//retorna true | false
        //header('location: cadastrar_produto.php?msg=Cadastrado com sucesso!');
        echo "Cadastrado com sucesso!";
    } else {
        //header('location: cadatrar_produto.php?msg=Não foi possível cadastrar!');
        echo "Não foi possível cadastrar.";
    }

}