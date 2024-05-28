<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Contatos</title>
</head>

<body>
    <div class="borda">
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
                    <li><a href="./sobre.php"><i class="material-symbols-outlined">groups</i> Sobre</a></li>
                    <li><a href="./menu.php"><i class="material-symbols-outlined">restaurant</i> Menu</a></li>
                    <li><a href="#"><i class="material-symbols-outlined">call</i> Contatos</a></li>
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
                <h1 class="texto">ENTRE EM CONTATO CONOSCO</h1>
                <br>
                <div class="tableGeral">
                    <table>
                        <tr><td><img src="../imgs/fone.png" class="tele"></td><td><p class="parágrafo">Telefone: 3456-7900</p></td></tr>
                        <tr><td><img src="../imgs/zap.png" class="zap"></td><td><p class="parágrafo">WhatsApp: (19) 96652-4021</p></td></tr>
                        <tr><td><img src="../imgs/gmail.png" class="gmail"></td><td> <p class="parágrafo">E-mail: tgburger@gmail.com</p></td></tr>
                        <tr><td><img src="../imgs/insta.png" class="insta"></td><td><p class="parágrafo">Instagram: @tgburger_2itds</p></td></tr>
                    </table>
                </div>
                
                <div><img src="../imgs/Logo.png" class="loginho"></div>
            </center>
        </div>
</body>

</html>