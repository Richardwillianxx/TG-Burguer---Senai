<html>
    <head>
        <title>Alterar Senha</title>
        <link href="../css/alteracao.css"  rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="geral">
        <?php
            function alterar(){
                session_start();
                            $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                            $usuario =  $_SESSION['usuario'];
                        
                            $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
                            $result = $conexao->query($sql);
                            $registro = $result->fetch();
        ?> <div class="formulario">
            <img src="../imgs/logocortado.png" class="imglogo2">
        <?php
                        echo ' <form action="../php do perfil/alterar.php" method="post">';
                        echo '<input type="hidden" class="form-control" name="id" value="'.$registro['codigo'].'">';

                        echo '<div class="alinha">';
                        echo '<div class="form-floating mb-3 ">';
                        echo '<label for="nome" class="recupere2">Nome :</label>';
                        echo '<input type="text" class="mudanca" id="nome" name="nome" value="'.$registro['nome'].'"><br/>';
                        echo '</div>';

                        echo '<div class="form-floating mb-3 ">';
                        echo '<label for="email" class="recupere2">Email :</label>';
                        echo '<input type="email" class="mudanca" id="email" name="email" value="'.$registro['email'].'"><br/>';
                        echo '</div>';

                        echo '<div class="form-floating mb-3 ">';
                        echo '<label for="telefone" class="recupere2">Telefone :</label>';
                        echo '<input type="text" class="mudanca" id="telefone" name="telefone" maxlength="11" value="'.$registro['telefone'].'"><br/>';
                            ?> <script>
                                    const telefoneInput = document.getElementById('telefone');
                                    telefoneInput.addEventListener('input', () => {
                                    const telefone = telefoneInput.value.replace(/\D/g, '');
                                    telefoneInput.value = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                                    });
                                </script>
                            <?php
                        echo '</div>';

                        echo '<div class="form-floating mb-3 ">';
                        echo '<label for="senha" class="recupere2">Senha :</label>';
                        echo '<input type="text" class="mudanca" id="senha" name="senha" minlength="8" maxlength="15" value="'.$registro['senha'].'"><br/>';
                        echo '</div>';

                        echo '</div>';
                        echo '<input type="submit" value="Salvar" class="botão">';
                        echo '</form>'; 
                        
                                }
                    alterar();
        ?></div>
    </body>

</html>
