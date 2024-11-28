<?php
$servername = "localhost";
$database = "Tarefausu";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

$sql = "
    SELECT t.tar_codigo, t.tar_setor, t.tar_prioridade, t.tar_descricao, t.tar_status, u.usu_nome
    FROM tbl_tarefas t
    JOIN tbl_usuarios u ON t.usu_codigo = u.usu_codigo
    WHERE t.tar_status IN ('a fazer', 'fazendo', 'pronto')
    ORDER BY FIELD(t.tar_status, 'a fazer', 'fazendo', 'pronto')
";
$result = mysqli_query($conn, $sql);

if (isset($_POST['update_status'])) {
    $tar_codigo = $_POST['tar_codigo'];
    $new_status = $_POST['new_status'];

    $update_sql = "UPDATE tbl_tarefas SET tar_status = '$new_status' WHERE tar_codigo = $tar_codigo";
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Status da tarefa atualizado com sucesso!');window.location='gerenciar.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar status: " . mysqli_error($conn) . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Tarefas</title>
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
            padding: 20px;
        }
        .status-section {
            margin-bottom: 30px;
        }
        .status-section h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
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
            <h1>Gerenciar Tarefas</h1>
            <nav>
                <a href="index.php">Página Inicial</a>
                <a href="usuarios.php">Usuários</a>
                <a href="tarefas.php">Tarefas</a>
                <a href="gerenciar.php">Gerenciar Tarefa</a>
            </nav>
        </div>
    </header>
    <div class="formContainer">
        <div class="status-section">
            <h2>A Fazer</h2>
            <table>
                <thead>
                    <tr>
                        <th>Usuário Associado</th>
                        <th>Setor</th>
                        <th>Prioridade</th>
                        <th>Descrição</th> 
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    mysqli_data_seek($result, 0);  
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['tar_status'] == 'a fazer') {
                            echo "<tr>";
                            echo "<td>" . $row['usu_nome'] . "</td>";
                            echo "<td>" . $row['tar_setor'] . "</td>";
                            echo "<td>" . $row['tar_prioridade'] . "</td>";
                            echo "<td>" . $row['tar_descricao'] . "</td>";
                            echo "<td>
                                <form action='gerenciar.php' method='POST'>
                                    <input type='hidden' name='tar_codigo' value='" . $row['tar_codigo'] . "'>
                                    <select name='new_status'>
                                        <option value='a fazer' " . ($row['tar_status'] == 'a fazer' ? 'selected' : '') . ">A Fazer</option>
                                        <option value='fazendo' " . ($row['tar_status'] == 'fazendo' ? 'selected' : '') . ">Fazendo</option>
                                        <option value='pronto' " . ($row['tar_status'] == 'pronto' ? 'selected' : '') . ">Pronto</option>
                                    </select>
                                    <button type='submit' name='update_status' class='action-btn'>Alterar Status</button>
                                </form>
                            </td>";
                            echo "<td>
                                    <a href='editarTar.php?id=" . $row['tar_codigo'] . "' class='action-btn'>Editar</a> | 
                                    <a href='gerenciar.php?delete=" . $row['tar_codigo'] . "' class='action-btn' onclick='return confirm(\"Tem certeza que deseja excluir esta tarefa?\")'>Excluir</a>
                                  </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="status-section">
            <h2>Fazendo</h2>
            <table>
                <thead>
                    <tr>
                        <th>Usuário Associado</th>
                        <th>Setor</th>
                        <th>Prioridade</th>
                        <th>Descrição</th> 
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    mysqli_data_seek($result, 0);  
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['tar_status'] == 'fazendo') {
                            echo "<tr>";
                            echo "<td>" . $row['usu_nome'] . "</td>";
                            echo "<td>" . $row['tar_setor'] . "</td>";
                            echo "<td>" . $row['tar_prioridade'] . "</td>";
                            echo "<td>" . $row['tar_descricao'] . "</td>";
                            echo "<td>
                                <form action='gerenciar.php' method='POST'>
                                    <input type='hidden' name='tar_codigo' value='" . $row['tar_codigo'] . "'>
                                    <select name='new_status'>
                                        <option value='a fazer' " . ($row['tar_status'] == 'a fazer' ? 'selected' : '') . ">A Fazer</option>
                                        <option value='fazendo' " . ($row['tar_status'] == 'fazendo' ? 'selected' : '') . ">Fazendo</option>
                                        <option value='pronto' " . ($row['tar_status'] == 'pronto' ? 'selected' : '') . ">Pronto</option>
                                    </select>
                                    <button type='submit' name='update_status' class='action-btn'>Alterar Status</button>
                                </form>
                            </td>";
                            echo "<td>
                                    <a href='editarTar.php?id=" . $row['tar_codigo'] . "' class='action-btn'>Editar</a> | 
                                    <a href='gerenciar.php?delete=" . $row['tar_codigo'] . "' class='action-btn' onclick='return confirm(\"Tem certeza que deseja excluir esta tarefa?\")'>Excluir</a>
                                  </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="status-section">
            <h2>Pronto</h2>
            <table>
                <thead>
                    <tr>
                        <th>Usuário Associado</th>
                        <th>Setor</th>
                        <th>Prioridade</th>
                        <th>Descrição</th> 
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    mysqli_data_seek($result, 0);  
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['tar_status'] == 'pronto') {
                            echo "<tr>";
                            echo "<td>" . $row['usu_nome'] . "</td>";
                            echo "<td>" . $row['tar_setor'] . "</td>";
                            echo "<td>" . $row['tar_prioridade'] . "</td>";
                            echo "<td>" . $row['tar_descricao'] . "</td>";
                            echo "<td>
                                <form action='gerenciar.php' method='POST'>
                                    <input type='hidden' name='tar_codigo' value='" . $row['tar_codigo'] . "'>
                                    <select name='new_status'>
                                        <option value='a fazer' " . ($row['tar_status'] == 'a fazer' ? 'selected' : '') . ">A Fazer</option>
                                        <option value='fazendo' " . ($row['tar_status'] == 'fazendo' ? 'selected' : '') . ">Fazendo</option>
                                        <option value='pronto' " . ($row['tar_status'] == 'pronto' ? 'selected' : '') . ">Pronto</option>
                                    </select>
                                    <button type='submit' name='update_status' class='action-btn'>Alterar Status</button>
                                </form>
                            </td>";
                            echo "<td>
                                    <a href='editarTar.php?id=" . $row['tar_codigo'] . "' class='action-btn'>Editar</a> | 
                                    <a href='gerenciar.php?delete=" . $row['tar_codigo'] . "' class='action-btn' onclick='return confirm(\"Tem certeza que deseja excluir esta tarefa?\")'>Excluir</a>
                                  </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    if (isset($_GET['delete'])) {
        $tar_codigo = $_GET['delete'];
        $sql = "DELETE FROM tbl_tarefas WHERE tar_codigo = $tar_codigo";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Tarefa excluída com sucesso!');window.location='gerenciar.php';</script>";
        } else {
            echo "<script>alert('Erro ao excluir tarefa: " . mysqli_error($conn) . "');</script>";
        }
    }
    ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
