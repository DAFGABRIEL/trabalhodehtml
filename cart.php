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
    <link rel="stylesheet" href="css/stylecart.css">
    <title>FONFON STORE</title>
</head>
<body>
    <?php if (empty($cartItems)): ?>
        <p>O carrinho está vazio.</p>
    <?php else: ?>
        <h1>Carrinho de Compras</h1>
        <ul>
            <?php foreach ($cartItems as $productName => $quantity): ?>
                <li><?php echo $productName; ?> - Quantidade: <?php echo $quantity; ?></li>
            <?php endforeach; ?>
        </ul>

        <p>Produto(s) adicionado(s) ao carrinho. Deseja <a href="checkout.php">finalizar a compra</a> ou <a href="products.php">continuar comprando</a>?</p>
    <?php endif; ?>
</body>
</html>