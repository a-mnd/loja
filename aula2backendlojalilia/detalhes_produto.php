<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/tech_icon.ico" type="image/x-icon">
    <title>LojaTech Tecnologias e mais</title>
    <link rel="stylesheet" href="icofont/icofont.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/produtos.css">
</head>

<body>
    <header>
        <?php
        include_once "menu.php";
        ?>
    </header>
    <main>
        <center>
            <?php
            if (isset($_SESSION['nome'])) {
                 echo "<h2>Boas vindas, " . htmlspecialchars($_SESSION['nome']) . "!</h2>";
                $id_usuario = $_SESSION['id_usuario'];
            } else {
                echo "<p>Nome não encontrado na sessão.</p>";
            }
            ?>
        </center>
        <?php
        include_once "admin/conexaodois.php";
        $id_produto = $_GET["id_produto"];
        $sql = "SELECT * FROM produtos INNER JOIN categorias ON produtos.id_categoria=categorias.id_categoria  WHERE id_produto = $id_produto";
        $stmt = $conexaodois->prepare($sql);
        $stmt->execute();

        while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nome_produto = $array['nome_produto'];
            $descricao_produto = $array['descricao_produto'];
            $categoria = $array['nome_categoria'];
            $valor_produto = $array['valor'];
            $conteudoImagem = $array['imagem']; // Conteúdo binário da imagem
            $base64Imagem = base64_encode($conteudoImagem);
            echo "<div class=\"conteudo_central\">
                    <section id=\"produtos\">
                        <div class=\"fotos\">
                            <div class=\"foto_principal\">
                                <img src=\"data:image/jpeg;base64,{$base64Imagem}\" width=\"280\" alt=\"$categoria\">
                            </div>
                            <div class=\"galeria\">
                                <img src=\"data:image/jpeg;base64,{$base64Imagem}\" width=\"70\" alt=\"$categoria\">
                                <img src=\"data:image/jpeg;base64,{$base64Imagem}\" width=\"70\" alt=\"$categoria\">
                                <img src=\"data:image/jpeg;base64,{$base64Imagem}\" width=\"70\" alt=\"$categoria\">
                                <img src=\"data:image/jpeg;base64,{$base64Imagem}\" width=\"70\" alt=\"$categoria\">
                            </div>
                        </div>
                        <div class=\"container_descricao\">
                            <h1>
                                $nome_produto, $descricao_produto 
                            </h1>";
        }
        ?>
        <div class="container_detalhes">
            <div>10% desconto no PIX</div>
            <div>Parcelamento sem juros</div>
            <?php
            for ($i = 1; $i < 6; $i++) {
                $valor_parcelamento = $valor_produto / $i;
                $valor_parceladoFormato = number_format($valor_parcelamento, 2, ',', '.');
                echo "<div> $i  X R$ $valor_parceladoFormato s/ juros</div>";
                // <div>2 X 1749,50 s/ juros</div>
                // <div>3 X 874,75 s/ juros</div>
                // <div>4 X 437,38 s/ juros</div>
                // <div>5 X 218,69 s/ juros</div>
            }
            $valor_desconto = $valor_produto * 0.1;
            $valor_oferta = $valor_produto - $valor_desconto;

            ?>
        </div>
        <div class="container_footer">
            <div class="container_valor">
                <?php
                echo "
                <div class=\"card-valor\">R$ "
                    . number_format($valor_produto, 2, ',', '.')
                    . "</div>
                <div class=\"card-oferta\">R$ "
                    . number_format($valor_oferta, 2, ',', '.')
                    . "</div>
                ";
                ?>
            </div>
            <form action="add_carrinho.php" method="post" id="carrinho" id="form_cadastro">
            <input type="hidden" name = "id_usuario" id="id_usuario" class="form_input" value = "<?php echo $id_usuario?>">
                <input type="hidden" name = "id_produto" id="id_produto" class="form_input" value = "<?php echo $id_produto?>">
                <input type="hidden" name = "valor" id="valor" class="form_input" value = "<?php echo $valor_produto?>">
                <label for="quantidade">Quantidade</label>
                <input type="number" name = "quantidade" id="quantidade" class="form_input">

                <button type="submit" class="btn-comprar">Comprar</button>
                <!-- <div class="btn-comprar"><a href="add_carrinho.php">Comprar</a></div> -->
            </form>
        </div>
        </div>
        </section>
        <section>
            <ul class="tabs_menu">
                <li data-id="#tab1" class="active">Tab 1</li>
                <li data-id="#tab2">Tab 2</li>
                <li data-id="#tab3">Tab 3</li>
                <li data-id="#tab4">Tab 4</li>
            </ul>
            <div class="tabs_item active" id="tab1">
                <div class="tab_conteudo">
                    Tab 1
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates in laborum nihil nulla maiores suscipit laboriosam harum quos rem, quidem nemo unde saepe expedita neque aperiam repellat assumenda perspiciatis iusto!
                </div>
            </div>
            <div class="tabs_item" id="tab2">
                <div class="tab_conteudo">
                    Tab 2
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates in laborum nihil nulla maiores suscipit laboriosam harum quos rem, quidem nemo unde saepe expedita neque aperiam repellat assumenda perspiciatis iusto!
                </div>
            </div>
            <div class="tabs_item" id="tab3">
                <div class="tab_conteudo">
                    Tab 3
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates in laborum nihil nulla maiores suscipit laboriosam harum quos rem, quidem nemo unde saepe expedita neque aperiam repellat assumenda perspiciatis iusto!
                </div>
            </div>
            <div class="tabs_item" id="tab4">
                <div class="tab_conteudo">
                    Tab 4
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates in laborum nihil nulla maiores suscipit laboriosam harum quos rem, quidem nemo unde saepe expedita neque aperiam repellat assumenda perspiciatis iusto!
                </div>
            </div>
        </section>
        </div>
    </main>
    <?php
    include_once "footer.php";
    ?>
    <script src="js/menu.js"></script>
    <script src="js/tabs.js"></script>
</body>

</html>