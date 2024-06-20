<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="icone" rel="shortcut icon" href="icon.png" /> 
    <title>Tela de login</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }

        div {
            background-color: rgba(0, 0, 0, 0.9);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
        }

        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }

        .button {
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }

        .button:hover {
            background-color: deepskyblue;
            cursor: pointer;
        }

        #link {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div>
        <h1>Login</h1>
        <form action="testLogin.php" method="POST">
            <input type="text" name="email" placeholder="CPF/email">
            <br><br>
            <input type="password" name="senha" placeholder="Senha">
            <br><br>
            <input class="button" type="submit" name="submit" value="Enviar"><br><br>
            <!-- <a id="link" href="cadastro.php">Não tem cadastro? Clique aqui</a> -->
        </form>
    </div>
</body>

</html>