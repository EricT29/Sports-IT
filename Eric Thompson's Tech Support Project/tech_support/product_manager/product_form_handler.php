<?php

include '../model/database.php';
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');

if ($action == 'edit_product') {
    $product['productCode'] = filter_input(INPUT_POST, 'productCode');
    $product['name'] = filter_input(INPUT_POST, 'name');
    $product['version'] = filter_input(INPUT_POST, 'version');
    $product['releaseDate'] = filter_input(INPUT_POST, 'releaseDate');

    edit_product($product['productCode'], $product['name'], $product['version'], $product['releaseDate']);
}

if ($action == 'add_product') {
    $product['productCode'] = filter_input(INPUT_POST, 'productCode');
    $product['name'] = filter_input(INPUT_POST, 'name');
    $product['version'] = filter_input(INPUT_POST, 'version');
    $product['releaseDate'] = filter_input(INPUT_POST, 'releaseDate');

    add_product($product['productCode'], $product['name'], $product['version'], $product['releaseDate']);
}

if ($action == 'register_product') {
    $registeredProduct['customerID'] = filter_input(INPUT_POST, 'customerID');
    $registeredProduct['productCode'] = filter_input(INPUT_POST, 'productCode');
    $registeredProduct['registrationDate'] = filter_input(INPUT_POST, 'registrationDate');

    register_product($registeredProduct['customerID'], $registeredProduct['productCode'], $registeredProduct['registrationDate']);
}

if ($action == 'delete_product') {
    $product['productCode'] = filter_input(INPUT_POST, 'productCode');

    delete_product($product['productCode']);
}

