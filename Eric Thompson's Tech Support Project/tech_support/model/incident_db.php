<?php

require_once('database.php');

if (!function_exists('get_customerID_by_email')) {

    function get_customerID_by_email($email)
    {
        $db = DBConnection::getDB();

        $query = 'SELECT customerID FROM customers
              WHERE Email=?';
        $statement = $db->prepare($query);
        $statement->execute([$email]);
        $customerID_by_email = $statement->fetch(); // returns unnested array
        $statement->closeCursor();
        return $customerID_by_email[0]; // return the first and only value
    }

}

if (!function_exists('get_customer_email_by_ID')) {

    function get_customer_email_by_ID($ID)
    {
        $db = DBConnection::getDB();

        $query = 'SELECT Email FROM customers
              WHERE customerID=?';
        $statement = $db->prepare($query);
        $statement->execute([$ID]);
        $customer_email_by_ID = $statement->fetch(); // returns unnested array
        $statement->closeCursor();
        return $customer_email_by_ID[0]; // return the first and only value
    }

}

if (!function_exists('get_customers_by_email')) {

    function get_customers_by_email()
    {
        $db = DBConnection::getDB();

        $query = 'SELECT Email FROM customers
              ORDER BY Email';
        $statement = $db->prepare($query);
        $statement->execute();
        $customers_by_email = $statement->fetchall();
        $statement->closeCursor();
        return $customers_by_email;
    }

}

if (!function_exists('get_technician_name_by_ID')) {

    function get_technician_name_by_ID($techID)
    {
        $db = DBConnection::getDB();

        $query = 'SELECT firstName FROM technicians
              Where TechID=?';
        $statement = $db->prepare($query);
        $statement->execute([$techID]);
        $firstName = $statement->fetch(); // returns unnested array
        $statement->closeCursor();

        $query = 'SELECT lastName FROM technicians
              Where TechID=?';
        $statement = $db->prepare($query);
        $statement->execute([$techID]);
        $lastName = $statement->fetch(); // returns unnested array
        $statement->closeCursor();

        $full_name = $firstName[0] . " " . $lastName[0]; // get the first and only values from both arrays

        return $full_name;
    }

}

if (!function_exists('get_technician_by_ID')) {

    function get_technician_by_ID($techID)
    {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM technicians
              Where TechID=?';
        $statement = $db->prepare($query);
        $statement->execute([$techID]);
        $technician = $statement->fetch(); // returns unnested array
        $statement->closeCursor();

        return $technician;
    }

}

if (!function_exists('get_incident_by_techID')) {

    function get_incidents_by_techID($techID)
    {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM incidents
              WHERE TechID=?
              ORDER BY incidentID';
        $statement = $db->prepare($query);
        $statement->execute([$techID]);
        $incidents = $statement->fetchall();
        $statement->closeCursor();
        return $incidents;
    }

}

if (!function_exists('get_products')) {

    function get_products()
    {
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

if (!function_exists('get_incidents')) {

    function get_incidents()
    {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM incidents
              ORDER BY incidentID';
        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchall();
        $statement->closeCursor();
        return $incidents;
    }

}

if (!function_exists('get_incident')) {

    function get_incident($incidentID)
    {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM incidents
              WHERE incidentID = :incidentID';
        $statement = $db->prepare($query);
        $statement->bindValue(":incidentID", $incidentID);
        $statement->execute();
        $incident = $statement->fetch();
        $statement->closeCursor();
        return $incident;
    }

}

if (!function_exists('get_count_of_assigned_incidents')) {

    function get_count_of_assigned_incidents($techID)
    {
        $db = DBConnection::getDB();

        $query = 'SELECT COUNT(*)
              FROM incidents
              WHERE techID = :techID';
        $statement = $db->prepare($query);
        $statement->bindValue(":techID", $techID);
        $statement->execute();
        $count = $statement->fetch();
        $statement->closeCursor();
        return $count[0]; // return the single value within the array
    }

}

if (!function_exists('get_unassigned_incidents')) {

    function get_unassigned_incidents()
    {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM incidents
            WHERE techID IS NULL
            ORDER BY incidentID';
        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchall();
        $statement->closeCursor();
        return $incidents;
    }

}

if (!function_exists('get_assigned_incidents')) {

    function get_assigned_incidents()
    {
        $db = DBConnection::getDB();

        $query = 'SELECT * FROM incidents
            WHERE techID IS NOT NULL
            ORDER BY incidentID';
        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchall();
        $statement->closeCursor();
        return $incidents;
    }

}

if (!function_exists('delete_incident')) {

    function delete_incident($incidentID)
    {
        $db = DBConnection::getDB();

        $stmt = $db->prepare("DELETE FROM incidents WHERE incidentID = ?");
        $stmt->execute([$incidentID]);

        // Display the incident List page
        header("Location: incident_list.php");
    }

}

if (!function_exists('add_incident')) {

    function add_incident($incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description)
    {
        $db = DBConnection::getDB();

        $sql = "INSERT INTO incidents (incidentID, customerID, productCode, techID, dateOpened, dateClosed, title, description) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description]);

        // Display the incident List page
        header("Location: incident_list.php");
    }

}

if (!function_exists('technician_add_incident')) {

    function technician_add_incident($incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description)
    {
        $db = DBConnection::getDB();

        $sql = "INSERT INTO incidents (incidentID, customerID, productCode, techID, dateOpened, dateClosed, title, description) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description]);

        // Display the incident List page
        header("Location: technician_incident_list.php");
    }

}

// update the incident in the database NOTE: Cannot edit incidentID
if (!function_exists('edit_incident')) {

    function edit_incident($incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description)
    {
        $db = DBConnection::getDB();

        $sql = "UPDATE incidents SET incidentID=?, customerID=?, productCode=?, techID=?, dateOpened=?, dateClosed=?, title=?, description=? WHERE incidentID=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description, $incidentID]);

        // Display the incident List page
        header("Location: incident_list.php");
    }

}

// update the incident in the database NOTE: Cannot edit incidentID
if (!function_exists('technician_edit_incident')) {

    function technician_edit_incident($incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description)
    {
        $db = DBConnection::getDB();

        $sql = "UPDATE incidents SET incidentID=?, customerID=?, productCode=?, techID=?, dateOpened=?, dateClosed=?, title=?, description=? WHERE incidentID=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description, $incidentID]);

        // Display the incident List page
        header("Location: ../incident_manager/technician_incident_list.php");
    }

}

if (!function_exists('assign_to_tech')) {

    function assign_to_tech($incidentID, $techID)
    {
        $db = DBConnection::getDB();

        $sql = "UPDATE incidents SET techID=? WHERE incidentID=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$techID, $incidentID]);

        // Display the incident List page
        header("Location: incident_list.php");
    }

}

if (!function_exists('unassign_to_tech')) {

    function unassign_to_tech($incidentID)
    {
        $db = DBConnection::getDB();

        $sql = "UPDATE incidents SET techID=? WHERE incidentID=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([NULL, $incidentID]);

        // Display the incident List page
        header("Location: incident_list.php");
    }

}
?>