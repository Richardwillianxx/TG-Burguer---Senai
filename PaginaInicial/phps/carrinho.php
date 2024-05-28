<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Carrinho</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<?php
require 'funcaoCarrinho.php';

$somaItens = SomaValores();
?>

<body>
    <?php

    $codigoCliente2 = 0;

    if (isset($_POST["idLanche"], $_POST["Quantidade"], $_POST["Nome"], $_POST["Valor"],  $_POST["codCliente"])) {
        $idLanche = $_POST["idLanche"];
        $quantidade = $_POST["Quantidade"];
        $nome = $_POST["Nome"];
        $valor = $_POST["Valor"];
        $valor2 = $_POST["Valor"];
        $codigoCliente = $_POST["codCliente"];

        $processamento = 0;


        function inserirEstoque($idLanche, $quantidade, $nome, $valor, $valor2, $processamento, $codigoCliente)
        {
            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
            $comandoSQL = $conexao->query("SELECT Quantidade, Valor, ValorDeCada FROM Carrinho " .
                " WHERE idLanche = " . $idLanche . " AND processamento = 0");

            $qtdeEncontrada = 0;

            while ($linhaBD = $comandoSQL->fetch()) {
                $qtdeEncontrada = $linhaBD["Quantidade"];
                $valorEncontrado = $linhaBD["Valor"];
            }

            $numpedido = 0;
            $metodopagamento = 'vazio';

            if ($qtdeEncontrada > 0 ) {
                $scriptInserir = "UPDATE Carrinho SET Quantidade = :quantidade, ValorDeCada = :valordecada, NumeroPedido = :numeropedido, MetodoPagamento = :metodopagamento WHERE Processamento = 0 AND Numeropedido = 0 AND idLanche = " . $idLanche;
                $stmt = $conexao->prepare($scriptInserir);

                $qtdeEncontrada = $quantidade + $qtdeEncontrada;
                $stmt->bindParam(':quantidade', $qtdeEncontrada);

                $valorEncontrado = $valor * $qtdeEncontrada;
                $stmt->bindParam(':valordecada', $valorEncontrado);
                $stmt->bindParam(':numeropedido', $numpedido);
                $stmt->bindParam(':metodopagamento', $metodopagamento);
            } else {
                $scriptInserir = "INSERT INTO Carrinho (idLanche, Quantidade, Nome, Valor, ValorDeCada, Processamento, NumeroPedido, MetodoPagamento, idUsuario) VALUES (:idLanche, :quantidade, :nome, :valor, :valordecada, :processamento, :numeropedido, :metodopagamento, :idusuario)";
                $stmt = $conexao->prepare($scriptInserir);

                $stmt->bindParam(':idLanche', $idLanche);
                $stmt->bindParam(':quantidade', $quantidade);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':valor', $valor);
                $stmt->bindParam(':valordecada', $valor2);
                $stmt->bindParam(':processamento', $processamento);
                $stmt->bindParam(':numeropedido', $numpedido);
                $stmt->bindParam(':metodopagamento', $metodopagamento);
                $stmt->bindParam(':idusuario', $codigoCliente);
            }
            $stmt->execute();
        }

        inserirEstoque($idLanche, $quantidade, $nome, $valor, $valor2, $processamento, $codigoCliente);
        header('Location:menu.php');
    }

    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
    $scriptInserir = $conexao->query("SELECT * FROM Carrinho");

    echo "<br>";
    ?>

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
                    <li><a href="#"><i class="material-symbols-outlined">shopping_cart</i> Carrinho</a></li>

                    <?php

                    session_start();


                    if (isset($_SESSION['usuario'])) {
                        $usuario = $_SESSION['usuario'];

                        $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                        $comandoSQL = $conexao->query("SELECT * FROM usuario where usuario = '$usuario' ");

                        while ($linhaBD = $comandoSQL->fetch()) {

                            $funcao = $linhaBD["funcao"];
                            $codigoCliente2 = $linhaBD["codigo"];
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




        <div class="fundocarrinho_Main">
            <div class="fundoocarrinho">
                <div class="fundoocarrinhoItens">
                    <div class="fundoocarrinhoItens__Main">
                        <?php

                        $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
                        $scriptInserir = $conexao->query("SELECT * FROM Carrinho where processamento = 0 AND idUsuario =" . $codigoCliente2);

                        if (isset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['logado'])) {

                            $usuario = $_SESSION['usuario'];
                            $senha = $_SESSION['senha'];
                            $logado = $_SESSION['logado'];
                            $bloqueio = 1;
                        
                            while ($linha = $scriptInserir->fetch()) {
                                $idLanche = $linha["idLanche"];
                                $nome = $linha["Nome"];
                                $quantidade = $linha["Quantidade"];
                                $valor = $linha["Valor"];
                                $valorDeCada = $linha["ValorDeCada"];

                            ?>
                                <div class="itensdoCarrinho">
                                    <div class="nomeLancheCarrinho">
                                        <p class=""><?php echo $nome; ?></p>
                                    </div>
                                    <div class="QuantidaLancheCarrinho">
                                        <div class="" data-id="<?php echo $idLanche; ?>">
                                            <b>
                                                <button class="BotaoCarrinhoqtdmenos" data-id="<?php echo $idLanche; ?>"><b>-</b></button>
                                                <span class="quantidade-atual"><?php echo $quantidade; ?></span>
                                                <button class="BotaoCarrinhoqtdmais" data-id="<?php echo $idLanche; ?>"><b>+</b></button>
                                            </b>
                                        </div>
                                    </div>

                                    <div class="valorLancheCarrinho">
                                        <p class=""><?php echo $valorDeCada; ?></p>
                                    </div>
                                    <div class="LixoLancheCarrinho">
                                        <a href="excluirlanchedocarrinho.php?codigo=<?php echo $linha['id']; ?>">
                                            <img class="ImgLixeira" src="../imgs/Lixo.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        <?php
                        } else {
                            $bloqueio = 0;
                        ?>
                            <div class="naoLogadoCarrinho">
                                <div class="txtnaologado">
                                    <h1 class="txtlogar">Você ainda não fez login!</h1>
                                </div>
                                <div class="btnNaologado__Main">
                                    <a href="../../cadastros/login/login.php"><button class="btnlogar">Faça seu Login</button></a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="fundoocarrinhoExtras">
                    <form action="pedidos.php" method="post">
                        <div class="numpedido">Número do seu pedido será gerado após finalizar seu pedido</div>
                        <div class="ValorPedido"><b>
                                <p class="" name="ValorPedido">Total: <span class="valorPedidoBranco"> <?php echo "R$ " . $somaItens ?></span>
                            </b></p>
                        </div>
                        <div class="formaPGPedido">
                            <div class="formaPGPedidotxt">Forma de Pagamento</div>

                            <table class="teao">
                                <tr>
                                    <td class="cc">
                                        <label>
                                            <input type="radio" checked require name="MetodoPagamento" value="Cartão de Crédito" />
                                            <span name="MetodoPagamento">Cartão de Crédito</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cc">
                                        <label>
                                            <input type="radio" require name="MetodoPagamento" value="Cartão de Débito" />
                                            <span name="MetodoPagamento">Cartão de Débito</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cc">
                                        <label>
                                            <input type="radio" require name="MetodoPagamento" value="Vale Refeição" />
                                            <span>Vale Refeição</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cc">
                                        <label>
                                            <input type="radio" require name="MetodoPagamento" value="Pix" />
                                            <span>Pix</span>
                                        </label>
                                    </td>
                                </tr>
                                <label>

                            </table>
                            <input type="hidden" name="NomeLanche" value="<?php 
                            
                            $nome = isset($nome) ? $nome : null;echo $nome; ?>">
                            
                        
                        </input>
                            <input type="hidden" name="QuantidadeLanche" value="<?php 
                            $quantidade = isset($quantidade) ? $quantidade : null;

                            echo $quantidade; ?>"></input>
                            <input type="hidden" name="ValorPedido" value="<?php echo $somaItens; ?>"></input>

                        </div>

                        <?php
                        $Numeropedido = intval(rand(1, 9999));
                        ?>

                        <input type="hidden" name="NumeroPedido" value="<?php echo $Numeropedido  ?>"></input>

                        <div class="btnFinalizarCompraPedidos__Main">
                            <?php
                            if ($bloqueio == 0) {
                            ?>
                                <button type="submit" id="btnFinalizarCompraPedidosBloqueado" class="btnFinalizarCompraPedidosBloqueado" target="_blank"><b>Faça seu Login</b></button>
                            <?php } else { ?>
                                <button type="submit" class="btnFinalizarCompraPedidos" target="_blank"><b>Finalizar Compra</b></button>
                            <?php } ?>
                        </div>
                        <div class="logoTGCARRINHO"><img class="imglogoTGCARRINHO" src="../imgs/logoPreto.png" alt=""></div>
                </div>

                </form>


            </div>

        </div>

    </div>

    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.BotaoCarrinhoqtdmais').click(function() {
            var idLanche = $(this).attr('data-id');
            var quantidadeAtualElement = $(this).siblings('.quantidade-atual');
            var quantidadeAtual = parseInt(quantidadeAtualElement.text());

            atualizarQuantidade(idLanche, quantidadeAtual + 1, quantidadeAtualElement);
        });

        $('.BotaoCarrinhoqtdmenos').click(function() {
            var idLanche = $(this).attr('data-id');
            var quantidadeAtualElement = $(this).siblings('.quantidade-atual');
            var quantidadeAtual = parseInt(quantidadeAtualElement.text());

            if (quantidadeAtual > 1) {
                atualizarQuantidade(idLanche, quantidadeAtual - 1, quantidadeAtualElement);
            }
        });

        function atualizarQuantidade(idLanche, novaQuantidade, quantidadeElement) {
            $.ajax({
                type: 'POST',
                url: 'atualizar_quantidade.php',
                data: {
                    idLanche: idLanche,
                    novaQuantidade: novaQuantidade
                },

                success: function(response) {
                    location.reload();
                },

                error: function(xhr, status, error) {
                    console.log('Erro ao atualizar quantidade: ' + error);
                }
            });
        }
    });
</script>

<script>
    document.getElementById("btnFinalizarCompraPedidosBloqueado").disabled = true; // Desativa o botão
</script>



</html>