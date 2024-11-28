<?php
$servername = "localhost";
$database = "Tarefausu";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeusuario = $_POST['nomeusuario'];
    $nomeusu = $_POST['nomeusu'];

    $sql = "INSERT INTO tbl_usuarios (usu_nome, usu_email) VALUES ('$nomeusuario', '$nomeusu')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location='usuarios.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar usuário: " . mysqli_error($conn) . "');</script>";
    }
}

$sql = "SELECT * FROM tbl_usuarios";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        h1 {
            color: white;
            padding-left: 20px;
            padding-top: 0px;
            margin: 0;
        }
        .container {
            background-color: black;
            height: 60px;
            width: 80%;
            margin-top: 10px;
            margin-left: 9%;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        nav {
            display: flex;
            gap: 20px; 
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5em 1em;
            border-radius: 5px;
            background-color: gray;
        }
        a:hover {
            color: blue;
        }
        .formContainer {
            max-width: auto;
            margin: 0px 0px 20px 0px;
            padding: 17px;
            background-color: #fff;
            border-radius: 7px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        fieldset {
            margin-bottom: 20px;
            color: blue;
        }
        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 16px;
            color: blue;
        }
        .btn:hover {
            color: blue;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-btn {
            padding: 5px 10px;
            background-color: black;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .action-btn:hover {
            background-color: black;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Usuários</h1>
            <nav>
                <a href="index.php">Página Inicial</a>
                <a href="usuarios.php">Usuários</a>
                <a href="tarefas.php">Tarefas</a>
                <a href="gerenciar.php">Gerenciar Tarefa</a>
            </nav>
        </div>
    </header>

    <div class="formContainer">
        <h1>Cadastro de Usuários</h1>
        <form method="POST" action="usuarios.php" id="POST">
            <fieldset>
                <label style="font-size: 18.7px">Dados do Usuário</label><br><br>
                <input type="hidden" id="id" name="id">
                <label for="nomeusuario">Nome</label>
                <input type="text" id="nomeusuario" name="nomeusuario" placeholder="Digite seu Nome" autofocus required>
                <label for="nomeusu">Email</label>
                <input type="email" id="nomeusu" name="nomeusu" placeholder="Digite seu e-mail" required>
                <input type="submit" value="Cadastrar" class="btn" style="font-size: 16px">
            </fieldset>
        </form>
    </div>

</body>
</html>

<?php
mysqli_close($conn);
?>
