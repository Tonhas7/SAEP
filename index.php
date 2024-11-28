<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ínicio</title>
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
        .wid {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
            width: 80%;
            margin-left: 10%; 
            border-radius: 10px;
            margin-top: 20px; 
        }
        .wid h2 {
            color: white;
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Página Inicial</h1>
            <nav>
                <a href="index.php">Página Inicial</a>
                <a href="usuarios.php">Usuários</a>
                <a href="tarefas.php">Tarefas</a>
                <a href="gerenciar.php">Gerenciar Tarefa</a>
            </nav>
        </div>
    </header>
    <div class="wid">
        <h2>Bem-vindo à tela inicial</h2>
    </div>
</body>
</html>
