<?php

session_start();
$usuario =  $_SESSION['usuario'];


$nome = $_POST["nome"];
$email= $_POST["email"];
$telefone =  $_POST["telefone"];
$senha =  $_POST["senha"];


$conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");

$comandoSQL = $conexao->prepare("UPDATE usuario SET nome = :nome, telefone = :telefone, 

email = :email,
telefone = :telefone,
senha = :senha
 WHERE usuario = :usuarioAntigo");

$comandoSQL->bindParam(':nome', $nome);
$comandoSQL->bindParam(':email', $email);
$comandoSQL->bindParam(':telefone', $telefone);
$comandoSQL->bindParam(':senha', $senha);

$comandoSQL->bindParam(':usuarioAntigo', $usuario);

$comandoSQL->execute();

header("Location: ../phps/perfil.php");

echo "Perfil " . $usuario . " atualizado com sucesso!<BR/><BR/>";

?>