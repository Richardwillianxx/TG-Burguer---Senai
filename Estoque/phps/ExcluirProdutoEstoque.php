<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

    $stmt = $conexao->prepare("DELETE FROM Estoque WHERE id = :id");
    $stmt->bindParam(':id', $id);
    
    $stmt->execute();

    header("Location: Estoque.php");
} else {
    echo "ID do produto não especificado.";
}
?>
