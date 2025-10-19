<?php

require_once 'Product.php';

try {
    $dsn = 'mysql:host=localhost;dbname=udt';
    $username = 'udt_user';
    $password = 'secretPassword123%';
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $product = new Product($pdo);

    $product->seedTable('product.csv');

} catch (Exception $e) {
    echo $e . PHP_EOL;
} 

$pdo = null;