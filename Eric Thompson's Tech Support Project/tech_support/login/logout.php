<?php

session_set_cookie_params(3600, "/");

//continue current session
session_start();
//check to see if session variable (uname) is set
//if set destroy the session
if (!empty($_SESSION['customerID']) || !empty($_SESSION['technician_id']) || !empty($_SESSION['admin_id'])) {
    session_destroy();
}
//redirect the user to the home page
header("Location: ../index.php");
?>