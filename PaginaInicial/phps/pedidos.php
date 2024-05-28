<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap");

        body {
            height: 98vh;
            background-color: #3d3d3d;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 19px;
            font-weight: 700;
            font-family: "Ubuntu", sans-serif;
            color: #ffffff;
        }

        .tudo {
            display: flex;
            justify-content: center;
        }

        .pedido-info {
            border-radius: 10px;
            border: 1.2px solid #202020;
            box-shadow: 4px 4px 7px rgba(0, 0, 0, 0.2), 0 0 10px rgba(0, 0, 0, 0.1);
            width: 540px;
            background-color: #000000;
            padding: 3vh;
        }

        .titulopedido {
            font-size: 19px;
            font-weight: 700;
            padding: 7px 0 20px;
            /* Ajuste a partir de 7px para 7px 0 20px */
            color: #ffffff;
        }

        .pedido {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ffffff;
            text-align: center;
        }

        .botaoFecharPedido__Main {
            margin-top: 3vh;
        }

        .botaoFecharPedido {
            background-color: rgb(231, 151, 3);
            color: #ffffff;
            transition: 0.3s;
            border-radius: 25px;
            width: 200px;
            height: 45px;
            font-size: 20px;
            border: none;
        }

        .botaoFecharPedido:hover {
            background-color: rgb(231, 151, 3);
            cursor: pointer;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="tudo">
        <div class="pedido-info">
            <img src="../imgs/logocortado.png" class="imglogo">
            <?php
            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

            if (isset($_POST["NumeroPedido"]) && isset($_POST["MetodoPagamento"])) {
                $NumeroPedido = $_POST["NumeroPedido"];
                $metodopagamento = $_POST["MetodoPagamento"];

                $scriptInserir = "UPDATE Carrinho SET Processamento = 1, NumeroPedido = :numeropedido, MetodoPagamento = :metodopagamento WHERE Processamento = 0";
                $stmt = $conexao->prepare($scriptInserir);
                $stmt->bindParam(':numeropedido', $NumeroPedido);
                $stmt->bindParam(':metodopagamento', $metodopagamento);
                $stmt->execute();

                $conexaoPedidos = $conexao->prepare("SELECT * FROM Carrinho WHERE Processamento = 1 AND NumeroPedido = :numeropedido");
                $conexaoPedidos->bindParam(':numeropedido', $NumeroPedido);
                $conexaoPedidos->execute();
            } 
                $conexaoPedidos = $conexao->prepare("SELECT * FROM Carrinho WHERE Processamento = 1 AND NumeroPedido = :numeropedido");
                $conexaoPedidos->bindParam(':numeropedido', $NumeroPedido);
                $conexaoPedidos->execute();

                ?>
                <?php if (isset($NumeroPedido)) { ?>
                    <h1 class="titulopedido">Seu Pedido #<?php echo $NumeroPedido; ?></h1>
                <?php } else { ?>
                    <p class="titulopedido">Número do pedido não encontrado.</p>
                <?php } ?>

                <?php
                $result = $conexaoPedidos->fetchAll(PDO::FETCH_ASSOC);
                $primeiraVez = true;
                if ($result) {
                ?>
                    <div class="centralizar">
                        <div class="pedido">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Lanche</th>
                                        <th>Quantidade</th>
                                        <th>Valor Unitário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $linhaBD) {
                                        if ($primeiraVez) {
                                    ?>
                                            <tr>
                                                <td><?php echo $linhaBD["Nome"]; ?></td>
                                                <td><?php echo $linhaBD["Quantidade"]; ?></td>
                                                <td>R$ <?php echo $linhaBD["ValorDeCada"]; ?></td>
                                            </tr>
                                        <?php
                                            $primeiraVez = false;
                                        } else {
                                        ?>
                                            <tr>
                                                <td><?php echo $linhaBD["Nome"]; ?></td>
                                                <td><?php echo $linhaBD["Quantidade"]; ?></td>
                                                <td>R$ <?php echo $linhaBD["ValorDeCada"]; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else {
                    echo "<p>Nenhum pedido encontrado.</p>";
                }
                ?>


                <div class="MetodoPagamento">
                    <p><?php echo $linhaBD["MetodoPagamento"]; ?></p>
                </div>

                <hr>
                <?php

                if ($stmt->execute()) {
                    $consultaLanches = $conexao->prepare("SELECT idLanche, Quantidade FROM Carrinho WHERE Processamento = 1 AND NumeroPedido = :numeropedido");
                    $consultaLanches->bindParam(':numeropedido', $NumeroPedido);
                    $consultaLanches->execute();

                    while ($linha = $consultaLanches->fetch(PDO::FETCH_ASSOC)) {
                        $idLanche = $linha['idLanche'];
                        $quantidadeComprada = $linha['Quantidade'];

                        $consultaEstoque = $conexao->prepare("SELECT Quantidade FROM Estoque WHERE id = :idLanche");
                        $consultaEstoque->bindParam(':idLanche', $idLanche);
                        $consultaEstoque->execute();

                        $linhaEstoque = $consultaEstoque->fetch(PDO::FETCH_ASSOC);
                        $quantidadeAtual = $linhaEstoque['Quantidade'];

                        $novaQuantidade = $quantidadeAtual - $quantidadeComprada;

                        $atualizaEstoque = $conexao->prepare("UPDATE Estoque SET Quantidade = :novaQuantidade WHERE id = :idLanche");
                        $atualizaEstoque->bindParam(':novaQuantidade', $novaQuantidade);
                        $atualizaEstoque->bindParam(':idLanche', $idLanche);
                        $atualizaEstoque->execute();
                    }
                }

                ?>
                    
                <div class="botaoFecharPedido__Main">
                    <button class="botaoFecharPedido" onclick="fecharPagina()">Fechar Pedido</button>
                <script>
                    function fecharPagina() {
                        window.location.href = "../../telaInicial.php";
                    }
                </script>
                </div>

        </div>
    </div>
</body>

</html>
