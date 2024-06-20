<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "conexao.php";
    
    $cnpj = $_POST['cnpj'];
    $razao_social = $_POST['razao_social'];
    $numero_nota = $_POST['numeroNota'];
    $numero_serie = $_POST['numeroSerie'];
    $chave_acesso = $_POST['chaveAcesso'];
    $quantidade_itens = $_POST['quantidadeItens'];

    // Verifica se a chave de acesso já está cadastrada no banco de dados
    $query_check = "SELECT * FROM nota WHERE chave_acesso = '$chave_acesso'";
    $result_check = mysqli_query($conexao, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Se a chave de acesso já estiver cadastrada, mostra um alerta
        echo "<script>alert('NOTA FISCAL JÁ CADASTRADA');</script>";
    } else {
        // Se a chave de acesso não estiver cadastrada, insere uma nova nota fiscal
        $sql_nota = "INSERT INTO nota (cnpj, razao_social, numero_nota, serie, chave_acesso) 
                     VALUES ('$cnpj', '$razao_social', '$numero_nota', '$numero_serie', '$chave_acesso')";

        if (mysqli_query($conexao, $sql_nota)) {
            // Se a inserção foi bem-sucedida, mostra um alerta de sucesso
            echo "<script>alert('FORMULÁRIO ENVIADO COM SUCESSO');</script>";

            // Insere os itens na tabela produtos
            $nota_id = mysqli_insert_id($conexao);
            for ($i = 1; $i <= $quantidade_itens; $i++) {
                $codigo_produto = $_POST["codigoProduto$i"];
                $quantidade_recebida = $_POST["quantidadeRecebida$i"];

                $sql_produto = "INSERT INTO produtos (cnpj, razao_social, numero_nota, quantidade_recebida, codigo_produto) 
                                VALUES ('$cnpj', '$razao_social', '$numero_nota', '$quantidade_recebida', '$codigo_produto')";
                
                mysqli_query($conexao, $sql_produto);
            }
        } else {
            // Se houver um erro ao inserir a nota, mostra um alerta de erro
            echo "<script>alert('ERRO AO INSERIR DADOS: " . mysqli_error($conexao) . "');</script>";
        }
    }

    mysqli_close($conexao); // Fecha a conexão com o banco de dados
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Notas Fiscais</title>
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
        <h2 class="mb-4">Cadastro de Nota Fiscal</h2>
        <form action="nota.php" method="POST" onsubmit="return validarFormulario()">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="cnpj">CNPJ do Fornecedor:</label>
                    <input name="cnpj" type="text" class="form-control" id="cnpj" placeholder="Digite o CNPJ do fornecedor">
                </div>
                <div class="form-group col-md-6">
                    <label for="fornecedor">Nome do Fornecedor:</label>
                    <input name="razao_social" type="text" class="form-control" id="fornecedor"
                        placeholder="Nome do fornecedor" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="numeroNota">Número da Nota Fiscal:</label>
                    <input name="numeroNota" type="text" class="form-control" id="numeroNota" placeholder="Digite o número da nota fiscal">
                </div>
                <div class="form-group col-md-6">
                    <label for="numeroSerie">Número de Série:</label>
                    <input name="numeroSerie" type="text" class="form-control" id="numeroSerie" placeholder="Digite o número de série">
                </div>
                <div class="form-group col-md-12">
                    <label for="chaveAcesso">Chave de Acesso:</label>
                    <input name="chaveAcesso" type="text" class="form-control" id="chaveAcesso" placeholder="Digite a chave de acesso">
                </div>
            </div>
            <div class="form-group">
                <label for="quantidadeItens">Quantidade de Itens Recebidos:</label>
                <input name="quantidadeItens" type="number" class="form-control" id="quantidadeItens"
                    placeholder="Digite a quantidade de itens">
            </div>
            <div id="itensRecebidos"></div>
            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            <a href="index.html" class="btn btn-secondary mt-3 ml-2">Voltar</a>
            <a href="relatorios/rel_notas.php" class="btn btn-secondary mt-3 ml-2">Buscar notas fiscais</a>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        $(document).ready(function () {
            $('#quantidadeItens').on('input', function () {
                var quantidade = $(this).val();
                $('#itensRecebidos').empty();
                for (var i = 1; i <= quantidade; i++) {
                    $('#itensRecebidos').append(`
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="codigoProduto${i}">Código do Produto ${i}:</label>
                <input type="text" class="form-control" name="codigoProduto${i}" id="codigoProduto${i}" placeholder="Digite o código do produto">
              </div>
              <div class="form-group col-md-6">
                <label for="quantidadeRecebida${i}">Quantidade Recebida ${i}:</label>
                <input type="number" class="form-control" name="quantidadeRecebida${i}" id="quantidadeRecebida${i}" placeholder="Digite a quantidade recebida">
              </div>
            </div>
          `);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

</body>

</html>
