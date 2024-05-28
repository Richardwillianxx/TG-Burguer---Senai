<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Sobre Nós</title>
</head>

<body>
    <div class="borda sobrenós">
        <div class="navbar">
            <nav class="menu">
                <input type="checkbox" class="menu-faketrigger" />
                <div class="menu_lines">
                    <!-- span é a linha que fica dentro da nave (itens) -->
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul>
                    <li><a href="../../telaInicial.php"><i class="material-symbols-outlined">home</i> Início</a></li>
                    <li><a href="#"><i class="material-symbols-outlined">groups</i> Sobre</a></li>
                    <li><a href="./menu.php"><i class="material-symbols-outlined">restaurant</i> Menu</a></li>
                    <li><a href="./contatos.php"><i class="material-symbols-outlined">call</i> Contatos</a></li>
                    <li><a href="./perfil.php"><i class="material-symbols-outlined">person</i> Perfil</a></li>
                    <li><a href="./carrinho.php"><i class="material-symbols-outlined">shopping_cart</i> Carrinho</a></li>

                    <?php

                    session_start();

                    if (isset($_SESSION['usuario'])) {
                        $usuario = $_SESSION['usuario'];

                        $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                        $comandoSQL = $conexao->query("SELECT * FROM usuario where usuario = '$usuario' ");

                        while ($linhaBD = $comandoSQL->fetch()) {
                            // echo 'funcao: ' . $linhaBD["funcao"] . '<br/>';
                            $funcao = $linhaBD["funcao"];
                        }

                        if ($funcao == 'vendedor') {
                            echo '<li><a href="estoque.php"><i class="material-symbols-outlined">inventory_2</i> Estoque</a></a></li>';
                            echo '<li><a href="pedidosVendedor.php"><i class="material-symbols-outlined">text_snippet</i> Pedidos</a></a></li>';
                        }

                        if ($funcao == 'administrador') {
                            echo '<li><a href="usuario.php"><i class="material-symbols-outlined">Groups</i> Usuario</a></li>';
                            echo '<li><a href="estoque.php"><i class="material-symbols-outlined">inventory_2</i> Estoque</a></a></li>';
                            echo '<li><a href="pedidosVendedor.php"><i class="material-symbols-outlined">text_snippet</i> Pedidos</a></a></li>';
                        }
                    } else {
                        echo '<li><a href="../../cadastros/login/login.php"><i class="material-symbols-outlined">login</i> Login</a></li><br>';
                    }
                    ?>
                    <img src="../imgs/logoPreto.png" class="logomenu">
                </ul>
            </nav>
            <div class="perfillogo">
                <div class="tamanhor"></div>
                <div class="person"><a href="./carrinho.php"><img src="../imgs/carro.png" class="carimg"></a><a href="./perfil.php"><img src="../imgs/person.png" class="personimg"></a></div>
            </div>
        </div>
        <div>
            <center>
                <br>
                <br>
                <br>
                <br>
                <h1 class="texto">SOBRE NÓS</h1>
                <br>
                <br>
                <div class="sobre">
                    <p class="para">A TG Burger é mais do que apenas uma hamburgueria! Surgimos da chama criativa entre amigos do curso de técnico em Desenvolvimento de Sistemas, impulsionados por uma simples aula de projeto de PHP com banco de dados ministrada pelo professor carrasco Luiz Rodolfo Barreto, mestre em Banco de Dados. Essa ideia inicial cresceu, floresceu e se transformou em nossa paixão profissional.</p>
                </div>
                <div class="sobre">
                    <p class="para">Nossa missão é satisfazer sua fome com uma explosão de sabores, levando você a uma jornada gastronômica única. Somos guerreiros na arte de preparar hambúrgueres, vindos da lendária Terra dos Lanches Guerreiros. Cada mordida é uma experiência suculenta e impossível de esquecer.
                        Na TG Burger, não servimos apenas hambúrgueres, mas sim criamos momentos memoráveis. Nossos ingredientes frescos e de alta qualidade combinam-se perfeitamente para criar obras-primas culinárias. Somos movidos pela paixão, pela gastronomia e pelo desejo de superar as expectativas de nossos clientes a cada refeição.
                        Junte-se a nós em nossa busca pela perfeição gastronômica. Experimente o sabor da TG Burger e deixe-nos levá-lo a uma viagem sensorial incomparável!</p>
                </div>
            </center>
        </div>

</body>

</html>