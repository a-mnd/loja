<nav id="nav">
    <a href="index.php" class="logo"><i class="icofont-micro-chip icofont-2x"></i></a> <!--logo-->
    <ul> <!--itens menu-->
        <li>
            <form action="lista_produtos.php">
                <input type="text" name="pesquisa" id="pesquisa">
                <button type="submit"><i class="icofont icofont-search"></i>Lupa</button>
            </form>
        </li>
        <li><a href="lista_produtos.php"><i class="icofont-duotone icofont-cube"></i> Produtos</a></li>
        <!-- <li><a href="admin/listar_categorias.php"><i class = "icofont-duotone icofont-list"></i>Categorias</a></li> -->
        <li><a href="carrinho.php"><i class="icofont-duotone icofont-cart"></i> Carrinho</a></li>

        <?php
        @session_start(); // vai verificar se a sessão exsite e se não existe ele vai começar
        //isset verifica a existência de uma variável, se session email exisitr entao... // o arroba na frente fala que estamos ignorando uma condição
        if (isset($_SESSION['email'])) {
            echo '<li><a href="minha_conta.php"><i class="fa fa-user"></i>Minha conta</a></li>
                    <li><a href="logout.php"><i class="fa fa-close"></i>Sair</a></li>';
        } else {
            echo '
                    <li id="cadastrese"><a href="cadastrese.php"><i class="icofont-duotone icofont-add-users"></i>Cadastre-se</a></li>
                    <li id="login"><a href="login.php"><i class="icofont-duotone icofont-unlock"></i> Login</a></li>';
        }
        ?>

    </ul>
    <button id="hamburguer" class="hamburguer"><i class="icofont icofont-navigation-menu"></i></button> <!--menu hamburguer-->
</nav> <!--Fecha nav-->