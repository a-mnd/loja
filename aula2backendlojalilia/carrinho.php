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
    <link rel="stylesheet" href="css/carrinho.css">
    <style>
        .btn-comprar {
            padding: .7rem 1rem;
        }
    </style>
</head>

<body>
    <header>
        <?php
        // include_once "admin/conexaodois.php";
        include_once "menu.php";
        ?>
    </header>
    <main>
        <?php
         if (isset($_SESSION['nome'])) {
            echo "<h2>Boas vindas, " . htmlspecialchars($_SESSION['nome']) . "!</h2>";
            $id_usuario = $_SESSION['id_usuario'];
        } else {
            echo "<p>Nome não encontrado na sessão.</p>";
        }
        ?>
        <div class="conteudo_central">
            <section class="carrinho">
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>QTD.</th>
                            <th>Valor Un.</th>
                            <th>Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once "admin/conexaodois.php";
                        // $id_usuario = $_GET["id_usuario"];
                        $sql = "SELECT * FROM compra INNER JOIN compra_itens INNER JOIN produtos ON compra.id_compra=compra_itens.id_compra AND compra_itens.id_produto=produtos.id_produto WHERE id_usuario=$id_usuario";
                        $stmt = $conexaodois->prepare($sql);
                        $stmt->execute();
                        //laço para exibição de todos os registros que a query trouxe
                        $totalcarrinho = 0;
                        while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $nome_produto = $array['nome_produto'];
                            $quantidade = $array['quantidade'];
                            $valor = $array['valor'];
                            $valorformatado = number_format($valor, 2, ',', '.');
                            $total = $valor * $quantidade;
                            $valorporQtde = number_format($total, 2, ',', '.');
                            $totalcarrinho = $totalcarrinho + $total;
                            echo '<tr>';
                            echo "<td>$nome_produto</td>";
                            echo "<td>$quantidade</td>";
                            echo "<td> R$ $valorformatado </td>";
                            echo "<td> R$ $valorporQtde </td>";
                            echo "<td class = 'acoes'><ahref='#'><i class='fa fa-plus'></i></a> <a href='#'><i
                            class='fa fa-trash'></i></a></td>";

                        };
                        ?>
                        <!-- <tr>
                            <td>Capa para Celular Samsung A54</td>
                            <td>1</td>
                            <td class="money">R$ 50,00</td>
                            <td class="money">R$ 50,00</td>
                            <td class="acoes"><a href="#"><i class="fa fa-plus"></i></a> <a href="#"><i
                                        class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>Smartphone Samsung A5</td>
                            <td>1</td>
                            <td class="money">R$ 2.150,00</td>
                            <td class="money">R$ 2.150,00</td>
                            <td class="acoes"><a href="#"><i class="fa fa-plus"></i></a> <a href="#"><i
                                        class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>Pen Drive 128g USB 2.0</td>
                            <td>2</td>
                            <td class="money">R$ 35,00</td>
                            <td class="money">R$ 35,00</td>
                            <td class="acoes"><a href="#"><i class="fa fa-plus"></i></a> <a href="#"><i
                                        class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>TV Samsung 42”</td>
                            <td>2</td>
                            <td class="money">R$ 3.099,00</td>
                            <td class="money">R$ 3.099,00</td>
                            <td class="acoes">
                                <a href="#"><i class="fa fa-plus"></i></a>
                                <a href="#"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
                <div class="finalizar">
                    <div class="frete">
                        <form action="" method="post">
                            <div for="frete">Calcula Frete </div>
                            <input type="text" name="frete" id="frete">
                            <button type="submit" class="btn-comprar"> OK </button>
                            <div class="saida_frete">Gratis</div>
                        </form>
                    </div>
                    <div class="desconto_final">Descontos R$ 00,00</div>
                    <div class="total_final">TOTAL A PAGAR <?php  echo $totalcarrinho ?></div>
                    <div class="btn-finalizar"><a href="#"> Finalizar </a></div>
                </div>
            </section>
        </div>
    </main>
    <?php
    include_once "footer.php";
    ?>
    <script src="js/menu.js"></script>
</body>

</html>