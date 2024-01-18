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
    <link rel="stylesheet" href="css/styleproducts.css">
    <title>FONFON STORE</title>
</head>
<body>
    <h1>Bem vindo, <?php echo $_SESSION['username']; ?>!</h1>

    <div class="product">
        <h2>Produto 1 (a1)</h2>
        <p>Preço: R$<span id="price1">100.00</span></p>
        <button onclick="addToCart('Produto1')">Adicionar ao Carrinho</button>
    </div>

    <div class="product">
        <h2>Produto 2 (a2)</h2>
        <p>Preço: R$<span id="price2">200.00</span></p>
        <button onclick="addToCart('Produto2')">Adicionar ao Carrinho</button>
    </div>

    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
    <?php
    if (isset($_SESSION['is_master']) && $_SESSION['is_master']) {
        echo '<button onclick="redirectToAllPurchases()"><a href="all_purchases.php">Ir para Todas as Compras</a></button>';
    }
    ?>

    <button><a href="cart.php">Ir para o Carrinho</a></button>
<script>
function addToCart(productName) {
    if (!sessionStorage.getItem('cart')) {
        sessionStorage.setItem('cart', JSON.stringify([]));
    }

    let cart = JSON.parse(sessionStorage.getItem('cart'));

    fetch('get_product_price.php?productName=' + encodeURIComponent(productName))
        .then(response => response.json())
        .then(data => {
            cart.push({ name: productName, price: data.price });

            sessionStorage.setItem('cart', JSON.stringify(cart));

            addToProductsFile(productName);

            let userChoice = confirm('Produto adicionado ao carrinho. Deseja ver o carrinho agora?');

            if (userChoice) {
                window.location.href = 'cart.php';
            } else {
                window.location.href = 'products.php';
            }
        })
        .catch(error => console.error('Error:', error));
}

    function addToProductsFile(productName) {
        let username = "<?php echo isset($_SESSION['username']) ? strtolower($_SESSION['username']) : ''; ?>";

        if (username && productName) {
            let productString = username + '/' + productName + '\n';

            fetch('add_to_products.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'productString=' + encodeURIComponent(productString),
            })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }
    }

    function displayCartTotal() {
        let cart = JSON.parse(sessionStorage.getItem('cart'));
        let total = 0;

        if (cart) {
            cart.forEach(item => {
                total += item.price;
            });
        }

        console.log('Total do carrinho: R$' + total.toFixed(2));
    }
    window.onload = displayCartTotal;
</script>
</body>
</html>