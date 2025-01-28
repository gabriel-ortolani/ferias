<?php
include('conexao.php');
session_start(); // Certifique-se de iniciar a sessão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Pega os dados do usuário
        $usuario = $result->fetch_assoc();
        // Armazena as informações do usuário na sessão
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
    } else {
        $error = "Usuário ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br" class="html2">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>
<body class="body2">
    <form method="POST" class="login">
        <h1>Login</h1>
        <label for="email">Email:</label>
        <input type="text" name="email" require>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" require>
        <button type="submit">enviar</button>
        <!-- Exibe mensagem de erro, caso exista -->
        <?php if (isset($error)) echo "<p class='message error'>$error</p>"; ?>
    </form>
</body>
</html>