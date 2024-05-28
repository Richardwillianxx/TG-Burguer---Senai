<?php
session_start();

if (isset($_POST['sair'])) {
    session_destroy();
    header("Location: perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Perfil</title>
</head>

<body>
    <div class="borda">
        <div class="">
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

                        if (isset($_SESSION['usuario'])) {
                            $usuario = $_SESSION['usuario'];

                            $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                            $comandoSQL = $conexao->query("SELECT * FROM usuario where usuario = '$usuario' ");

                            while ($linhaBD = $comandoSQL->fetch()) {
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
        </div>

        <?php
        if (isset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['logado'])) {

            $usuario = $_SESSION['usuario'];
            $senha = $_SESSION['senha'];
            $logado = $_SESSION['logado'];
        ?>
            <div class="alinhamentoperfil">

                <?php
                $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                $comandoSQL = $conexao->query("SELECT * FROM usuario where usuario = '$usuario' and senha = '$senha'");

                while ($linhaBD = $comandoSQL->fetch()) {

                ?>

                    <div class="bordaPerfil">

                        <div class="imgDoPerfil__Main">
                            <div class="imgDoPerfil">
                                <img src="../imgs/perfil.png" class="imgperfil" alt="">
                            </div>
                        </div>

                        <div class="nomeDoPerfil__Main">
                            <div class="nomePefil"><b><?php echo $linhaBD["usuario"] ?></b></div>
                        </div>

                        <div class="separacao">
                            <div class="dadosPessoais">
                                <div class="UsuarioPerfil__Main">
                                    <div class="UsuarioPerfil__Main-img">
                                        <img src="../imgs/person.png" class="imgUsuario" alt="">
                                    </div>
                                    <div class="UsuarioPerfil"><?php echo $linhaBD["nome"] ?></div>
                                </div>

                                <div class="UsuarioPerfil__Main espacamento">
                                    <div class="UsuarioPerfil__Main-img">
                                        <img src="../imgs/gmail2.png" class="imgUsuario" alt="">
                                    </div>
                                    <div class="UsuarioPerfil"><?php echo $linhaBD["funcao"] ?></div>
                                </div>

                                <div class="UsuarioPerfil__Main espacamento">
                                    <div class="UsuarioPerfil__Main-img">
                                        <img src="../imgs/cpf.png" class="imgUsuario" alt="">
                                    </div>
                                    <div class="UsuarioPerfil"><?php echo $linhaBD["cpf"] ?></div>
                                </div>

                                <div class="UsuarioPerfil__Main espacamento">
                                    <div class="UsuarioPerfil__Main-img">
                                        <img src="../imgs/telefone.png" class="imgUsuario" alt="">
                                    </div>
                                    <div class="UsuarioPerfil"><?php echo $linhaBD["telefone"] ?></div>
                                </div>
                                <div class="UsuarioPerfil__Main espacamento">
                                    <div class="UsuarioPerfil__Main-img">
                                        <img src="../imgs/cargo.png" class="imgUsuario" alt="">
                                    </div>
                                    <div class="UsuarioPerfil"><?php echo $linhaBD["email"] ?></div>
                                </div>

                            </div>

                            <div class="Botoes">
                                <div class="espaco">
                                    <img src="../imgs/logocortado.png" class="logoTG" alt="">
                                </div>
                                <div class="btns">
                                    <form action="PuxarAlteracao.php" method="post">
                                        <button name="button" class="editar" type="submit">Alterar</button>
                                    </form>
                                    <form action="" method="post">
                                        <button name="sair" class="btnsair" type="submit">Sair</button>
                                    </form>
                                </div>

                                <div class="logo">
                                </div>
                            </div>
                        </div>

                    </div>

                <?php
                    $nome = $linhaBD["nome"];
                    $email = $linhaBD["email"];
                    $cpf = $linhaBD["cpf"];
                    $funcao = $linhaBD["funcao"];
                    $telefone = $linhaBD["telefone"];
                }

                ?>
            </div>
        <?php
        } else {
        ?>
            <div class="naologado">
                <div class="fundonaologado">
                    <div>
                        <div class="txtnaologado">
                            <h1 class="txtlogar">Você ainda não fez login!</h1>
                        </div>
                        <div class="">
                            <a href="../../cadastros/login/login.php"><button class="btnlogar">Faça seu Login</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>