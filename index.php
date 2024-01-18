<?php
session_start();

if (isset($_SESSION['username'])) {
    if ($_SESSION['is_master']) {
        header('Location: all_purchases.php');
    } else {
        header('Location: products.php');
    }
    exit();
}

$valid_user = 'user';
$valid_pass = 'pass';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_info = getUserInfo($username);

    if ($user_info && $password === $user_info['password']) {
        $_SESSION['username'] = $username;

        if ($user_info['role'] === 'master') {
            $_SESSION['is_master'] = true;
            header('Location: all_purchases.php');
        } else {
            header('Location: products.php');
        }

        exit();
    } else {
        $error_message = 'Usuário ou senha inválido.';
    }
}

function getUserInfo($username) {
    $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($users as $user) {
        list($existing_username, $existing_password, $role) = explode(':', $user);
        if ($existing_username === $username) {
            return ['username' => $existing_username, 'password' => $existing_password, 'role' => $role];
        }
    }

    return null;
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylelogin.css">
    <title>FONFON STORE - Login</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p>Não tem uma conta? <a href="register.php">Registre-se aqui</a></p>
        <p>Esqueceu sua senha? <a href="">Redefinir senha</a></p>
    </div>
</body>
</html>