<?php
session_start();
// print_r($_SESSION);
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');

}
$logado = $_SESSION['email'];


if (isset($_POST['submit'])) {
    include_once ('conexao.php'); // Inclui o arquivo de conexão com o banco de dados

    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $data_nasc = $_POST['data_nasc'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Verifica se o CPF já está cadastrado no banco de dados
    $query_check = "SELECT * FROM cliente WHERE cpf = '$cpf'";
    $result_check = mysqli_query($conexao, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Se o CPF já estiver cadastrado, exiba um alerta
        echo "<script>alert('CLIENTE JÁ CADASTRADO');</script>";
    } else {
        // Se o CPF não estiver cadastrado, insira um novo cliente
        $query_insert = "INSERT INTO cliente (nome, cpf, rg, data_nasc, telefone, email) 
                         VALUES ('$nome', '$cpf', '$rg', '$data_nasc', '$telefone', '$email')";

        if (mysqli_query($conexao, $query_insert)) {
            // Se a inserção foi bem-sucedida, exiba um alerta de sucesso
            echo "<script>alert('FORMULÁRIO ENVIADO COM SUCESSO');</script>";
        } else {
            // Se houver um erro ao inserir, exiba um alerta de erro
            echo "<script>alert('ERRO AO INSERIR DADOS: " . mysqli_error($conexao) . "');</script>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <!-- Certifique-se de que o CSS do Bootstrap está sendo carregado corretamente -->
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
        <h2>Cadastro de Clientes</h2>
        <form action="cliente.php" method="POST">
            <div class="mb-3">
                <label para="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cliente"
                    required>
            </div>
            <div class="mb-3">
                <label para="cpf" class="form-label">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF do cliente"
                    required>
            </div>
            <div class="mb-3">
                <label para="rg" class="form-label">RG:</label>
                <input type="text" class="form-control" id="rg" name="rg" placeholder="Digite o RG do cliente" required>
            </div>
            <div class="mb-3">
                <label para="data_nasc" class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
            </div>
            <div class="mb-3">
                <label para="telefone" class="form-label">Telefone:</label>
                <input type="tel" class="form-control" id="telefone" name="telefone"
                    placeholder="Digite o telefone do cliente" required>
            </div>
            <div class="mb-3">
                <label para="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email do cliente"
                    required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Enviar</button>
            <a href="index.html" class="btn btn-secondary">Voltar</a>
            <a href="relatorios/rel_clientes.php" class="btn btn-secondary">Buscar clientes</a>
        </form>
    </div>

    <!-- Carregamento correto do JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>