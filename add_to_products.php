<?php
$productString = isset($_POST['productString']) ? $_POST['productString'] : '';

if ($productString) {
    file_put_contents('products.txt', $productString, FILE_APPEND);
    echo 'Produto adicionado com sucesso.';
} else {
    echo 'Erro ao adicionar o produto.';
}