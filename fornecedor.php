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

    include_once ('conexao.php');

    $cnpj = $_POST['cnpj'];
    $razao_social = $_POST['razao_social'];
    $inscricao_estadual = $_POST['inscricao_estadual'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];


    $result = mysqli_query($conexao, "INSERT INTO fornecedor(cnpj,razao_social,inscricao_estadual,endereco,cidade,estado,cep,telefone) 
        VALUES ('$cnpj','$razao_social','$inscricao_estadual','$endereco','$cidade','$estado','$cep','$telefone')");

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Fornecedor</title>
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
        <h2 class="mb-4">Cadastro de Fornecedor</h2>
        <form action="fornecedor.php" method="POST" id="formFornecedor">
            <div class="form-group">
                <label for="cnpj">CNPJ: </label>
                <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="Digite o CNPJ">
            </div>
            <div class="form-group">
                <label for="razaoSocial">Razão Social:</label>
                <input type="text" name="razao_social" class="form-control" id="razao_social"
                    placeholder="Digite a Razão Social">
            </div>
            <div class="form-group">
                <label for="inscricaoEstadual">Inscrição Estadual:</label>
                <input type="text" name="inscricao_estadual" class="form-control" id="inscricao_estadual"
                    placeholder="Digite a Inscrição Estadual">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" class="form-control" id="rua" placeholder="Digite o nome da Rua">

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="enderecoCidade">Cidade:</label>
                    <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Digite a Cidade">
                </div>
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" class="form-control" id="telefone" placeholder="(xx) x xxxx-xxxx">
                </div>
                <div class="form-group col-md-4">
                    <label for="enderecoEstado">Estado:</label>
                    <select name="estado" class="form-control" id="estado">
                        <option value="">Selecione...</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="enderecoCep">CEP:</label>
                    <input type="text" name="cep" class="form-control" id="cep" placeholder="Digite o CEP">
                </div>
            </div>

            <input type="submit" class="btn btn-primary" name="submit" value="Enviar">
            <a href="index.html" class="btn btn-secondary ml-2">Voltar</a>
            <a href="relatorios/rel_forn.php" class="btn btn-secondary">Buscar fonecedores</a>
        </form>

    </div>


</body>

</html>