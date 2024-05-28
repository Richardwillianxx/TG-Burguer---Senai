<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ValidarEstoque.css">
    <title>Estoque</title>
</head>

<body>
    <div class="divisoria1">
        <?php
        if (isset($_POST["codigo"], $_POST["nome"], $_POST["categorias"], $_POST["valor"], $_POST["quantidade"],  $_POST["descricao"], $_POST["caminhoimagem"])) {
            $codigo = $_POST["codigo"];
            $nome = $_POST["nome"];
            $categorias = $_POST["categorias"];
            $valor = $_POST["valor"];
            $quantidade = $_POST["quantidade"];
            $descricao = $_POST["descricao"];
            $caminhoimagem = $_POST["caminhoimagem"];

            function inserirEstoque($codigo, $nome, $categorias, $valor, $quantidade, $descricao, $caminhoimagem)
            {
                $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
                $comandoSQL = $conexao->query("SELECT Quantidade FROM Estoque WHERE Codigo =". $codigo);

                $qtdeEncontrada = 0;
                $contador = 0;

                while ($linhaBD = $comandoSQL->fetch()) {
                    $qtdeEncontrada = $linhaBD["Quantidade"];
                    echo $qtdeEncontrada;
                    $contador++;
                }



                if ($contador > 0 ) {
                    $scriptInserir = "UPDATE Estoque SET Quantidade = :quantidade WHERE Nome = :nome";

                    $stmt = $conexao->prepare($scriptInserir);

                    $qtdeEncontrada1 = $quantidade+$qtdeEncontrada;
                    $stmt->bindParam(':quantidade', $qtdeEncontrada1);
                    $stmt->bindParam(':nome', $nome);
                }else {
                    $scriptInserir = "INSERT INTO Estoque (Codigo, Nome, Categoria, Valor, Quantidade, Descricao, CaminhoImagem ) VALUES (:codigo, :nome, :categorias, :valor, :quantidade, :descricao, :caminhoimagem)";
                    $stmt = $conexao->prepare($scriptInserir);

                    $stmt->bindParam(':codigo', $codigo);
                    $stmt->bindParam(':nome', $nome);
                    $stmt->bindParam(':categorias', $categorias);
                    $stmt->bindParam(':valor', $valor);
                    $stmt->bindParam(':quantidade', $quantidade);
                    $stmt->bindParam(':descricao', $descricao);
                    $stmt->bindParam(':caminhoimagem', $caminhoimagem);
                }
                $stmt->execute();
            }

            inserirEstoque($codigo, $nome, $categorias, $valor, $quantidade, $descricao, $caminhoimagem);
        }
        $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
        $scriptInserir = $conexao->query("SELECT * FROM Estoque");
        echo "<br>";

        ?>

        <div class="tabela">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Caminho Imagem </th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($linha = $scriptInserir->fetch()) {
                        echo "<tr>
                                        <td>" . $linha["Codigo"] . "</td>
                                    <td>" . $linha["Nome"] . "</td>
                                    <td>" . $linha["Categoria"] . "</td>
                                    <td>" . $linha["Valor"] . "</td>
                                    <td>" . $linha["Quantidade"] . "</td>
                                    
                                    <td>" . $linha["Descricao"] . "</td>
                                    <td><a href='EditarEstoque.php?id=" . $linha["id"] . "' class=''>Editar Produto</a></td>
                                    <td><a href='ExcluirProdutoEstoque.php?id=" . $linha["id"] . "' class=''>Excluir</a></td>

                                    
                                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="divisoria2">
        <div class="botaoVoltar__main">
            <a class="linkVoltar" href="../inicio.html"><button class="botaoVoltar">
                    < </button></a>
        </div>
    </div>

</body>

</html>