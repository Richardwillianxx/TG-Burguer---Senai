<html>

<head>
    <link rel="stylesheet" href="../../PaginaInicial/css/NovaSenha.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="geral">
        <div>
            <center>
                <form class="formulario" action="#" method="post">
                    <img src="../../PaginaInicial/imgs/logocortado.png" class="imglogo2">
                    <p class="recupere">Recupere sua senha</p>
                    <div class="form-floating mb-3 ">
                        <input type="text" class="form-control" required name="cpfCadastro" id="cpfCadastro" placeholder="cpfCadastro" maxlength="14">
                        <label for="cpfCadastro">Digite o CPF cadastrado</label>
                        <script>
                            const cpfInput = document.getElementById('cpfCadastro');

                            cpfInput.addEventListener('input', () => {
                                const cpf = cpfInput.value.replace(/\D/g, '');
                                cpfInput.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
                            });
                        </script>
                    </div>
                    <button type="submit" class="botão">Buscar</button>
                </form>

            </center>

            <?php
            if (isset($_POST['cpfCadastro'])) {
                $cpf = $_POST['cpfCadastro'];

                $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
                $stmt = $conexao->prepare("SELECT * FROM usuario WHERE cpf=:cpfCadastro");
                $stmt->bindParam(':cpfCadastro', $cpf);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    foreach ($result as $produto) {
                        $produto["cpf"];
            ?>
                        <center>
                            <div class="formulario2">
                                <div class="usuarioSenha">
                                    <?php
                                    echo "<h5 class='exibiUsuário'>Usuário: " . $produto['usuario'] . "</h5>";
                                    echo "<br>";
                                    ?>
                                </div>
                                <form action="#" method="post">
                                    <div class="inputs">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" required name="novaSenha" id="novaSenha" placeholder="Nova Senha" minlength="8" maxlength="15">
                                            <label for="novaSenha">Digite a nova senha</label>
                                        </div>
                                        <input type="hidden" name="cpfCadastro" value="<?php echo $cpf; ?>">
                                        <button type="submit" class="botão">Atualizar Senha</button>
                                </form>
                            </div>
                        </center>
            <?php
                    }
                } else {
                    echo "Esse cpf não está cadastrado em nosso sistema. Faça seu Cadastro";

                    echo '<a href="../index/index.php"><button class="botão">Cadastrar</button></a>';
                }
            }

            if (isset($_POST["novaSenha"])) {
                $novaSenha = $_POST["novaSenha"];
                $cpf = $_POST["cpfCadastro"];
                $stmt2 = $conexao->prepare("UPDATE usuario SET senha=:senha WHERE cpf=:cpfCadastro");
                $stmt2->bindParam(':senha', $novaSenha);
                $stmt2->bindParam(':cpfCadastro', $cpf);
                $stmt2->execute();
                echo 'Senha Atualizada';
                header(("Location: login.php"));
            }
            ?>
        </div>
    </div>
</body>

</html>