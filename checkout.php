<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$productsFile = 'products.txt';

// Lê os dados do arquivo products.txt
$productsData = file($productsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Filtra os produtos do usuário atual
$userProducts = array_filter($productsData, function ($line) {
    return strpos($line, strtolower($_SESSION['username'])) !== false;
});
// Inicializa um array para os itens no carrinho
$cartItems = [];

// Conta a quantidade de cada produto no carrinho
foreach ($userProducts as $userProduct) {
    list($username, $productName) = explode('/', $userProduct);
    $cartItems[$productName] = isset($cartItems[$productName]) ? $cartItems[$productName] + 1 : 1;
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylecheckout.css">
    <title>FONFON STORE - Checkout</title>
</head>
<body>
    <h1>Checkout</h1>

    <h2>Horário de Retirada:</h2>
        <form action="confirmation.php" method="post">
            <label for="pickup_time">Escolha o horário de retirada:</label>
            <select id="pickup_time" name="pickup_time">
                <?php
                $startHour = 8;
                $endHour = 18;

                for ($hour = $startHour; $hour <= $endHour; $hour++) {
                    $formattedHour = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
                    echo "<option value=\"$formattedHour\">$formattedHour</option>";
                }
                ?>
            </select>

    <?php if (empty($cartItems)): ?>
        <p>O carrinho está vazio. Adicione produtos ao carrinho antes de prosseguir para o checkout.</p>
    <?php else: ?>
        <h2>Itens no Carrinho:</h2>
        <ul>
            <?php foreach ($cartItems as $productName => $quantity): ?>
                <li><?php echo $productName; ?> - Quantidade: <?php echo $quantity; ?></li>
            <?php endforeach; ?>
        </ul>

            <button type="submit">Finalizar Compra</button>
        </form>

        <form action="products.php">
            <button type="submit">Continuar Comprando</button>
        </form>
    <?php endif; ?>
</body>
</html>