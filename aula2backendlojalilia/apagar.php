<?php
$id = "";
if(!isset($_GET['id'])){
    header('location: listar_usuarios.php');
} else {
    $id = $_GET['id']; //pegando o id da url   
}

$dados = [];
$arquivo = "banco.json";
if(file_exists($arquivo)) {
    $extrai_dados = file_get_contents($arquivo);
    $dados = json_decode($extrai_dados, true);

    foreach($dados as $indice => $item) {
        if($indice == $id){
            unset($dados[$id]);
        }
    }
    if(file_put_contents($arquivo, json_encode($dados))){
        header('location: listar_usuarios.php');
    }
}
