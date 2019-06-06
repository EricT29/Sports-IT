<?php

require_once('database.php');

if (!isset($_SESSION)) {
    session_start();

    session_set_cookie_params(3600, "/");
}

if (!function_exists('get_customers')) {

    function get_customers() {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM customers
              ORDER BY customerID';
        $statement = $db->prepare($query);
        $statement->execute();
        $customers = $statement->fetchall();
        $statement->closeCursor();
        return $customers;
    }

}

if (!function_exists('get_customer')) {

    function get_customer($customer_id) {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM customers
              WHERE customerID = :customer_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":customer_id", $customer_id);
        $statement->execute();
        $customer = $statement->fetch();
        $statement->closeCursor();
        return $customer;
    }

}

if (!function_exists('delete_customer')) {

    function delete_customer($customerID) {
        $db = DBConnection::getDB();

        $stmt = $db->prepare("DELETE FROM customers WHERE customerID = ?");
        $stmt->execute([$customerID]);

        // Display the customer List page
        header("Location: customer_list.php");
    }

}

if (!function_exists('add_customer')) {

    function add_customer($customerID, $firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password) {
        $db = DBConnection::getDB();

        try {
            $sql = "INSERT INTO customers (customerID, firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$customerID, $firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password]);
        } catch (Exception $e) {
            $_SESSION['login_error_msg'] = "Something went wrong! Please verify each entry.";
            header("Location: ../errors/error.php");
            exit;
        }
        // Display the customer List page
        header("Location: customer_list.php");
    }

}

// update the customer in the database NOTE: Cannot edit customerID
if (!function_exists('edit_customer')) {

    function edit_customer($customerID, $firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email) {
        $db = DBConnection::getDB();

        $sql = "UPDATE customers SET customerID=?, firstName=?, lastName=?, address=?, city=?, state=?, postalCode=?, countryCode=?, phone=?, email=? WHERE customerID=?";
        $stmt = $db->prepare($sql); // written by Eric M. Thompson
        $stmt->execute([$customerID, $firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $customerID]);

        // Display the customer List page
        header("Location: customer_list.php");
    }

}
?>