<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estoque.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>Estoque</title>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
    $(".btnLanches3, .btnLanches, .btnLanches1").click(function(e) {
        e.preventDefault(); 

        var form = $(this).closest('form');
        var formData = form.serialize();

        var quantidadeInput = form.find('.quantidades');
        var quantidadeValue = quantidadeInput.val().trim();
        if (quantidadeValue === '') {
            alert('Por favor, insira a quantidade do produto.');
            return; 
        }

        $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                success: function(response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Produto Adicionado no Estoque',
                        showConfirmButton: false,
                        timer: 500
                    });
                },
                error: function(xhr, status, error) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Ocorreu um erro ao adicionar o lanche ao carrinho.',
                        text: error
                    });
                }
            });
    });
});

</script>

<body>
    <div class="borda">
        <div class="navbar">
            <nav class="menu">
                <input type="checkbox" class="menu-faketrigger" />
                <div class="menu_lines">
                    <!-- span é a linha que fica dentro da nave (itens) -->
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul>
                    <li><a href="../../telaInicial.php"><i class="material-symbols-outlined">home</i> Início</a></li>
                    <li><a href="./sobre.php"><i class="material-symbols-outlined">groups</i> Sobre</a></li>
                    <li><a href="./menu.php"><i class="material-symbols-outlined">restaurant</i> Menu</a></li>
                    <li><a href="./contatos.php"><i class="material-symbols-outlined">call</i> Contatos</a></li>
                    <li><a href="./perfil.php"><i class="material-symbols-outlined">person</i> Perfil</a></li>
                    <li><a href="../imgs/logocortado.png"><i class="material-symbols-outlined">shopping_cart</i> Carrinho</a></li>

                    <?php

                    session_start();

                    if (isset($_SESSION['usuario'])) {
                        $usuario = $_SESSION['usuario'];

                        $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                        $comandoSQL = $conexao->query("SELECT * FROM usuario where usuario = '$usuario' ");

                        while ($linhaBD = $comandoSQL->fetch()) {
                            // echo 'funcao: ' . $linhaBD["funcao"] . '<br/>';
                            $funcao = $linhaBD["funcao"];
                        }

                        if ($funcao == 'vendedor') {
                            echo '<li><a href="estoque.php"><i class="material-symbols-outlined">inventory_2</i> Estoque</a></a></li>';
                            echo '<li><a href="pedidosVendedor.php"><i class="material-symbols-outlined">text_snippet</i> Pedidos</a></a></li>';
                        }

                        if ($funcao == 'administrador') {
                            echo '<li><a href="usuario.php"><i class="material-symbols-outlined">Groups</i> Usuario</a></li>';
                            echo '<li><a href="estoque.php"><i class="material-symbols-outlined">inventory_2</i> Estoque</a></a></li>';
                            echo '<li><a href="pedidosVendedor.php"><i class="material-symbols-outlined">text_snippet</i> Pedidos</a></a></li>';
                        }
                    } else {
                        echo '<li><a href="../../cadastros/login/login.php"><i class="material-symbols-outlined">login</i> Login</a></li><br>';
                    }

                    ?>

                    <img src="../imgs/logoPreto.png" class="logomenu">
                </ul>
            </nav>
            <div class="perfillogo">
                <div class="tamanhor"></div>
                <div class="person"><a href="./carrinho.php"><img src="../imgs/carro.png" class="carimg"></a><a href="./perfil.php"><img src="../imgs/person.png" class="personimg"></a></div>
            </div>
        </div>


        <div>
            <div class="divisoria1">
                <div class="txtEstoque__Main">
                    <h1 class="txtEstoque">ESTOQUE</h1>
                </div>
                <div class="lanches__Main1">
                    <div class="lanches">
                        <div>
                            <form id="form125" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                                <input type="hidden" name="codigo" value="1">
                                <input type="hidden" name="nome" value="X-Salada">
                                <input type="hidden" name="categorias" value="Lanche">
                                <input type="hidden" name="valor" value="22.99">
                                <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                                <input type="hidden" name="caminhoimagem" value="../menu/xsalada.png">
                                <input type="hidden" name="descricao" value="Para quem busca uma opção mais leve, mas não menos saborosa, o X-Salada é perfeito. Um hambúrguer de carne bovina grelhado se une a uma salada caprichada de alface, tomate, cebola, cenoura e repolho. Finalizado com maionese light e molho vinagrete, este lanche é a escolha ideal para quem quer se sentir bem sem abrir mão do sabor!">
                                <div class="btnLanches__Main">
                                    <input form="form125" class="btnLanches" type="submit" value="X-Salada">
                                </div>
                            </form>

                            
                        </div>
                    </div>

                    <div class="lanches">
                        <div>
                            <form id="form252" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                                <input type="text" class="quantidades" name="quantidade" placeholder="Quantidade do produto:" required>
                                <input type="hidden" name="codigo" value="2">
                                <input type="hidden" name="nome" value="X-Bacon">
                                <input type="hidden" name="categorias" value="Lanche">
                                <input type="hidden" name="valor" value="27.99">
                                <input type="hidden" name="caminhoimagem" value="../menu/xbacon.png">
                                <input type="hidden" name="descricao" value="Uma Sinfonia de Sabores. Imagine um hambúrguer suculento de carne bovina, grelhado à perfeição e envolto em um abraço aconchegante de pão macio. A cada mordida, explosões de sabor invadem seu paladar, criando uma sinfonia irresistível!">
                                <div class="btnLanches__Main">
                                    <input form="form252" class="btnLanches" type="submit" value="X-Bacon">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="lanches">
                        <div>
                            <form id="form311" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                                <input type="hidden" name="codigo" value="3">
                                <input type="hidden" name="nome" value="X-Frango">
                                <input type="hidden" name="categorias" value="Lanche">
                                <input type="hidden" name="valor" value="22.99">
                                <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                                <input type="hidden" name="caminhoimagem" value="../menu/xfrango.png">
                                <input type="hidden" name="descricao" value="Imagine um hambúrguer suculento de frango temperado com segredos da família, grelhado à perfeição e envolto em um abraço aconchegante de pão macio. Adicione a isso uma cremosa maionese, alface fresca, tomate suculento e cebola roxa picadinha para um toque crocante. Uma mordida e você será transportado para um paraíso de sabores!">
                                <div class="btnLanches__Main">
                                    <input form="form311" class="btnLanches" type="submit" value="X-Frango">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="lanches">
                        <div>
                            <form id="form234" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                                <input type="hidden" name="codigo" value="4">
                                <input type="hidden" name="nome" value="X-Tudo">
                                <input type="hidden" name="categorias" value="Lanche">
                                <input type="hidden" name="valor" value="30.99">
                                <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                                <input type="hidden" name="caminhoimagem" value="../menu/xtudo.png">
                                <input type="hidden" name="descricao" value="Se você busca um lanche completo que não deixa ninguém para trás, o X-Tudo é a resposta. Um hambúrguer de carne bovina suculento se junta a um hambúrguer de linguiça calabresa, bacon crocante, presunto de alta qualidade e ovo frito para uma explosão de sabores. Finalizado com queijo derretido, maionese, ketchup, mostarda, alface, tomate, cebola e picles, este lanche é um banquete para os seus sentidos!">
                                <div class="btnLanches__Main">
                                    <input form="form234" class="btnLanches" type="submit" value="X-Tudo">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="lanches__Main2">
                    <div class="lanches">
                        <form id="form533" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="5">
                            <input type="hidden" name="nome" value="X-Vegano">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="36.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/xvegano.png">
                            <input type="hidden" name="descricao" value="Quem disse que os veganos não podem se deliciar com um lanche saboroso? O X-Vegano é a prova! Um hambúrguer de proteína vegetal grelhado com temperos secretos se une a alface, tomate, cebola roxa, guacamole e maionese vegana em um sanduíche que vai te surpreender. Uma explosão de sabores que vai te fazer esquecer que não há carne no lanche! ">
                            <div class="btnLanches__Main">
                                <input form="form533" class="btnLanches" type="submit" value="X-Vegano">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form613" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="6">
                            <input type="hidden" name="nome" value="Duplo Burguer">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="34.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/duplo.png">
                            <input type="hidden" name="descricao" value="Para os famintos de plantão, o X-Duplo Burguer é a pedida certa. Duas camadas de hambúrgueres de carne bovina suculentos se unem em um sanduíche épico. Queijo derretido, maionese, alface, tomate, cebola e picles completam essa obra-prima culinária. Prepare-se para um desafio de dar água na boca!">
                            <div class="btnLanches__Main">
                                <input form="form613" class="btnLanches" type="submit" value="Duplo">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form317" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="7">
                            <input type="hidden" name="nome" value="Duplo Cheddar">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="30.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/DuploCheddar.png">
                            <input type="hidden" name="descricao" value="Para os fãs de queijo, o Duplo Cheddar é a realização de um sonho. Duas camadas de suculentos hambúrgueres de carne bovina se unem em um festival de queijo cheddar derretido. A maionese cremosa, o bacon crocante, o frescor da alface, do tomate e da cebola completam essa obra-prima culinária. Prepare-se para uma explosão de sabor em cada mordida!">
                            <div class="btnLanches__Main">
                                <input form="form317" class="btnLanches1" type="submit" value="Duplo Cheddar">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form823" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="8">
                            <input type="hidden" name="nome" value="FranBacon">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="30.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/franbacon.png">
                            <input type="hidden" name="descricao" value="Para os amantes da dupla imbatível, o Franbacon é a escolha perfeita. Um hambúrguer de carne bovina de alta qualidade se une ao bacon crocante em uma sinfonia de sabores. Finalizado com maionese, queijo derretido, alface, tomate e cebola, este lanche é pura satisfação! ">

                            <div class="btnLanches__Main">
                                <input form="form823" class="btnLanches" type="submit" value="FranBacon">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="txtEstoque__Main">
                    <h1 class="txtEstoque">PORÇÃO</h1>
                </div>

                <div class="lanches__Main3">
                    <div class="lanches">
                        <form id="form129" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="9">
                            <input type="hidden" name="nome" value="Porção de Batata Frita com Cheddar e Bacon">
                            <input type="hidden" name="categorias" value="Porção">
                            <input type="hidden" name="valor" value="40.00">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/batata.png">
                            <input type="hidden" name="descricao" value="Batata frita crocante coberta com cheddar derretido e bacon crocante. Uma combinação irresistível!">
                            <div class="btnLanches__Main">
                                <input form="form129" class="btnLanches3" type="submit" value="Batata Cheddar e Bacon">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form120" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="10">
                            <input type="hidden" name="nome" value="Porção de Onion Rings">
                            <input type="hidden" name="categorias" value="Porção">
                            <input type="hidden" name="valor" value="40.00">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/cebolaporcao.png">
                            <input type="hidden" name="descricao" value="Anéis de cebola empanados e fritos até dourar. Crocantes e saborosos!">
                            <div class="btnLanches__Main">
                                <input form="form120" class="btnLanches" type="submit" value="Cebola">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form131" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="11">
                            <input type="hidden" name="nome" value="Porção de Mandioca Frita">
                            <input type="hidden" name="categorias" value="Porção">
                            <input type="hidden" name="valor" value="40.00">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/mandioca.png">
                            <input type="hidden" name="descricao" value="Mandioca cozida e frita até dourar. Crocante por fora e macia por dentro!">
                            <div class="btnLanches__Main">
                                <input form="form131" class="btnLanches" type="submit" value="Mandioca">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form123" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="12">
                            <input type="hidden" name="nome" value="Salada Verde">
                            <input type="hidden" name="categorias" value="Porção">
                            <input type="hidden" name="valor" value="40.00">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/salada.png">
                            <input type="hidden" name="descricao" value="Mix de folhas verdes frescas com tomate, cebola e vinagrete!">
                            <div class="btnLanches__Main">
                                <input form="form123" class="btnLanches" type="submit" value="Salada">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="lanches__Main4">
                    <div class="lanches">
                        <form action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="13">
                            <input type="hidden" name="nome" value="A DEFINIR">
                            <input type="hidden" name="categorias" value="Porção">
                            <input type="hidden" name="valor" value="36.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/xvegano.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input class="btnLanches" type="submit" value="A DEFINIR">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="14">
                            <input type="hidden" name="nome" value="A DEFINIR">
                            <input type="hidden" name="categorias" value="Porção">
                            <input type="hidden" name="valor" value="34.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/duplo.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input class="btnLanches" type="submit" value="A DEFINIR">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="15">
                            <input type="hidden" name="nome" value="A DEFINIR">
                            <input type="hidden" name="categorias" value="Porção">
                            <input type="hidden" name="valor" value="30.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/DuploCheddar.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input class="btnLanches" type="submit" value="A DEFINIR">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="16">
                            <input type="hidden" name="nome" value="A DEFINIR">
                            <input type="hidden" name="categorias" value="Porção">
                            <input type="hidden" name="valor" value="30.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/franbacon.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input class="btnLanches" type="submit" value="A DEFINIR">
                            </div>
                        </form>
                    </div>
                </div> -->

                <div class="txtEstoque__Main">
                    <h1 class="txtEstoque">BEBIDAS</h1>
                </div>

                <div class="lanches__Main5">
                    <div class="lanches">
                        <form id="form17" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="17">
                            <input type="hidden" name="nome" value="Coca-Cola Zero 350ml">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="6.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/cocaZero.png">
                            <input type="hidden" name="descricao" value="Coca-Cola Zero 350ml">
                            <div class="btnLanches__Main">
                                <input form="form17" class="btnLanches3" type="submit" value="Coca-Cola Zero 350ml">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form18" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="18">
                            <input type="hidden" name="nome" value="Coca-Cola Zero 1L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="9.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/cocaZeroMedia.png">
                            <input type="hidden" name="descricao" value="Coca-Cola Zero 1L">
                            <div class="btnLanches__Main">
                                <input form="form18" class="btnLanches3" type="submit" value="Coca-Cola Zero 1L">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form19" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="19">
                            <input type="hidden" name="nome" value="Coca-Cola Zero 2L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="13.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/cocaZeroGrande.png">
                            <input type="hidden" name="descricao" value="Coca-Cola Zero 2L">
                            <div class="btnLanches__Main">
                                <input form="form19" class="btnLanches3" type="submit" value="Coca-Cola Zero 2L">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form20" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="20">
                            <input type="hidden" name="nome" value="Coca-Cola 350ml">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="6.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/coca.png">
                            <input type="hidden" name="descricao" value="Coca-Cola 350ml">
                            <div class="btnLanches__Main">
                                <input form="form20" class="btnLanches3" type="submit" value="Coca-Cola 350ml">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lanches__Main6">
                    <div class="lanches">
                        <form id="form221" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="21">
                            <input type="hidden" name="nome" value="Coca-Cola 1L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="9.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/CocaMedia.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input form="form221" class="btnLanches" type="submit" value="Coca-Cola 1L">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form22" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="22">
                            <input type="hidden" name="nome" value="Coca-Cola 2L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="13.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/CocaGrande.png">
                            <input type="hidden" name="descricao" value="Coca-Cola 2L">
                            <div class="btnLanches__Main">
                                <input form="form22" class="btnLanches3" type="submit" value="Coca-Cola 2L">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form23" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="23">
                            <input type="hidden" name="nome" value="Guarana 350ml">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="5.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/guarana.png">
                            <input type="hidden" name="descricao" value="Guarana 350ml">
                            <div class="btnLanches__Main">
                                <input form="form23" class="btnLanches3" type="submit" value="Guarana 350ml">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form24" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="24">
                            <input type="hidden" name="nome" value="Guarana 1L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="8.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/guaranaMedio.png">
                            <input type="hidden" name="descricao" value="Guarana 1L">
                            <div class="btnLanches__Main">
                                <input form="form24" class="btnLanches3" type="submit" value="Guarana 1L">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lanches__Main7">
                    <div class="lanches">
                        <form id="form25" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="25">
                            <input type="hidden" name="nome" value="Guarana 2L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="12.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/guaranaGrande.png">
                            <input type="hidden" name="descricao" value="Guarana 2L">
                            <div class="btnLanches__Main">
                                <input form="form25" class="btnLanches3" type="submit" value="Guarana 2L">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form26" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="26">
                            <input type="hidden" name="nome" value="Pepsi 350ml">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="6.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/pepsi.png">
                            <input type="hidden" name="descricao" value="Pepsi 350ml">
                            <div class="btnLanches__Main">
                                <input form="form26" class="btnLanches3" type="submit" value="Pepsi 350ml">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form27" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="27">
                            <input type="hidden" name="nome" value="Pepsi 1L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="9.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/pepsiMedia.png">
                            <input type="hidden" name="descricao" value="Pepsi 1L">
                            <div class="btnLanches__Main">
                                <input form="form27" class="btnLanches3" type="submit" value="Pepsi 1L">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form28" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="28">
                            <input type="hidden" name="nome" value="Pepsi 2L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="12.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/pepsiGrande.png">
                            <input type="hidden" name="descricao" value="Pepsi 2L">
                            <div class="btnLanches__Main">
                                <input form="form28" class="btnLanches3" type="submit" value="Pepsi 2L">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lanches__Main8">

                    <div class="lanches">
                        <form id="form29" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="29">
                            <input type="hidden" name="nome" value="Esportivo Abacaxi 600ml">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="5.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/esportivoAbacaxiMedio.png">
                            <input type="hidden" name="descricao" value="Esportivo Abacaxi 600ml">
                            <div class="btnLanches__Main">
                                <input form="form29" class="btnLanches3" type="submit" value="Esportivo Abacaxi 600ml">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form30" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="30">
                            <input type="hidden" name="nome" value="Esportivo Maça 600ml">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="5.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/esportivoMacaMedio.png">
                            <input type="hidden" name="descricao" value="Esportivo Maça">
                            <div class="btnLanches__Main">
                                <input form="form30" class="btnLanches3" type="submit" value="Esportivo Maça 600ml">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form31" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="31">
                            <input type="hidden" name="nome" value="Esportivo Abacaxi 2L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="8.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/esportivoAbacaxi.png">
                            <input type="hidden" name="descricao" value="Esportivo Abacaxi 2L">
                            <div class="btnLanches__Main">
                                <input form="form31" class="btnLanches3" type="submit" value="Esportivo Abacaxi 2L">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form32" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="32">
                            <input type="hidden" name="nome" value="Esportivo Maça 2L">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="8.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/esportivoMaca.png">
                            <input type="hidden" name="descricao" value="Esportivo Maça 2">
                            <div class="btnLanches__Main">
                                <input form="form32" class="btnLanches3" type="submit" value="Esportivo Maça 2">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lanches__Main9">

                    <div class="lanches">
                        <form id="form33" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="33">
                            <input type="hidden" name="nome" value="Suco de Morango">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="7.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/morango.png">
                            <input type="hidden" name="descricao" value="Suco de Morango 500ml">
                            <div class="btnLanches__Main">
                                <input form="form33" class="btnLanches3" type="submit" value="Suco de Morango">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form34" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="34">
                            <input type="hidden" name="nome" value="Suco de Laranja">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="7.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/laranja.png">
                            <input type="hidden" name="descricao" value="Suco de Laranja 500ml">
                            <div class="btnLanches__Main">
                                <input form="form34" class="btnLanches3" type="submit" value="Suco de Laranja">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form35" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="35">
                            <input type="hidden" name="nome" value="Suco de Limão">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="7.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/limao.png">
                            <input type="hidden" name="descricao" value="Suco de Limão 500ml">
                            <div class="btnLanches__Main">
                                <input form="form35" class="btnLanches3" type="submit" value="Suco de Limão">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form id="form36" action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="36">
                            <input type="hidden" name="nome" value="Suco de Abacaxi c/Hortelã">
                            <input type="hidden" name="categorias" value="Bebidas">
                            <input type="hidden" name="valor" value="7.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../bebidas/abacaxiHortela.png">
                            <input type="hidden" name="descricao" value="Suco de Abacaxi c/Hortelã 500ml">
                            <div class="btnLanches__Main">
                                <input form="form36" class="btnLanches3" type="submit" value="Suco de Abacaxi c/Hortelã">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="lanches__Main10">
                    <div class="lanches">
                        <form action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="37">
                            <input type="hidden" name="nome" value="A DEFINIR">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="36.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/xvegano.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input class="btnLanches" type="submit" value="A DEFINIR">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="38">
                            <input type="hidden" name="nome" value="A DEFINIR">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="34.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/duplo.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input class="btnLanches" type="submit" value="A DEFINIR">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="39">
                            <input type="hidden" name="nome" value="A DEFINIR">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="30.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/DuploCheddar.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input class="btnLanches" type="submit" value="A DEFINIR">
                            </div>
                        </form>
                    </div>

                    <div class="lanches">
                        <form action="../../Estoque/phps/ValidarEstoque.php" method="POST">
                            <input type="hidden" name="codigo" value="40">
                            <input type="hidden" name="nome" value="A DEFINIR">
                            <input type="hidden" name="categorias" value="Lanche">
                            <input type="hidden" name="valor" value="30.99">
                            <input type="text" name="quantidade" class="quantidades" placeholder="Quantidade do produto:" required>
                            <input type="hidden" name="caminhoimagem" value="../menu/franbacon.png">
                            <input type="hidden" name="descricao" value="lanche">
                            <div class="btnLanches__Main">
                                <input class="btnLanches" type="submit" value="A DEFINIR">
                            </div>
                        </form>
                    </div>
                </div> -->

            </div>



</body>

</html>