<?php
session_name('iniciar');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Entrar"])) {
    include_once("connect.php");
    $obj = new connect();
    $resultado = $obj->conectarBanco();

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sqlCheck = "SELECT id_user, senha FROM Cadastro WHERE email = :email";
    $queryCheck = $resultado->prepare($sqlCheck);
    $queryCheck->execute([':email' => $email]);
    $user = $queryCheck->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['senha'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['email'] = $email;

            echo "<script> window.location.href='pagInicial.php';</script>";
        } else {
            echo "<script>alert('Senha incorreta.'); </script>";
        }
    } else {
        echo "<script>alert('Usuário e senha não existem, verifique!');</script>";

            $nomeArquivo = 'logs/log.txt';

            $arquivo = fopen($nomeArquivo, 'a+');

            if ($arquivo) {
                $conteudo = "\nTentativa de login falhada:\n";
                $conteudo .= "Data: " . date('d/m/y') . "\n";
                $conteudo .= "Email: " . $_POST["email"] . "\n";
                $conteudo .= "Senha: " . $_POST["password"] . "\n"; 
                $conteudo .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
                fwrite($arquivo, $conteudo);
                fclose($arquivo);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../projeto/CSSprojeto/login.css">
    <title>Login</title>
</head>
<body>
    <header class="login"></header>

    <div class="titulo">
        <h1>LOGIN</h1>
    </div>

    <form method="post" action="login.php">
        <div class="container">
            <div class="input-group">
                <label for="email">Email:</label><br>
                <i class='bx bxs-user-circle'></i>
                <input type="email" id="email" name="email" required><br>
            </div>
            
            <div class="input-group">
                <label for="password">Senha:</label><br>
                <i class='bx bxs-lock-alt'></i>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" name="Entrar">Entrar</button>
            <button type="button" onclick="window.location.href='cadastro.php'">Cadastrar</button>
        </div>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <footer></footer>
</body>
</html>
