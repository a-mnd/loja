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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/produtos.css">
</head>

<body>
    <header>
        <?php
        include_once "admin/conexao.php";
        ?>
        <?php
        include_once "menu.php"; // verifica se o arquivo já não foi incluso e se já, não inclui mais, mas se não foi, então inclui
        //isset verifica se uma variável existe
        $erro = isset($_GET['erro']) ? "Login ou senha inválidos." : ""; 
        // se - se não?condição :condição (?se verdadeiro executa condição :se não outra condição)
        $open = isset ($_GET['erro']) ? "open" : "";
        
        $select = $conexao->prepare("SELECT * FROM usuario");
        $select->execute();
        ?>
        <dialog <?=$open?>>
            <?php
            echo $erro;
            ?>
        </dialog>
        <section class="carrossel">
            <div class="imagem-container">
                <img src="img/carrossel.png" alt="Carrossel LojaTech" width="800">
                <div class="legenda">
                    <i class="icofont-duotone icofont-cart icofont-3x"></i>
                    <span>
                        <h1>Bem vindo à LojaTech</h1>
                        <p>Satisfação a cada click</p>
                    </span>
                </div>
            </div>
        </section>
    </header>
    <main>
        <div class="conteudo_central">
            <section id="produtos">
                <!-- Produto 1 -->
                <?php
                $i = 0;
                while($i < 10){
                echo '
                <div class="card">
                    <div class="card-header">
                        Smartphone Samsung A54
                    </div>
                    <div class="card-body">
                        <a href="detalhes_produto.php"><img src="img/celularA54.jfif" width="200"></a>
                    </div>
                    <div class="card-footer">
                        <div class="card-valor">R$ 2999,90</div>
                        <div class="card-oferta">R$ 2599,90</div>
                        <div class="btn-comprar">
                            <a href="#">Comprar</a>
                        </div>
                        <div class="star">
                            <span>&#9734;</span>
                            <span>&#9734;</span>
                            <span>&#9734;</span>
                            <span>&#9734;</span>
                            <span>&#9734;</span>
                        </div>
                    </div>
                </div>';
                $i++;
                }
                ?>
            </section>
            <div class="btn_listar">
                <a href="lista_produtos.php">Listar Produtos</a>
            </div>
        </div>
    </main>
     <?php
     include_once "footer.php";
     ?>
    <script src="js/menu.js"></script>
</body>

</html>