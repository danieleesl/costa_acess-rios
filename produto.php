<?php

session_start();
// print_r($_SESSION);
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');

}
$logado = $_SESSION['email'];

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    include_once('conexao.php'); // Inclui a conexão com o banco de dados

    // Use coalescência nula para evitar erros de chave indefinida
    $cnpj = $_POST['cnpj'] ?? ''; 
    $razao_social = $_POST['razao_social'] ?? ''; 
    $codigo_produto = $_POST['codigo_produto'] ?? '';
    $descricao_produto = $_POST['descricao_produto'] ?? '';
    $ncm = $_POST['ncm'] ?? ''; 
    $observacao = $_POST['observacao'] ?? '';
    $custo = $_POST['custo'] ?? '';
    $venda = $_POST['venda'] ?? '';

    // Verifica se algum campo obrigatório está vazio
    if (empty($cnpj) || empty($codigo_produto) || empty($descricao_produto) || empty($custo) || empty($venda)) {
        echo "<script>alert('Alguns dados não foram preenchidos. Verifique e tente novamente.');</script>";
    } else {
        // Se todos os campos estão preenchidos, verifica se o código do produto já está cadastrado
        $query_check = "SELECT * FROM produto WHERE codigo_produto = '$codigo_produto'";
        $result_check = mysqli_query($conexao, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Se o código do produto já estiver em uso, mostra um alerta
            echo "<script>alert('CÓDIGO DE PRODUTO EM USO');</script>";
        } else {
            // Se o código do produto não estiver cadastrado, insere um novo produto
            $query_insert = "INSERT INTO produto(cnpj, razao_social, codigo_produto, descricao_produto, ncm, observacao, custo, venda) 
                             VALUES ('$cnpj', '$razao_social', '$codigo_produto', '$descricao_produto', '$ncm', '$observacao', '$custo', '$venda')";

            if (mysqli_query($conexao, $query_insert)) {
                // Se a inserção for bem-sucedida, mostra um alerta de sucesso
                echo "<script>alert('FORMULÁRIO ENVIADO COM SUCESSO');</script>";
            } else {
                // Se houver um erro ao inserir, mostra um alerta de erro
                echo "<script>alert('ERRO AO INSERIR DADOS: " . mysqli_error($conexao) . "');</script>";
            }
        }
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Produtos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h2 class="mb-4">Cadastro de Produtos</h2>
        <form action="produto.php" method="POST" id="formProduto">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cnpj">CNPJ do Fornecedor:</label>
                    <input name="cnpj" type="text" class="form-control" id="cnpj"
                        placeholder="Digite o CNPJ do fornecedor">
                </div>
                <div class="form-group col-md-6">
                    <label for="fornecedor">Nome do Fornecedor:</label>
                    <input name="razao_social" type="text" class="form-control" id="fornecedor"
                        placeholder="Nome do fornecedor" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="codigoProduto">Código do Produto:</label>
                    <input name="codigo_produto" type="text" class="form-control" id="codigoProduto"
                        placeholder="Digite o código do produto">
                </div>
                <div class="form-group col-md-6">
                    <label for="descricaoProduto">Descrição do Produto:</label>
                    <input name="descricao_produto" type="text" class="form-control" id="descricaoProduto"
                        placeholder="Digite a descrição do produto">
                </div>
                <div class="form-group col-md-6">
                    <label for="ncm">NCM:</label>
                    <input name="ncm" type="text" class="form-control" id="ncm" placeholder="Digite o código NCM">
                </div>
                <div class="form-group col-md-6">
                    <label for="observacao">Observação</label>
                    <input name="observacao" type="text" class="form-control" id="observacao"
                        placeholder="Digite uma observação">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="valorCusto">Valor de Custo:</label>
                    <input name="custo" type="text" class="form-control" id="valorCusto"
                        placeholder="Digite o valor de custo">
                </div>
                <div class="form-group col-md-6">
                    <label for="valorVenda">Valor de Venda:</label>
                    <input name="venda" type="text" class="form-control" id="valorVenda"
                        placeholder="Digite o valor de venda">
                </div>

            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
            <a href="index.html" class="btn btn-secondary ml-2">Voltar</a>
            <a href="relatorios/rel_produtos.php" class="btn btn-secondary ml-2">Buscar produtos</a>
        </form>
    </div>

</body>

<!-- Script JavaScript para buscar o nome do fornecedor -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#cnpj').keyup(function () {
            var cnpj = $(this).val();
            $.ajax({
                url: 'buscar_fornecedor.php',
                type: 'POST',
                data: { cnpj: cnpj },
                success: function (response) {
                    $('#fornecedor').val(response);
                },
                error: function () {
                    $('#fornecedor').val('Erro ao buscar fornecedor');
                }
            });
        });
    });
</script>

</html>