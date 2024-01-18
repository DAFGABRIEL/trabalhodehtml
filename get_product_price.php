<?php
function getProductPrice($productName) {
    $prices = [
        'Produto1' => 100.00,
        'Produto2' => 200.00,
    ];

    return isset($prices[$productName]) ? $prices[$productName] : 0.00;
}

if (isset($_GET['productName'])) {
    $productName = $_GET['productName'];
    $price = getProductPrice($productName);

    echo json_encode(['price' => $price]);
}