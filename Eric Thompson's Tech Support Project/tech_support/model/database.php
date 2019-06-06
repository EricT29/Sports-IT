<?php

class DBConnection
{

    private static $instance = null;
    private $db;

    private function __construct()
    {
        try {
            $this->db = new PDO('mysql:dbname=tech_support;host=127.0.0.1', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public static function getDB()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->db;
    }
// written by Eric M. Thompson
}
