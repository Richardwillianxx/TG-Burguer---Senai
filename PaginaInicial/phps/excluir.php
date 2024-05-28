<?php

$id_usuario = $_POST['qual'];
$conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");

$sql = "DELETE FROM usuario WHERE usuario = '$id_usuario' ";
$stmt = $conexao->prepare($sql);
$stmt->execute();
header("location:usuario.php");

?>
