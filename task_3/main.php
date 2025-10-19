<?php

ini_set('error_log', 'log.txt');

try {
    $dsn = 'mysql:host=localhost;dbname=udt';
    $username = 'udt_user';
    $password = 'secretPassword123%';
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $result = $pdo->query("SELECT * FROM product");

    while ($row = $result->fetch()) {
        echo $row['name'] . PHP_EOL;
    }
} catch (Exception $e) {
    echo $e . PHP_EOL;
    error_log($e, 0);
} 

$pdo = null;