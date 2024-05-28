<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
</head>

<body>
  <div class="tudo">

    <div class="container">

      <form action="#" method="post" id="form1">
        <img src="../../PaginaInicial/imgs/logocortado.png" class="imglogo">
        <div class="tituloform">
          Cadastro de usuário <br />
        </div>
        <div class="inputs">
          <div>
            <div class="form-floating mb-3 ">
              <input type="text" class="form-control" required name="nome" id="nome" placeholder="Nome">
              <label for="nome">Nome</label>
            </div>

            <div class="form-floating mb-3 ">
              <input type="text" class="form-control" required id="cpf" name="cpf" placeholder="Cpf" maxlength="14">
              <label for="cpf">CPF</label>

              <script>
                const cpfInput = document.getElementById('cpf');

                cpfInput.addEventListener('input', () => {
                  const cpf = cpfInput.value.replace(/\D/g, '');
                  cpfInput.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
                });
              </script>
            </div>


            <div class="form-floating mb-3 ">
              <input type="email" class="form-control" required id="email" name="email" placeholder="Email">
              <label for="email">Email</label>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" required id="telefone" name="telefone" placeholder="Telefone" maxlength="11">
              <label for="telefone">Telefone</label>
              <script>
                const telefoneInput = document.getElementById('telefone');
                telefoneInput.addEventListener('input', () => {
                  const telefone = telefoneInput.value.replace(/\D/g, '');
                  telefoneInput.value = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                });
              </script>

            </div>

            <div class="form-floating mb-3 ">
              <input type="text" class="form-control" required id="usuario" name="usuario" placeholder="usuario">
              <label for="usuario">Nome de Usuário</label>
            </div>

            <div class="form-floating mb-3 ">
              <input type="password" required class="form-control" id="senha" name="senha" placeholder="Crie uma senha" minlength="8" maxlength="15">
              <label for="senha">Senha</label>
            </div>
          </div>
        </div>

        <div class="form-floating mb-3 " >
        <input type="hidden" required class="form-control" id="cliente" name="cliente" value="cliente" >
        
        <div class="d-grid gap-2 col-6 mx-auto">
          <button type="submit" class="btn">Cadastrar</button>
        </div>
      </form>

    </div>
    <?php

    if (isset($_POST["nome"])) {
      $nome = $_POST["nome"];
      $cpf =  $_POST["cpf"];
      $email = $_POST["email"];
      $telefone =  $_POST["telefone"];
      $funcao =  $_POST["cliente"];
      $usuario =  $_POST["usuario"];
      $senha =  $_POST["senha"];

      session_start();
      $_SESSION['funcao'] = $funcao;

      $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");

      $verificarUsuario = $conexao->prepare("SELECT * FROM usuario WHERE usuario = :usuario OR cpf = :cpf");
      $verificarUsuario->bindParam(":usuario", $usuario);
      $verificarUsuario->bindParam(":cpf", $cpf);
      $verificarUsuario->execute();

      if ($verificarUsuario->rowCount() > 0) {
        echo '<script>
          Swal.fire({
            icon: "error",
            title: "Usuário ou CPF já existente",
            showConfirmButton: false,
            timer: 1500
          });
        </script>';
      } else {

        $comandoSQL = $conexao->prepare("INSERT INTO usuario(nome, cpf, email, telefone, funcao, usuario, senha) VALUES(:nome, :cpf, :email, :telefone, :funcao,  :usuario, :senha)");
        $comandoSQL->bindParam(":nome", $nome);
        $comandoSQL->bindParam(":cpf", $cpf);
        $comandoSQL->bindParam(":email", $email);
        $comandoSQL->bindParam(":telefone", $telefone);
        $comandoSQL->bindParam(":funcao", $funcao);
        $comandoSQL->bindParam(":usuario", $usuario);
        $comandoSQL->bindParam(":senha", $senha);
        $comandoSQL->execute();
        header("Location: ../login/login.php");
      }
    }
    ?>

  </div>
</body>
</html>