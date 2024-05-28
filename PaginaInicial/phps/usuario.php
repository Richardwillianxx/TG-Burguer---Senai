]
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>Usuarios</title>
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
                            echo '<li><a href="./PaginaInicial/phps/estoque.php">ESTOQUE</a></li>';
                            echo '<li><a href="./PaginaInicial/phps/pedidosVendedor.php">PEDIDOS</a></li>';
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

            <div class="centroUsuario">
                <div class="bordaGeral2">
                    <div class="pedidos__Main2">
                        <div class="titlePedidos">
                            <h1 class="txtPedidos">USUÁRIOS</h1>
                        </div>
                        <div class="divisoriaPedidos">
                            <div class="TodosPedidos__Main2">
                                <?php

                                $usuario =  $_SESSION['usuario'];
                                $senha = $_SESSION['senha'];
                                $logado = $_SESSION['logado'];

                                $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                                $comandoSQL = $conexao->query("SELECT * FROM usuario");



                                while ($linhaBD = $comandoSQL->fetch()) {
                                ?>
                                    <div class="">
                                        <div class="pedidosFeitos2">

                                            <div class="usuarioCadastrado">
                                                <p class="txtPedidosFeitos">Nome: <span class=""><b><?php echo $linhaBD["nome"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Usuario: <span class=""><b><?php echo $linhaBD["usuario"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Funcao: <span class=""><b><?php echo $linhaBD["funcao"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Cpf: <span class=""><b><?php echo $linhaBD["cpf"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Telefone: <span class=""><b><?php echo $linhaBD["telefone"]; ?></b></span></p>
                                                <p class="txtPedidosFeitos">Email: <span class=""><b><?php echo $linhaBD["email"]; ?></b></span></p>
                                            </div>
                                            <div class="usuarioCadastradoBTN">
                                                <div class="botao1">
                                                    <form action="AlterarUsuario.php" method="post">
                                                        <input type="hidden" name="qual" value="<?php echo $linhaBD["usuario"]; ?>">
                                                        <button name="button" class=" CorAlterar" type="submit">Alterar</button>
                                                    </form>
                                                </div>
                                                <div class="botao2">
                                                    <form action="excluir.php" method="post">
                                                        <input type="hidden" name="qual" value="<?php echo $linhaBD["usuario"]; ?>">
                                                        <button name="button" class=" CorExcluir" type="submit">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php

            $usuario =  $_SESSION['usuario'];
            $senha = $_SESSION['senha'];
            $logado = $_SESSION['logado'];

            $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
            $comandoSQL = $conexao->query("SELECT * FROM usuario");

            function sair()
            {
                session_destroy();
                header("location:perfil.php");
            }
            // Chamar a função se não estiver usando o botão submit
            if (isset($_POST['button'])) {
                session_destroy();
                sair();
            }



            ?>



</body>

</html>