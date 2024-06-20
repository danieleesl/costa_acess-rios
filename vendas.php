<?php 
session_start();
// print_r($_SESSION);
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');

}
$logado = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vendas</title>
    <!-- Verifique se os links do Bootstrap CSS estão corretos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-group {
            width: 49%;
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 10px;
        }

        .form-group.full-width {
            width: 100%;
        }

        #qtdItens,
        #descontoInput {
            width: 100%;
        }

        #parcelasInput {
            width: 70px;
        }
    </style>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Costa Acessórios</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="vendas.php">Vendas <span class="sr-only"></span></a>
                <a class="nav-item nav-link" href="cliente.php">Clientes</a>
                <a class="nav-item nav-link" href="produto.php">Produtos</a>
                <a class="nav-item nav-link" href="fornecedor.php">Fornecedor</a>
                <a class="nav-item nav-link" href="nota.php">Nota fiscal</a>
                <a class="nav-item nav-link" href="sair.php">Sair</a>
            </div>
        </div>
    </nav>  
    <div class="container mt-5">
        <h2 class="mb-4">Tela de Vendas</h2>
        <form>
            <div class="form-group">
                <label for="cliente">Cliente:</label>
                <input type="text" class="form-control" id="cliente" placeholder="CPF/CNPJ do cliente">
            </div>
            <div class="form-group">
                <label para="nomeCliente">Nome do Cliente:</label>
                <input disabled type="text" class="form-control" id="nomeCliente" placeholder="Nome do cliente">
            </div>
            <div class="form-group full-width">
                <label para="qtdItens">Quantidade de Itens:</label>
                <input type="number" class="form-control" id="qtdItens" placeholder="Quantidade de itens"
                    onchange="createItemFields(this.value)">
            </div>
            <div id="itemFields" class="full-width"></div>
            <div class="form-group full-width">
                <label para="formaPagamento">Forma de Pagamento:</label>
                <select class="form-control" id="formaPagamento" onchange="togglePaymentFields()">
                    <option value="" selected>Selecione</option>
                    <option value="debito">Cartão de Débito</option>
                    <option value="credito">Cartão de Crédito</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="pix">PIX</option>
                </select>
            </div>
            <div class="form-group" id="desconto" style="display:none;">
                <label para="descontoInput">Desconto:</label>
                <input type="number" class="form-control" id="descontoInput" placeholder="Digite o valor do desconto">
            </div>
            <div class="form-group" id="parcelas" style="display:none;">
                <label para="parcelasInput">Número de Parcelas:</label>
                <select class="form-control" id="parcelasInput">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="form-group">
                <label para="valor">Valor total:</label>
                <input disabled type="number" class="form-control" id="valor" placeholder="Valor da venda">
            </div>
            <button type="submit" class="btn btn-primary mr-2">Enviar</button>
            <a href="index.html" class="btn btn-secondary">Voltar</a>
            <a href="relatorios/rel_vendas.php" class="btn btn-secondary">Relatório de vendas</a>
        </form>
    </div>

    <!-- Certifique-se de que jQuery, Popper.js e Bootstrap JavaScript estão corretos -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePaymentFields() {
            var paymentMethod = document.getElementById("formaPagamento").value;
            var descontoField = document.getElementById("desconto");
            var parcelasField = document.getElementById("parcelas");

            if (paymentMethod === 'credito') {
                parcelasField.style.display = 'block';
            } else {
                parcelasField.style.display = 'none';
            }

            if (paymentMethod === 'debito' || 'dinheiro' || 'pix') {
                descontoField.style.display = 'block';
            } else {
                descontoField.style.display = 'none';
            }
        }

        function createItemFields(quantity) {
            var itemFieldsDiv = document.getElementById("itemFields");
            itemFieldsDiv.innerHTML = ""; // Limpa os campos anteriores

            for (var i = 1; i <= quantity; i++) {
                var itemFieldHTML = `
                    <div class="form-group">
                        <label para="produto_${i}">Produto ${i}:</label>
                        <input type="text" class="form-control" id="produto_${i}" placeholder="Digite o código do produto">
                    </div>
                    <div class="form-group">
                        <label para="valorProduto_${i}">Valor do Produto ${i}:</label>
                        <input type="number" class="form-control" id="valorProduto_${i}" placeholder="Valor do produto">
                    </div>
                    <div class="form-group">
                        <label para="nomeProduto_${i}">Nome do Produto ${i}:</label>
                        <input type="text" class="form-control" id="nomeProduto_${i}" placeholder="Nome do produto">
                    </div>
                    <div class="form-group">
                        <label para="qtdProduto_${i}">Quantidade do Produto ${i}:</label>
                        <input type="number" class="form-control" id="qtdProduto_${i}" placeholder="Quantidade do produto">
                    </div>
                `;
                itemFieldsDiv.innerHTML += itemFieldHTML;
            }
        }
    </script>
</body>

</html>