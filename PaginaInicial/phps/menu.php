<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Menu</title>
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
                    <li><a href="#"><i class="material-symbols-outlined">restaurant</i> Menu</a></li>
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
            <div class="funcionamento">
                <br>
                <br>
                <h1 class="texto">MENU</h1>
                <br>
                <br>
                <p class="parágrafo">Horário de Funcionamento:</p>
                <p class="parágrafo">Terça à Quinta - 18h30 às 23h</p>
                <p class="parágrafo">Sexta à Domingo - 18h às 00h</p>
            </div>

            <div class="cardapio-row">
                <?php
                try {
                    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

                    $stmt = $conexao->prepare("SELECT * FROM Estoque ORDER BY id");
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($result) {
                        foreach ($result as $produto) {
                ?>
                            <div class="cardapio <?php if ($produto["Quantidade"] <= 0) echo "fora-de-estoque"; ?>">
                                <div class="divisoria1__cardapio">
                                    <div class="divisoria1__acima__Cardapio">
                                        <div class="lanche">
                                            <h3 class="nomeLanche"><?php echo $produto["Nome"]; ?></h3>
                                            <form id="form-<?php echo $produto["id"]; ?>" action="Carrinho.php" method="post">

                                                <div class="divisoria1__cardapio-Main">
                                                    <div class="imgLanche"><img class="lancheIMG" src="<?php echo $produto["CaminhoImagem"]; ?>" alt=""></div>
                                                    <div class="descricaoLanche"><b>
                                                            <p class="txtDescricai"><?php echo $produto["Descricao"]; ?></p>
                                                        </b></div>
                                                </div>

                                                <div class="Valrlanhes__MAIN">
                                                    <b>
                                                        <p class="Valrlanhes"> R$ <?php echo $produto["Valor"]; ?></p>
                                                    </b>
                                                </div>
                                                <div class="divisoria1__cardapio-BTN">
                                                    <input type="hidden" name="idLanche" value="<?php echo $produto["id"]; ?>" />
                                                    <input type="hidden" name="Nome" value="<?php echo $produto["Nome"]; ?>" />
                                                    <input type="hidden" name="Valor" value="<?php echo $produto["Valor"]; ?>" />
                                                    <?php

                                                    if (isset($_SESSION['usuario'])) {
                                                        $usuario = $_SESSION['usuario'];

                                                        $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                                                        $comandoSQL = $conexao->query("SELECT * FROM usuario where usuario = '$usuario' ");

                                                        while ($linhaBD = $comandoSQL->fetch()) {

                                                            $codCliente =  $linhaBD["codigo"];

                                                    ?>
                                                            <input type="hidden" name="codCliente" value="<?php echo $codCliente; ?>" />
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <input type="hidden" name="Quantidade" value="1" />
                                                    <div class="botaoLanche__main">
                                                        <?php if ($produto["Quantidade"] > 0) { ?>
                                                            <button class="botaoLanche" type="Submit">Escolher</button>
                                                        <?php } else { ?>
                                                            <button class="botaoLanche" disabled>Fora de Estoque</button>
                                                        <?php } ?>
                                                    </div>


                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                } catch (PDOException $e) {
                    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('.botaoLanche').click(function(event) {
            event.preventDefault();

            var form = $(this).closest('form');
            var formData = form.serialize();

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                success: function(response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Lanche adicionado ao carrinho!',
                        showConfirmButton: false,
                        timer: 5500
                    });
                },
                error: function(xhr, status, error) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Ocorreu um erro ao adicionar o lanche ao carrinho.',
                        text: error
                    });
                }
            });
        });
    });
</script>



</html>