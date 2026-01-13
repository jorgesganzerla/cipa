<?php
    $conexao = new mysqli('', '', '', '', );
    
    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }
?>
<?php
session_start();

echo "
<title>Sorteio SIPAT</title>
<style>
    body {
        background-color: white;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    .container {
        background-color: navy;
        color: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 800px;
        margin: 0 auto;
    }
    .btn {
        background-color: white;
        color: navy;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin: 10px;
    }
    .resultado {
        margin-top: 20px;
        padding: 10px;
        background-color: rgba(255,255,255,0.1);
        border-radius: 5px;
    }
</style>";

echo "
<div class='container'>
    <div style='text-align:center; margin-bottom:20px;'>
        <img src='images/logo_da_uri(oficial).jpg' alt='Imagem CIPAT' width='200' style='margin-right:10px;'>
        <img src='images/cipaImagem.png' alt='Imagem CIPA' width='200'>
    </div>
    <h1>Sorteio SIPAT</h1>
    <form method='post'>
        <button type='submit' name='sortear' class='btn'>Próximo Sorteio</button>
    </form>
    <div class='resultado'>";

if(!isset($_SESSION['sorteio'])) {
    $_SESSION['sorteio'] = [
        'etapa' => 0,
        'participantes' => [],
        'ganhadores' => []
    ];
    
    // Busca participantes com pelo menos 3 palestras
    $query = "SELECT nome, COUNT(*) as contagem 
             FROM participantes 
             GROUP BY nome 
             HAVING COUNT(*) >= 3";
    
    $result = $conexao->query($query);
    
    if($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION['sorteio']['participantes'][] = $row['nome'];
        }
        echo "<p>Participantes elegíveis: " . count($_SESSION['sorteio']['participantes']) . "</p>";
    } else {
        echo "<p>Erro: Nenhum participante com 3 ou mais palestras encontrado.</p>";
    }
}

// Exibir ganhadores anteriores
if(isset($_SESSION['sorteio']['ganhadores']) && count($_SESSION['sorteio']['ganhadores']) > 0) {
    $premios = ['8º Lugar','7º Lugar','6º Lugar','5º Lugar','4º Lugar','3º Lugar', '2º Lugar', '1º Lugar'];
    for($i = 0; $i < count($_SESSION['sorteio']['ganhadores']); $i++) {
        echo "<p><strong>" . $premios[$i] . ":</strong> " . $_SESSION['sorteio']['ganhadores'][$i] . "</p>";
    }
}

if(isset($_POST['sortear'])) {
    $premios = ['8º Lugar','7º Lugar','6º Lugar','5º Lugar','4º Lugar','3º Lugar', '2º Lugar', '1º Lugar'];
    
    if($_SESSION['sorteio']['etapa'] < 8) {
        if(count($_SESSION['sorteio']['participantes']) > 0) {
            $indice_sorteado = array_rand($_SESSION['sorteio']['participantes']);
            $ganhador = $_SESSION['sorteio']['participantes'][$indice_sorteado];
            
            $_SESSION['sorteio']['ganhadores'][] = $ganhador;
            unset($_SESSION['sorteio']['participantes'][$indice_sorteado]);
            $_SESSION['sorteio']['participantes'] = array_values($_SESSION['sorteio']['participantes']);
            
            echo "<p><strong>" . $premios[$_SESSION['sorteio']['etapa']] . ":</strong> " . $ganhador . "</p>";
            $_SESSION['sorteio']['etapa']++;
            
            if($_SESSION['sorteio']['etapa'] == 8) {
                echo "<p>Sorteio finalizado!</p>";
                session_destroy();
            }
        } else {
            echo "<p>Não há participantes suficientes para continuar o sorteio.</p>";
            session_destroy();
        }
    }
}


echo "</div></div>";
?>
