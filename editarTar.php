<?php
$servername = "localhost";
$database = "Tarefausu";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $tar_codigo = $_GET['id'];

    $sql = "SELECT * FROM tbl_tarefas WHERE tar_codigo = $tar_codigo";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Tarefa não encontrada.");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $setor = $_POST['setor'];
    $prioridade = $_POST['prioridade'];
    $descricao = $_POST['descricao'];

    $update_sql = "UPDATE tbl_tarefas SET tar_setor = '$setor', tar_prioridade = '$prioridade', tar_descricao = '$descricao' WHERE tar_codigo = $tar_codigo";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Tarefa atualizada com sucesso!');window.location='gerenciar.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar tarefa: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Tarefa</title>
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
        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 16px;
            color: blue;
        }
        .btn:hover {
            color: blue;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Alterar Tarefa</h1>
            <nav>
                <a href="index.php">Página Inicial</a>
                <a href="usuarios.php">Usuários</a>
                <a href="tarefas.php">Tarefas</a>
                <a href="gerenciar.php">Gerenciar Tarefa</a>
            </nav>
        </div>
    </header>

    <div class="formContainer">
        <h1>Alterar Dados da Tarefa</h1>
        <form method="POST" action="editarTar.php?id=<?php echo $tar_codigo; ?>" id="POST">
            <fieldset>
                <label style="font-size: 18.7px">Alterar Dados da Tarefa</label><br><br>
                <input type="hidden" id="id" name="id" value="<?php echo $row['tar_codigo']; ?>">

                <label for="setor">Setor</label>
                <input type="text" id="setor" name="setor" value="<?php echo $row['tar_setor']; ?>" required>

                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade" required>
                    <option value="baixa" <?php if ($row['tar_prioridade'] == 'baixa') echo 'selected'; ?>>Baixa</option>
                    <option value="média" <?php if ($row['tar_prioridade'] == 'média') echo 'selected'; ?>>Média</option>
                    <option value="alta" <?php if ($row['tar_prioridade'] == 'alta') echo 'selected'; ?>>Alta</option>
                </select>

                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" value="<?php echo $row['tar_descricao']; ?>" required>

                <input type="submit" value="Atualizar" class="btn" style="font-size: 16px">
            </fieldset>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
