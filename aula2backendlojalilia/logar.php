<?php
include_once "admin/conexaodois.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    // $status = $_POST['status'];


    $selectEmail = $conexaodois->prepare("SELECT * FROM usuario WHERE email = :email");
    $selectEmail->bindParam('email', $email);
    $selectEmail->execute();
    while ($array = $selectEmail->fetch(PDO::FETCH_ASSOC)) {
        $id_usuario = $array['id_usuario'];
        $senha_banco = $array['senha'];
        $email_banco = $array['email'];
        $nome = $array['nome'];
    }
    //if ($status > 0) {
    if ($email == $email_banco) { //fazendo separado por segurança das informações
        if (password_verify($senha, $senha_banco)) {
            //verifica se existe uma sessão, se não existir ele inicia uma sessão
            session_start();
            //Global SESSION grava dados da pessoa logada
            $_SESSION['email'] = $email_banco;
            $_SESSION['nome'] = $nome;
            $_SESSION['id_usuario'] = $id_usuario;
            // $_SESSION['status'] = $status;
            header('location: index.php'); // se tudo certo no login podemos redirecionar para outra página como temos um index pode ser colocado também como header ('location: ./');
            // echo "Ok você está autenticado";
            // header ('location: index.php');
        } else {
            // header('location: ./?erro=erro'); //coloca-se o else de errro igual nos dois para que não se descubra onde está o erro especificamente para que não se dê chance ao hack de contas e outras inseguranças
            echo "Login ou senha inválidos.";
        }
    } else {
        // header('location: ./?erro=erro');
        echo "Login ou senha inválidos";
    }
    //}
}
    /*else {
        //Verficação USER
        if ($email == $login_user) { //fazendo separado por segurança das informações
            if($senha == $senha_user) {
                //verifica se existe uma sessão, se não existir ele inicia uma sessão
                session_start();
                //Global SESSION grava dados da pessoa logada
                $_SESSION['email'] = $login_user;
                $_SESSION['nome'] = $nome_user;
                $_SESSION['status'] = $status;
                header('location: index.php'); // se tudo certo no login podemos redirecionar para outra página como temos um index pode ser colocado também como header ('location: ./');
            } else {
                header('location: ./?erro=erro'); //coloca-se o else de errro igual nos dois para que não se descubra onde está o erro especificamente para que não se dê chance ao hack de contas e outras inseguranças
            }
        } else {
            header('location: ./?erro=erro');
        }
    }
}*/