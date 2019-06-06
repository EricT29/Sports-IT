<?php
session_set_cookie_params(3600, "/");

session_start(); // ready to go!
require_once('../model/database.php');

$_SESSION['login_error_msg'] = "";

$db = DBConnection::getDB();

$stmt_c = $db->prepare("SELECT * FROM customers WHERE email=?");
$stmt_c->execute([filter_input(INPUT_POST, 'username')]);
$customer = $stmt_c->fetchObject();

if (!is_null($customer) && $customer) { // Check if null or empty
    // Verify customer password and set $_SESSION
    if (password_verify(filter_input(INPUT_POST, 'password'), password_hash($customer->password, PASSWORD_DEFAULT))) {
        $_SESSION['customerID'] = $customer->customerID;
        $_SESSION['customer_name'] = $customer->firstName . ' ' . $customer->lastName;
        $url = "../product_manager/product_register";
        echo '<script>window.location = "' . $url . '";</script>';
    }
}

$stmt_a = $db->prepare("SELECT * FROM administrators WHERE username=?");
$stmt_a->execute([filter_input(INPUT_POST, 'username')]);
$admin = $stmt_a->fetchObject();

if (!is_null($admin) && $admin) { // Check if null or empty
    // Verify admin password and set $_SESSION
    if (password_verify(filter_input(INPUT_POST, 'password'), password_hash($admin->password, PASSWORD_DEFAULT))) {
        $_SESSION['admin_id'] = $admin->username;
        $url = "../admin/admin.php";
        echo '<script>window.location = "' . $url . '";</script>';
    }
}

$stmt_t = $db->prepare("SELECT * FROM technicians WHERE email=?");
$stmt_t->execute([filter_input(INPUT_POST, 'username')]);
$technician = $stmt_t->fetchObject();

if (!is_null($technician) && $technician) { // Check if null or empty
    // Verify technician password and set $_SESSION
    if (password_verify(filter_input(INPUT_POST, 'password'), password_hash($technician->password, PASSWORD_DEFAULT))) {
        $url = "../technician/technician.php";
        echo '<script>window.location = "' . $url . '";</script>';
        $_SESSION['technician_id'] = $technician->techID;
    }
}

// if user failed to login
$_SESSION['login_error_msg'] = "Username or Password is incorrect!";
$url = "../errors/error.php";
echo '<script>window.location = "' . $url . '";</script>';
exit;
?>