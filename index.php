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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela inicial</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .brand-text {
            font-size: 3rem;
            text-align: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Costa Acessórios</a>
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
    <h1 class="brand-text">Costa Acessórios</h1>
    <!-- Carousel -->
    <!-- <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="static/img1.png" class="d-block w-100" alt="first slide">
            </div>
            <div class="carousel-item">
                <img src="static/img2.png" class="d-block w-100" alt="first slide">
            </div>
            <div class="carousel-item">
                <img src="static/img3.png" class="d-block w-100" alt="first slide">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>