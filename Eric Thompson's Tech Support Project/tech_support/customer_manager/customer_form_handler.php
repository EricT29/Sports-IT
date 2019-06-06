<?php

include '../model/database.php';
require('../model/customer_db.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = filter_input(INPUT_POST, 'action');

if ($action == 'edit_customer') {
    $customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $postalCode = filter_input(INPUT_POST, 'postalCode');
    $countryCode = filter_input(INPUT_POST, 'countryCode');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');

    edit_customer($customerID, $firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email);
}

if ($action == 'add_customer') {
    $customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $postalCode = filter_input(INPUT_POST, 'postalCode');
    $countryCode = filter_input(INPUT_POST, 'countryCode');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    add_customer($customerID, $firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password);
}

if ($action == 'delete_customer') {
    $customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);

    delete_customer($customerID);
}

