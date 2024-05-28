<?php

function SomaValores(){
    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

    $consulta = $conexao->prepare("SELECT SUM(ValorDeCada) AS total_valor FROM Carrinho WHERE processamento = 0");
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    $totalValor = $resultado["total_valor"];

    return $totalValor;
}

$ItensSomados = SomaValores();


