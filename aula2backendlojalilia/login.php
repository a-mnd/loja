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
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <header>
        <?php 
        include_once "menu.php";
        ?>
        <dialog id="avisos">
        </dialog>
    </header>
    <main>
        <div class="conteudo_central">
            <section class="formulario_geral">
                <form method="post" id="form_login"><!--action="logar.php" o action agr aq não é mais necessário pois vamos adcionar um js-->
                    <h1>Entrar na LojaTech</h1>
                    <input type="text" name = "status" id="status">
                    <div class="form_grupo">
                        <input type="email" name="email" id="email" class="form_input" placeholder="Email">
                    </div>
                    <div class="form_grupo">
                        <input type="password" name="senha" id="senha" class="form_input" placeholder="Senha">
                    </div>
                    <div class="form_grupo">
                        <button type="submit" class="form_btn">Entrar</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <?php
    include_once "footer.php";
    ?>
    <script src="js/menu.js"></script>
    <!-- <script>
        const form = document.getElementById('form_login');
        const dialog = document.getElementById('avisos');
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            let data = new FormData(form); //json no formulario cria um objeto a partir dos nomes do formulario 
            //console.log(data);
            fetch("logar.php", {
                method: 'POST',
                body: data,
            })
            .then((resposta) => {
                if(resposta.ok){
                    return resposta.text();
                }
            })
            .then((mensagem) => {
                dialog.innerHTML = mensagem;
                dialog.open = true;
                setTimeout(() => {
                    dialog.open = false;
                }, 3000)
            })
        })
    </script> -->
    <script>
        const form = document.getElementById('form_login');
        const dialog = document.getElementById('avisos');
        form.addEventListener('submit', (event)=>{
            event.preventDefault()
            let data = new FormData(form)
            fetch("logar.php", {
                method: 'POST',
                body: data,
            })
            .then((respota) => {
                if(respota.ok){
                    return respota.text();
                }
            })
           
            .then((msg) => {
                if (msg === "Email ou senha incorretos!") {
                  dialog.innerHTML = msg;
                    dialog.open = true;
                    setTimeout(() => {
                      dialog.open = false;
                    }, 3000);
                } else {
                   window.location.href = "index.php";
             }
            });
        })        
    </script>
</body>

</html>