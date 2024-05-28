<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/AlteracaoEstoque.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>Atualizações no Estoque</title>
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
                    <a href="../../cadastros/login/login.php"></a>
                    <li><a href="../../telaInicial.php"><i class="material-symbols-outlined">home</i> Início</a></li>
                    <li><a href="../../PaginaInicial/phps/sobre.php"><i class="material-symbols-outlined">groups</i> Sobre</a></li>
                    <li><a href="../../PaginaInicial/phps/menu.php"><i class="material-symbols-outlined">restaurant</i> Menu</a></li>
                    <li><a href="../../PaginaInicial/phps/"><i class="material-symbols-outlined">call</i> Contatos</a></li>
                    <li><a href="../../PaginaInicial/phps/perfil.php"><i class="material-symbols-outlined">person</i> Perfil</a></li>
                    <li><a href="../../PaginaInicial/phps/carrinho.php"><i class="material-symbols-outlined">shopping_cart</i> Carrinho</a></li>

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
                            echo '<li><a href="../../PaginaInicial/phps/estoque.php"><i class="material-symbols-outlined">inventory_2</i> Estoque</a></a></li>';
                            echo '<li><a href="../../PaginaInicial/phps/pedidosVendedor.php"><i class="material-symbols-outlined">text_snippet</i> Pedidos</a></a></li>';
                        }

                        if ($funcao == 'administrador') {
                            echo '<li><a href="../../PaginaInicial/phps/usuario.php"><i class="material-symbols-outlined">Groups</i> Usuario</a></li>';
                            echo '<li><a href="../../PaginaInicial/phps/estoque.php"><i class="material-symbols-outlined">inventory_2</i> Estoque</a></a></li>';
                            echo '<li><a href="../../PaginaInicial/phps/pedidosVendedor.php"><i class="material-symbols-outlined">text_snippet</i> Pedidos</a></a></li>';
                        }
                    } else {
                        echo '<li><a href="../../cadastros/login/login.php"><i class="material-symbols-outlined">login</i> Login</a></li><br>';
                    }

                    ?>

                    <img src="../../PaginaInicial/imgs/logoPreto.png" class="logomenu">
                </ul>
            </nav>
            <div class="perfillogo">
                <div class="tamanhor"></div>
                <div class="person"><a href="../../PaginaInicial/phps/carrinho.php"><img src="../../PaginaInicial/imgs/carro.png" class="carimg"></a><a href="../../PaginaInicial/phps/perfil.php"><img src="../../PaginaInicial/imgs/person.png" class="personimg"></a></div>
            </div>
        </div>
        <div class="title__geral">
            <h2>Últimas Atualizações no Estoque</h2>
        </div>
        <div class="Fundo__main">
            <?php
            try {
                $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

                $stmt = $conexao->prepare("SELECT * FROM Estoque ORDER BY DataModificacao DESC LIMIT 10");
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($result) {
                    foreach ($result as $produto) {
            ?>
                        <div class="Fundo">
                            <div class="">
                                <div class="codigo-Barras__Main">
                                    <h2 class="codigo-Barra">Código de Barras: <?php echo $produto["Codigo"]; ?></h2>
                                </div>
                                <div class="Modificacoes">
                                    <p class="Nome__main-geral">Nome: <span class="Resposta__Nome"><b><?php echo $produto["Nome"]; ?></b></span></p>
                                    <p class="Nome__main-geral">Quantidade no Estoque: <span class="Resposta__Nome"><b><?php echo $produto["Quantidade"]; ?></b></span></p>
                                    <p class="Nome__main-geral">Última Modificação: <span class="Resposta__Nome"><b><?php echo $produto["DataModificacao"]; ?></b></span></p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo "Nenhum produto foi alterado recentemente.";
                }
            } catch (PDOException $e) {
                echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            }
            ?>
        </div>

    </div>

</body>

</html>