<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/usuario.css">
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
                    <li><a href="./contatos.php"><i class="material-symbols-outlined">call</i> Contatos</a></li>
                    <li><a href="./perfil.php"><i class="material-symbols-outlined">person</i> Perfil</a></li>

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
                            echo '<li><a href="usuario.php"><i class="material-symbols-outlined">A DEFINIR</i> Usuario</a></li>';
                            echo '<li><a href="estoque.php"><i class="material-symbols-outlined">A DEFINIR</i> Estoque</a></a></li>';
                            echo '<li><a href="pedidosVendedor.php"><i class="material-symbols-outlined">A DEFINIR</i> Pedidos</a></a></li>';
                        }
                    } else {
                        echo '<li><a href="../../cadastros/login/login.php"><i class="material-symbols-outlined">login</i> Login</a></li><br>';
                    }

                    ?>

                    <li><a href="./carrinho.php"><i class="material-symbols-outlined">shopping_cart</i> Carrinho</a></li>
                    <img src="../imgs/logocortado.png" class="logomenu">
                </ul>
            </nav>
        </div>
        <div>

            <div class="textoCentral">

                <?php

                session_start();
                $usuario =  $_SESSION['usuario'];


                $nome = $_POST["nome"];
                $email = $_POST["email"];
                $telefone =  $_POST["telefone"];
                $senha =  $_POST["senha"];
                $usuario = $_POST["usuario"];
                $funcao = $_POST["funcao"];


                $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");

                $comandoSQL = $conexao->prepare("UPDATE usuario SET nome = :nome, telefone = :telefone, 

email = :email,
telefone = :telefone,
senha = :senha,
funcao = :funcao,
usuario = :usuario
 WHERE usuario = :usuarioAntigo");

                $comandoSQL->bindParam(':nome', $nome);
                $comandoSQL->bindParam(':email', $email);
                $comandoSQL->bindParam(':telefone', $telefone);
                $comandoSQL->bindParam(':senha', $senha);
                $comandoSQL->bindParam(':usuario', $usuario);
                $comandoSQL->bindParam(':funcao', $funcao);

                $comandoSQL->bindParam(':usuarioAntigo', $usuario);

                $comandoSQL->execute();

                header("Location: usuario.php");

                echo "Perfil " . $usuario . " atualizado com sucesso!<BR/><BR/>";

                ?>

            </div>
            <div>


            </div>
</body>

</html>