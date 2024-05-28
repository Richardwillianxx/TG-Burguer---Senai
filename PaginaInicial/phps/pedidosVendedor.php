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

        <div class="bordaGeral">
            <div class="pedidos__Main">
                <div class="titlePedidos">
                    <h1 class="txtPedidos">ÚLTIMOS PEDIDOS CADASTRADOS</h1>
                </div>
                <div class="divisoriaPedidos">
                    <div class="TodosPedidos__Main">
                        <?php
                        try {
                            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

                            $stmt = $conexao->prepare("SELECT * FROM Carrinho WHERE processamento = 1");
                            $stmt->execute();

                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if ($result) {
                                foreach ($result as $produto) {
                        ?>
                                    <div class="">
                                        <div class="pedidosFeitos">
                                            <div class="">
                                                <h2 class="txtPedidosFeitos">Número do Pedido: <?php echo $produto["NumeroPedido"]; ?></h2>
                                            </div>
                                            <div class="">
                                                <p class="txtPedidosFeitos">Nome: <span class=""><b><?php echo $produto["Nome"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Quantidade: <span class=""><b><?php echo $produto["Quantidade"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Valor do item pedido: <span class=""><b><?php echo $produto["Valor"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Valor total do item pedido: <span class=""><b><?php echo $produto["ValorDeCada"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Código de Barras: <span class=""><b><?php echo $produto["idLanche"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Metodo pagamento: <span class=""><b><?php echo $produto["MetodoPagamento"]; ?></b></span></p>
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
                    <div class="PedidosExtras">
                        <div class="EstoqueProdutos">
                            <div class="txtEstoqueProdutos">Inserir Produtos</div>
                            <div class="btnEstoqueProdutos">
                                <a href="./Estoque.php"><button class="btnEstoque">Inserir Produtos</button></a>
                            </div>
                        </div>
                        <div class="VizualizarEstoque">
                            <div class="txtEstoqueProdutos">Vizualizar Estoque</div>
                            <div class="btnEstoqueProdutos">
                                <a href="../../Estoque/phps/AlteracaoEstoque.php"><button class="btnEstoque">Vizualizar Estoque</button></a>
                            </div>
                        </div>
                        <div class="GerarPdf">
                            <div class="txtEstoqueProdutos">Gerar PDF</div>
                            <div class="btnEstoqueProdutos">
                                <a href="../pdf/gerar/index.php"><button class="btnGerarPDF">Gerar PDF</button></a>
                            </div>
                        </div>

                        <div class="logoTGBURGUER__Main">
                            <img class="logoTGBURGUER" src="../imgs/logocortado.png" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

</html>