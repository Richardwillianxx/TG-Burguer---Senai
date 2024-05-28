<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>alterar</title>
</head>

<body>
    <div class="fundobody">
        <div class="borda">
            <div class="geral">
                <div class="AlterarUsuarioMostrar">
                    <div class="formulario">
                        <img src="../imgs/logocortado.png" class="imglogo2">
                        <?php
                        function alterar()
                        {
                            $nome = $_POST['qual'];
                            $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                            $comandoSQL = $conexao->query("SELECT * FROM usuario where usuario = '$nome'");
                            while (($linhaBD = $comandoSQL->fetch())) {
                                echo ' <form action="AlterarDoAlterarUsuario.php" method="post">';
                                echo '<input type="hidden" name="id" value="' . $linhaBD['codigo'] . '">';
                        ?>
                                <div class="espacosInput"></div>
                                <div class="espacosInput">
                                    <label class="infos" for="nome">Nome:</label>
                                    <input type="text" class="form-control" required readonly  id="nome" name="nome" value="<?php echo $linhaBD['nome']; ?>" placeholder="usuario">
                                </div>
                                <div class="espacosInput">
                                    <label class="infos" for="usuario">Usuário:</label>
                                    <input type="text" class="form-control" required readonly  id="usuario" name="usuario" value="<?php echo $linhaBD['usuario']; ?>" placeholder="usuario">
                                </div>
                                <div class="espacosInput">
                                    <label class="infos" for="email">E-mail:</label>
                                    <input type="text" class="form-control" required readonly  id="email" name="email" value="<?php echo $linhaBD['email']; ?>" placeholder="usuario">
                                </div>
                                <div class="espacosInput">
                                    <label class="infos" for="telefone">Telefone:</label>
                                    <input type="text" class="form-control" required readonly  id="telefone" name="telefone" value="<?php echo $linhaBD['telefone']; ?>" placeholder="usuario">
                                </div>
                                <div class="espacosInput">
                                    <label class="infos" for="senha">Senha:</label>
                                    <input type="text" class="form-control" required readonly  id="senha" name="senha" value="<?php echo $linhaBD['senha']; ?>" placeholder="usuario">
                                </div>
                                <div class="espacosInput">
                                </div>
                                    <?php
                                    $opcoesFuncao = array(
                                        "administrador" => "Administrador",
                                        "vendedor" => "Vendedor",
                                        "cliente" => "Cliente"
                                    );
                                    echo '<label for="funcao">Função:</label>';
                                    echo '<select class="form-select" id="funcao" name="funcao">';
                                    foreach ($opcoesFuncao as $key => $value) {
                                        $selected = ($linhaBD['funcao'] == $key) ? 'selected' : '';
                                        echo "<option class='funcao' value='$key' $selected>$value</option>";
                                    }
                                    echo '</select><br/>';
                                    ?>
                               
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button class="btncor" type="submit" value="Salvar">Salvar</button>
                                </div>
                        <?php
                                echo '</form>';
                            }
                        }
                        alterar();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>