<?php
include_once "admin/conexaodois.php"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $erro = "";
    $nome = $_POST['nome'];
    
    
    $padraoSenha = '~^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*\(\)\_\+\[\]\{\}\|\:\"\<\>\.\,\/\?\-]).{8,}$~';
    
    if (empty($nome) or strlen($nome) < 3) {
        $erro .= "Digite um nome.<br>";
    }
    $email = $_POST['email'];
    if (empty($email)) {
        $erro .= "Digite um email.<br>";
    } else {
        $selectEmail = $conexaodois->prepare("SELECT email FROM usuario WHERE email = :email");
        $selectEmail->bindParam('email', $email);
        $selectEmail->execute();
        if ($selectEmail->rowCount()) {
            $erro .= "Email já cadastrado!<br>";
        }
    }
    $cpf = $_POST['cpf'];
    if (!preg_match('~\d{11}~', $cpf)) {
        $erro .= "Digite o CPF com 11 dígitos.<br>";
    } else {
        $selectCpf = $conexaodois->prepare("SELECT cpf FROM usuario WHERE cpf = :cpf");
        $selectCpf->bindParam('cpf', $cpf);
        $selectCpf->execute();
        if ($selectCpf->rowCount()) {
            $erro .= "CPF já cadastrado!<br>";
        }
    }
    $senha = $_POST['senha'];
    if (!preg_match($padraoSenha, $senha)) {
        $erro .= "Digite no mínimo 8 caracteres.<br>Com pelo menos uma letra maiúscula e uma minúscula.<br>Um caractér especial.<br> E pelo menos um número.";
    } else {
        $senhaEncriptada = password_hash($senha, PASSWORD_DEFAULT);
    }
    echo $erro;
    if ($erro == "") {
        $novo = [
            'email' => $email,
            'nome' => $nome,
            'cpf' => $cpf,
            'senha' => $senhaEncriptada

        ];

        $insert = $conexaodois->prepare("INSERT INTO usuario (email, nome, cpf, senha) VALUES (:email, :nome, :cpf, :senha)");
        if ($insert->execute($novo)) {
            echo "Cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar!";
        }
    }
}
