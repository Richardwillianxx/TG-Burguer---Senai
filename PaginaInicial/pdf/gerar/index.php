    <?php
    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

    include '../dompdf/autoload.inc.php';

    use Dompdf\Dompdf;



    $stmt = $conexao->prepare("SELECT * FROM Carrinho where Processamento = 1");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = "";

    $pdf = new Dompdf();

    $html = '<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       

        h2{
            font-size: 50px;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
        }


        .idlancheresp,
        .nomeresp,
        .quantidaderesp,
        .valorresp,
        .numpedidoresp,
        .metodopgresp {
            height: 15px;
            align-items: center;
            text-align: center;
            justify-content: center;
        } 

    

    </style>
    </head>
    <body>';
    $html .= '<div class="">
                    <h2 class="">TG Burguer</h2>
            <table class="">
                <thead class="">
                    <tr>
                        <th class="idLanche">idLanche</th>
                        <th class="nome">Nome</th>
                        <th class="quantidade">Quantidade</th>
                        <th class="valor">ValorDeCada</th>
                        <th class="numpedido">NumeroPedido</th>
                        <th class="metodopg">MetodoPagamento</th>
                    </tr>
                </thead>';

    foreach ($result as $row) {
        $html .= ' <tr>';
        $html .= '<td class="idlancheresp">' . $row['idLanche'] . '' . '</td>';
        $html .= '<td class="nomeresp">' . $row['Nome'] . '' . '</td>';
        $html .= '<td class="quantidaderesp">' . $row['Quantidade'] . '' . '</td>';
        $html .= '<td class="valorresp">' . $row['ValorDeCada'] . '' . '</td>';
        $html .= '<td class="numpedidoresp">' . $row['NumeroPedido'] . '' . '</td>';
        $html .= '<td class="metodopgresp">' . $row['MetodoPagamento'] . '' . '</td>';
        $html .= '</tr> <br>';
    }

    $html .= '</table>
        </div>
    </body>
    </html>';

    // echo $html;

    $pdf->loadHtml($html);

    $pdf->setPaper('A4', 'portrait');

    $options = $pdf->getOptions();
    $options->setDefaultFont('Open Sans');

    $pdf->render();

    $pdf->stream();
    ?>
