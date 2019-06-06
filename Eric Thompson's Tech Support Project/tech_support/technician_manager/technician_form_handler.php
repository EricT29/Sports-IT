<?php

include '../model/database.php';
require('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');

if ($action == 'edit_technician') {
    $techID = filter_input(INPUT_POST, 'techID', FILTER_VALIDATE_INT);
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');

    edit_technician($techID, $firstName, $lastName, $email, $phone);
}

if ($action == 'add_technician') {
    $techID = filter_input(INPUT_POST, 'techID', FILTER_VALIDATE_INT);
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $password = filter_input(INPUT_POST, 'password');

    add_technician($techID, $firstName, $lastName, $email, $phone, $password);
}

if ($action == 'delete_technician') {
    $techID = filter_input(INPUT_POST, 'techID', FILTER_VALIDATE_INT);

    delete_technician($techID);
}

