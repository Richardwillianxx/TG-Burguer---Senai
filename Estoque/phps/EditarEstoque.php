<?php
if (isset($_GET['id'])) {
    $codigo = $_GET['id'];

    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
    $stmt = $conexao->prepare("SELECT * FROM Estoque WHERE id = :id");
    $stmt->bindParam(':id', $codigo);
    $stmt->execute();
    $produto = $stmt->fetch();

    if (!$produto) {
        echo "Produto não encontrado.";
        exit();
    }
} else {
    echo "ID do produto não especificado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nomeAtualizado"];
    $categorias = $_POST["categoriasAtualizada"];
    $valor = $_POST["valorAtualizado"];
    $quantidade = $_POST["quantidadeAtualizada"];
    $descricao = $_POST["descricaoAtualizada"];
    $caminhoimagem = $_POST["caminhoimagemAtualizado"];

    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
    $stmt = $conexao->prepare("UPDATE Estoque SET Nome = :nome, Categoria = :categoria, Valor = :valor, Quantidade = :quantidade, Descricao = :descricao, CaminhoImagem = :caminhoimagem  WHERE id = :id");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':categoria', $categorias);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':caminhoimagem', $caminhoimagem);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "Produto atualizado com sucesso!";
    header("Location: validarEstoque.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>

<body>

    <div class="title">
        <h2 class="modal-title">Editar Produto</h2>
    </div>

    <form action="#" method="POST">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

        <div class="NomeProduto">
            <label for="nome">Nome do Produto</label>
            <input type="text" id="nome" name="nomeAtualizado" placeholder="Nome do produto" value="<?php echo $produto['Nome']; ?>">
        </div>

        <div class="Categorias">
            <label for="categorias">Categoria</label>
            <select id="categorias" name="categoriasAtualizada">
                <option value="">Selecione uma categoria</option>
                <option value="categoria1" <?php if ($produto['Categoria'] == 'categoria1') echo 'selected'; ?>>Categoria 1</option>
                <option value="categoria2" <?php if ($produto['Categoria'] == 'categoria2') echo 'selected'; ?>>Categoria 2</option>
                <option value="categoria3" <?php if ($produto['Categoria'] == 'categoria3') echo 'selected'; ?>>Categoria 3</option>
            </select>
        </div>

        <div class="Valor">
            <label for="valor">Valor:</label>
            <input type="text" id="valor" name="valorAtualizado" placeholder="Valor do produto" value="<?php echo $produto['Valor']; ?>">
        </div>

        <div class="Quantidade">
            <label for="quantidade">Quantidade:</label>
            <input type="text" id="quantidade" name="quantidadeAtualizada" placeholder="Quantidade do produto" value="<?php echo $produto['Quantidade']; ?>">
        </div>



        <div class="Descricao">
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricaoAtualizada" placeholder="Descrição do produto" value="<?php echo $produto['Descricao']; ?>">
        </div>
        
        <div class="Descricao">
            <label for="Caminho Imagem">Caminho Imagem:</label>
            <input type="text" id="CaminhoImagem" name="caminhoimagemAtualizado" placeholder="Caminho Imagem:" value="<?php echo $produto['CaminhoImagem']; ?>">
        </div>

        <div class="botao-Enviar">
            <input type="submit" value="Atualizar Produto">
        </div>
    </form>

</body>

</html>
