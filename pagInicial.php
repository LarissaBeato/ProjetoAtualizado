<?php
session_name('iniciar');
session_start();
    
if (!isset($_SESSION['id_user'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../projeto/CSSprojeto/pagInicial.css">
    <title>Página Inicial</title>
</head>
<body>
<header class="inicial"></header>

<div class="titulo">
    <h1>BEM-VINDO</h1>
</div>

<div class="login">
    <div class="login-box">
        <img src="curso.jpg" alt="Imagem de Login" class="login-image">
        <div class="login-content">
            <h2>Cursos</h2>
            <p class="justificar"><b>Investir em conhecimento é o caminho mais seguro para alcançar seus objetivos. Começar um curso hoje é plantar a semente do sucesso que você colherá amanhã!</b></p>
            <button class="login-button"onclick="window.location.href='cursos.php'">Clique Aqui</button>
        </div>
    </div>

    <div class="login-box">
        <img src="trabalho.webp" alt="Imagem de Login" class="login-image">
        <div class="login-content">
            <h2>Oportunidades de Trabalho</h2>
            <p class="justificar"><b>Cada pequeno passo dado hoje é uma construção sólida para o seu futuro. Não espere pelo momento perfeito, faça do agora a sua oportunidade de crescer e realizar!</b></p>
            <button class="login-button"onclick="window.location.href='vagas.php'">Clique Aqui</button>
        </div>
    </div>
    
</div>

<footer>
    <div class = "icone">
        <a href= "logoff.php"><i class='bx bxs-exit'></i></a>
    </div>
</footer>
    
</body>
</html>


