<?php
if (isset($_POST["idLanche"], $_POST["novaQuantidade"])) {
    $idLanche = $_POST["idLanche"];
    $novaQuantidade = $_POST["novaQuantidade"];

    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
    $comandoSQL = $conexao->query("SELECT Quantidade, Valor, ValorDeCada FROM Carrinho " .
        " WHERE idLanche = " . $idLanche);

    while ($linhaBD = $comandoSQL->fetch()) {
        $valorEncontrado = $linhaBD["Valor"];
    }

    $valorDeCada= $novaQuantidade * $valorEncontrado;

    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

    $scriptAtualizar = "UPDATE Carrinho SET Quantidade = :novaQuantidade, ValorDeCada = :valordecada WHERE idLanche = :idLanche";
    $stmt = $conexao->prepare($scriptAtualizar);
    $stmt->bindParam(':idLanche', $idLanche);
    $stmt->bindParam(':novaQuantidade', $novaQuantidade);
    $stmt->bindParam(':valordecada', $valorDeCada);
    $stmt->execute();
}
else{
header("Location: carrinho.php");
}
