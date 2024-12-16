<?php
// session_start();
// $status = isset($_SESSION['status']) ? $_SESSION['status'] : 0;
// if (isset($_SESSION['email']) && $status > 0) {
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/tech_icon.ico" type="image/x-icon">
    <title>LojaTech Tecnologias e mais</title>
    <link rel="stylesheet" href="icofont/icofont.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/produtos.css">
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="../css/form.css">
</head>

<body>
    <header>
        <?php
        include_once "../menu.php";
        ?>
    </header>
    <main>
        <div class="conteudo_central">
            <?php
            $con = new PDO(dsn: "mysql:host=localhost;dbname=banco", username: 'root', password: '');
            if (!$con) {
                echo "Problema de conexão!";
            }
            $id_categoria = $_GET['id_categoria'];
            $sql = "SELECT * FROM categorias where id_categoria=$id_categoria";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nome_categoria = $array['nome_categoria'];
                // $conteudoImagem = $array['imagem']; // Conteúdo binário da imagem
                // $base64Imagem = base64_encode($conteudoImagem); // Converter para base64
            }
            ?>
            <form  action="editar_categoria_ok.php" method="post" id="form_cadastro"><!--enctype="multipart/form-data"-->
            <input type="hidden" name="id_categoria" id="id_categoria" value="<?php echo $id_categoria ?>">
                <div class="form_grupo">
                    <label for="nome">Nome da Categoria:</label>
                    <input type="text" name="nome_categoria" id="nome" value="<?php echo $nome_categoria ?>" class="form_input">
                </div>
                <!-- <center>
                    <br>
                    <input name="imagem" type="file">
                    <br>
                    <!-- <?php 
                    // if($conteudoImagem != ''){
                    //     echo "<img scr='data:image/jpeg;base64, {$base64Imagem}' width='300px'>";
                    // }
                    ?> -->
                <!-- </center> -->
                <div class="form_grupo">
                    <button type="submit" class="form_btn">Alterar</button>
                </div>
                <!-- <div class="form_grupo">
                        <?php
                        // $msg = $_GET['msg']??"";
                        // echo $msg;
                        ?>
                    </div> -->
            </form>
        </div>
    </main>
    <?php
    include_once "../footer.php";
    ?>
    <script src="../js/menu.js"></script>
    <!-- <script src="../js/produto.js"></script>-->
</body>

</html>
<?php
// } else {
//     header('location: ../');
// }
?>