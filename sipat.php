
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro SIPAT</title>
    <style>
        body {
            background-color: navy;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            color: navy;
        }
        .form-group {
            margin-bottom: 20px;
        }
        
        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 2px solid navy;
            border-radius: 5px;
        }
        
        input[type="submit"] {
            background-color: navy;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro SIPAT</h2>
        <form action="sipat.php" method="POST">
            <div class="form-group">
                <label for="nome">Digite seu nome:</label><br>
                <input type="text" id="nome" name="nome" required>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    
    if (empty($nome)) {
        echo "<script>alert('Por favor, digite um nome válido!');</script>";
    } else {
        $conexao = new mysqli('localhost', 'root', '123456789', 'cipat_db');
        
        if ($conexao->connect_error) {
            echo "<script>alert('Erro de conexão');</script>";
        } else {
            $sql1 = "INSERT INTO participantes (nome) VALUES (?)";
            $stmt1 = $conexao->prepare($sql1);
            $stmt1->bind_param("s", $nome);
            
            if ($stmt1->execute()) {
                $codigo_participante = $conexao->insert_id;
                
                $sql2 = "INSERT INTO primeiro_dia (nome, codigo_participante) VALUES (?, ?)";
                $stmt2 = $conexao->prepare($sql2);
                $stmt2->bind_param("si", $nome, $codigo_participante);
                
                if ($stmt2->execute()) {
                    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro na palestra');</script>";
                }
                $stmt2->close();
            } else {
                echo "<script>alert('Erro ao cadastrar');</script>";
            }
            
            $stmt1->close();
            $conexao->close();
        }
    }
}
?>

