<?php

require_once 'Product.php';


$product = new Product();

$product->seedTable('product.csv');