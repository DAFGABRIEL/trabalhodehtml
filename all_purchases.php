<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['is_master']) || !$_SESSION['is_master']) {
    header('Location: products.php');
    exit();
}

// Aqui você incluiria a lógica para obter todas as compras feitas, por exemplo, de um banco de dados
// Substitua isso com a lógica real

// $allPurchases = obterTodasAsCompras(); 

// Exemplo de compras simuladas (substitua isso com a lógica real)
$allPurchases = [
    ['username' => 'user1', 'product' => 'ProdutoA', 'price' => 100, 'pickup_time' => '10:00'],
    ['username' => 'user2', 'product' => 'ProdutoB', 'price' => 150, 'pickup_time' => '14:30'],
    // ... mais compras
];
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FONFON STORE</title>
</head>
<body>
    <h1>Todas as Compras</h1>

    <table>
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Horário de Retirada</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allPurchases as $purchase): ?>
                <tr>
                    <td><?php echo $purchase['username']; ?></td>
                    <td><?php echo $purchase['product']; ?></td>
                    <td>R$<?php echo $purchase['price']; ?>,00</td>
                    <td><?php echo $purchase['pickup_time']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="products.php">Voltar para a Página Inicial</a>
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>