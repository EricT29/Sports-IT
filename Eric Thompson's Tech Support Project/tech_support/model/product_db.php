<?php

if (!isset($_SESSION)) {
    session_start();

    session_set_cookie_params(3600, "/");
}

require_once('database.php');

if (!function_exists('get_products')) {

    function get_products() {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM products
              ORDER BY productCode';
        $statement = $db->prepare($query);
        $statement->execute();
        $products = $statement->fetchall();
        $statement->closeCursor();
        return $products;
    }

}

if (!function_exists('get_product')) {

    function get_product($productCode) {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM products
              WHERE productCode = :productCode';
        $statement = $db->prepare($query);
        $statement->bindValue(":productCode", $productCode);
        $statement->execute();
        $product = $statement->fetch();
        $statement->closeCursor();
        return $product;
    }

}

if (!function_exists('delete_product')) {

    function delete_product($productCode) {
        $db = DBConnection::getDB();

        $stmt = $db->prepare("DELETE FROM products WHERE productCode = ?");
        $stmt->execute([$productCode]);

        // Display the product List page
        header("Location: product_list.php");
    }

}

if (!function_exists('add_product')) {

    function add_product($productCode, $name, $version, $releaseDate) {
        $db = DBConnection::getDB();

        $sql = "INSERT INTO products (productCode, name, version, releaseDate) VALUES (?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$productCode, $name, $version, $releaseDate]);

        // Display the product List page
        header("Location: product_list.php");
    }

}

if (!function_exists('register_product')) {

    function register_product($customerID, $productCode, $registrationDate) {
        $db = DBConnection::getDB();

        try {
            $sql = "INSERT INTO registrations (customerID, productCode, registrationDate) VALUES (?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$customerID, $productCode, $registrationDate]);
        } catch (Exception $e) {
            $_SESSION['login_error_msg'] = "This product has already been registered!";
            header("Location: ../errors/error.php");
            exit;
        }

        // Display the product List page
        header("Location: registered.php");
    }

}

// update the product in the database NOTE: Cannot edit productCode
if (!function_exists('edit_product')) {

    function edit_product($productCode, $name, $version, $releaseDate) {
        $db = DBConnection::getDB();

        $sql = "UPDATE products SET productCode=?, name=?, version=?, releaseDate=? WHERE productCode=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$productCode, $name, $version, $releaseDate, $productCode]);

        // Display the product List page
        header("Location: product_list.php");
    }

}
?>