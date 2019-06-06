<?php

require_once('database.php');

if (!function_exists('get_technicians')) {

    function get_technicians()
    {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM technicians
              ORDER BY techID';
        $statement = $db->prepare($query);
        $statement->execute();
        $technicians = $statement->fetchall();
        $statement->closeCursor();
        return $technicians;
    }

}

if (!function_exists('get_technician')) {

    function get_technician($tech_id)
    {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM technicians
              WHERE techID = :tech_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":tech_id", $tech_id);
        $statement->execute();
        $technician = $statement->fetch();
        $statement->closeCursor();
        return $technician;
    }

}

if (!function_exists('delete_technician')) {

    function delete_technician($techID)
    {
        $db = DBConnection::getDB();

        $stmt = $db->prepare("DELETE FROM technicians WHERE techID = ?");
        $stmt->execute([$techID]);

        // Display the technician List page
        header("Location: technician_list.php");
    }

}

if (!function_exists('add_technician')) {

    function add_technician($techID, $firstName, $lastName, $email, $phone, $password)
    {
        $db = DBConnection::getDB();

        $sql = "INSERT INTO technicians (techID, firstName, lastName, email, phone, password) VALUES (?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$techID, $firstName, $lastName, $email, $phone, $password]);

        // Display the technician List page
        header("Location: technician_list.php");
    }

}

// update the technician in the database NOTE: Cannot edit TechID
if (!function_exists('edit_technician')) {

    function edit_technician($techID, $firstName, $lastName, $email, $phone)
    {
        $db = DBConnection::getDB();

        $sql = "UPDATE technicians SET techID=?, firstName=?, lastName=?, email=?, phone=? WHERE techID=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$techID, $firstName, $lastName, $email, $phone, $techID]);

        // Display the technician List page
        header("Location: technician_list.php");
    }

}
?>