<?php
if (isset($_GET['codigo'])) {

    $codigo = $_GET['codigo'];

    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
    $stmt = $conexao->prepare("DELETE FROM carrinho WHERE id = :codigo");
    $stmt->bindParam(':codigo', $codigo);
    $stmt->execute();

    header("Location: carrinho.php");
    exit();
} else {
    header("Location: carrinho.php");
    exit();
}
