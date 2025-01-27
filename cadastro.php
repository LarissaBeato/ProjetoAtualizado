<?php
session_name('iniciar');
session_start();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../projeto/CSSprojeto/cadastro.css">
    <title>Cadastro</title>
</head>
<body>
    <header class="cadastro"></header>

    <div class="titulo">
        <h1>CADASTRO</h1>
    </div>

    <form method="post" action="">
        <div class="container">
            <div class="input-group">
                <label for="name">Nome Completo:</label><br>
                <input type="text" id="name" name="name" required><br>
            </div>
            
            <div class="input-group">
                <label for="telefone">Telefone:</label><br>
                <input type="tel" id="telefone" name="telefone" required>
            </div>

            <div class="input-group">
                <label for="cpf">CPF:</label><br>
                <input type="text" id="cpf" name="cpf" required>
            </div>

            <div class="input-group">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="senha">Senha:</label><br>
                <input type="password" id="senha" name="senha" required>
            </div>

            <button type="submit" name="Entrar">Enviar</button>
            <button type="button" onclick="window.location.href='login.php'">Voltar para o Login</button>
        </div>
    </form>
    <footer class="footer"></footer>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Entrar"])) {
    include_once("connect.php");
    $obj = new connect();
    $resultado = $obj->conectarBanco();

    $email = $_POST["email"];
    $sqlCheck = "SELECT COUNT(*) FROM Cadastro WHERE email = :email";
    $queryCheck = $resultado->prepare($sqlCheck);
    $queryCheck->execute([':email' => $email]);
    $emailExists = $queryCheck->fetchColumn();

    if ($emailExists > 0) {
        echo "<script>alert('Este e-mail já está cadastrado!');</script>";
    } else {
        $senhaCriptografada = password_hash($_POST["senha"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO Cadastro (nomeCompleto, telefone, CPF, email, senha) VALUES (:nomeCompleto, :telefone, :cpf, :email, :senha)";
        $query = $resultado->prepare($sql);
        
        $query->bindParam(':nomeCompleto', $_POST["name"]);
        $query->bindParam(':telefone', $_POST["telefone"]);
        $query->bindParam(':cpf', $_POST["cpf"]);
        $query->bindParam(':email', $_POST["email"]);
        $query->bindParam(':senha', $senhaCriptografada);

        if ($query->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar!');</script>";
        }
    }
    unset($_POST["nomeCompleto"], $_POST["endereco"], $_POST["telefone"], $_POST["CPF"], $_POST["email"]);
}
?>
