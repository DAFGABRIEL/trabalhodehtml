<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleconfirmation.css">
    <title>FONFON STORE</title>
</head>
<body>
    <h1>Compra Confirmada</h1>

    <p>Obrigado por sua compra, <?php echo $_SESSION['username']; ?>!</p>

    <h2>Detalhes da Compra:</h2>
    <?php
    $pickupTime = isset($_POST['pickup_time']) ? $_POST['pickup_time'] : '';
    $totalPrice = isset($_POST['total_price']) ? $_POST['total_price'] : '';

    echo "<p>Horário de Retirada: $pickupTime</p>";
    echo "<p>Total da Compra: R$$totalPrice,00</p>";
    ?>

    <button><a href="index.php">Voltar para a Página Inicial</a></button>
</body>
</html>