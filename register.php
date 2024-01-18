<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $user_role = 'user';

    if ($new_username === 'master') {
        $user_role = 'master';
    }

    $user_data = "$new_username:$new_password:$user_role\n";
    file_put_contents('users.txt', $user_data, FILE_APPEND);

    $_SESSION['username'] = $new_username;
    header('Location: products.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylelogin.css">
    <title>FONFON STORE</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <label for="new_username">Novo usuario:</label>
            <input type="text" id="new_username" name="new_username" required>

            <label for="new_password">Nova senha:</label>
            <input type="password" id="new_password" name="new_password" required>

            <button type="submit">Register</button>
        </form>

        <p>Já tem uma conta? <a href="index.php">Entre aqui</a></p>
    </div>
</body>
</html>